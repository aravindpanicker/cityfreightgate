<?php

namespace App\Core\Utility;

use App\Core\App;
use App\Core\Database\Database;
use App\Core\Request;
use DateTime;
use Exception;

/**
 * Class FormValidation
 * @package App\Core\Utility
 */
class FormValidator
{
    /**
     * @var array
     */
    private array $formData;
    private array $errors = [];
    private $validationParams;
    private $request;

    public function __construct(array $rules)
    {
        $this->formData = $rules;
    }

    /**
     * @throws Exception
     */
    public function validate(Request $request)
    {
        $this->request = $request;
        $this->run();
        return !$this->hasErrors();
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getValues()
    {
        return $this->request->all();
    }

    /**
     * Run validation
     *
     * @throws Exception
     */
    private function run()
    {
        foreach ($this->formData as $formField => $rules) {
            foreach ($rules as $rule) {
                if (sizeof(explode(':', $rule)) > 0) {
                    $portions = explode(':', $rule);
                    $rule = trim($portions[0]);

                    if (isset($portions[1]) && sizeof(explode(',', $portions[1])) > 0) {
                        $this->validationParams = explode(',', $portions[1]);
                    } else {
                        $this->validationParams = [];
                    }
                }
                $method = 'validate_' . $rule;
                if (!method_exists($this, $method)) throw new Exception("Invalid Validation Rule. {$rule} doesn't exist!");
                if (!$this->$method($this->request->get($formField))) {
                    $this->errors[$formField] = $this->getErrorMessage($formField, $rule);
                }
            }
        }
    }

    private function hasErrors()
    {
        return sizeof($this->errors) > 0;
    }

    private function validate_required($value)
    {
        return !($value === null || (is_array($value) && empty($value)) || (is_string($value) && trim($value) === ''));
    }

    private function validate_array($value)
    {
        return is_array($value);
    }

    private function validate_string($value)
    {
        if (empty($value)) return true;
        return is_string($value);
    }

    private function validate_date($value, $format = 'm-d-Y')
    {
        if (!is_string($value)) {
            return false;
        }

        if ($format) {
            $ret = DateTime::createFromFormat($format, $value);
            if ($ret) {
                $errors = DateTime::getLastErrors();
                if (!empty($errors['warning_count'])) {
                    $ret = false;
                }
            }
        } else {
            // validate anything, not really recommended
            try {
                $ret = new DateTime($value);
            } catch (\Exception $e) {
                $ret = false;
            }
        }

        return $ret !== false;
    }

    private function validate_numeric($value)
    {
        return is_numeric($value);
    }

    private function validate_integer($value)
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }

    private function validate_decimal($value)
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT) !== false;
    }

    private function validate_email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function validate_phone($value)
    {
        return strlen($value) === 10;
    }

    /**
     * Check that the value has a minimum length
     */
    private function validate_min($value)
    {
        if (!is_string($value) && !is_int($value)) {
            return false;
        }
        $length = $this->validationParams[0];
        if ((!is_int($length) && !ctype_digit($length)) || $length < 0) {
            throw new \InvalidArgumentException('The length must be an positive integer');
        }
        return mb_strlen($value) >= $length;
    }

    public function validate_unique($value)
    {
        if (isset($this->validationParams[0]) === false
            || isset($this->validationParams[1]) === false)
            return false;

        $table = trim($this->validationParams[0]);
        $column = trim($this->validationParams[1]);
        $query = 'SELECT * FROM ' . $table . ' WHERE ' . $column . ' = :param';
        return !App::get('database')->query($query, [
            'param' => $value,
        ])->exists();
    }

    private function validate_confirm($value)
    {
        return ($this->request->get('password_confirm') === $value);
    }

    private function getErrorMessage($formField, $rule): string
    {
        if ($rule == 'required') {
            return "{$formField} is required!";
        }

        if ($rule == 'string') {
            return "{$formField} should be a string!";
        }

        if ($rule == 'min') {
            return "{$formField} should contain minimum {$this->validationParams[0]} characters!";
        }

        if ($rule == 'email') {
            return "Enter a valid email address";
        }

        if ($rule == 'confirm') {
            return "Password mismatch";
        }

        if ($rule == 'unique') {
            return ucfirst($formField) . " you have entered already exists in the system";
        }

        return "Check {$formField} field";
    }
}