<?php

namespace App\Controllers;

use App\Models\Faq;

/**
 * Class FaqController
 * @package App\Controllers
 */
class FaqController extends Controller
{
    /**
     * @var Faq $faq
     */
    private Faq $faq;

    /**
     * StatesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->faq = (new Faq());
    }


    public function show()
    {
        $this->guard(['auth']);
        $faqs = $this->faq->all();
        view('faqs', compact('faqs'));
    }

    /**
     * Show all faq
     */
    public function index()
    {
        $this->guard(['admin']);
        $faqs = $this->faq->all();
        view('faq/index', compact('faqs'));
    }

    /**
     * Show faq creation page
     */
    public function create()
    {
        $this->guard(['admin']);
        view('faq/create');
    }

    /**
     * Store faq in the database.
     */
    public function store()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
        ]);

        if ($this->faq->create($data)) {
            session()->flash(['success' => "FAQ saved!"]);
        }

        redirect('faq');
    }

    /**
     * Edit an existing faq.
     */
    public function edit()
    {
        $this->guard(['admin']);
        if (request()->has('faq_id')) {
            $faq = $this->faq->getById(request()->get('faq_id'));
            if ($faq) {
                view('faq/edit', compact('faq'));
            } else {
                view('404');
            }
        } else {
            view('404');
        }
    }

    /**
     * Update an existing faq.
     */
    public function update()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'faq_id' => ['required', 'integer'],
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
        ]);

        $status = $this->faq->updateById($data['faq_id'], [
            'question' => $data['question'],
            'answer' => $data['answer']
        ]);

        if ($status) {
            session()->flash(['success' => "FAQ Updated!"]);
        }

        redirect('faq');
    }

    /**
     * Delete an existing faq.
     */
    public function delete()
    {
        $this->guard(['admin']);
        if (request()->has('faq_id')) {
            $status = $this->faq->deleteById(request()->get('faq_id'));
            if ($status) {
                session()->flash(['success' => "FAQ Removed!"]);
            }
        }
        redirect('faq');
    }
}
