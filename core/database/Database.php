<?php

namespace App\Core\Database;

use Exception;
use PDO;
use PDOStatement;

class Database
{
    /**
     * The PDO instance.
     *
     * @var PDO
     */
    protected PDO $pdo;

    protected PDOStatement $statement;

    protected array $params;

    /**
     * Create a new Database instance.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Run a raw query on the system database.
     *
     * @param string $query
     * @param array $params
     * @return $this
     * @throws Exception
     */
    public function query(string $query, array $params = []): Database
    {
        $this->statement = $this->pdo->prepare($query);
        $this->params = $params;
        return $this;
    }

    /**
     * Execute the query and fetch the first record as an associative array
     */
    public function first()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Execute the query and fetch all results as an associate array.
     *
     */
    public function get()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Execute the prepared statement
     */
    public function execute(): bool
    {
        return $this->statement->execute($this->params);
    }

    /**
     * Get number of records
     *
     * @return int
     */
    public function count(): int
    {
        $this->execute();
        return $this->statement->rowCount();
    }

    /**
     * Check if any records exists
     *
     * @return bool
     */
    public function exists(): bool
    {
        return $this->count() > 0;
    }

    /**
     * Insert a record into a table.
     *
     * @param string $table Table Name
     * @param array $params Parameters in array format
     * @return bool
     */
    public function insert(string $table, array $params)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($params)),
            ':' . implode(', :', array_keys($params))
        );

        try {
            $this->statement = $this->pdo->prepare($sql);
            $this->params = $params;
            if ($this->execute()) {
                return true;
            }
            return false;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}