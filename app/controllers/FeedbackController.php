<?php

namespace App\Controllers;

use App\Models\Feedback;

class FeedbackController extends Controller
{
    private Feedback $feedback;

    public function __construct()
    {
        parent::__construct();
        $this->feedback = (new Feedback());
    }

    public function index()
    {
        $this->guard(['admin']);
        $feedbacks = $this->feedback->all();
        view('feedbacks', compact('feedbacks'));
    }

    public function create()
    {
        $this->guard(['customer']);
        view('customers/feedbacks/create');
    }

    public function store()
    {
        $this->guard(['customer']);

        $data = $this->request->validate([
            'content' => ['required', 'string'],
        ]);

        $data['user_id'] = auth()->user_id();

        if ($this->feedback->create($data)) {
            session()->flash(['success' => "Your feedback has been submitted."]);
        }

        redirect('customer/feedback');
    }

    public function delete()
    {
        $this->guard(['admin']);
        if (request()->has('id')) {
            $status = $this->feedback->deleteById(request()->get('id'));
            if ($status) {
                session()->flash(['success' => "Feedback Removed!"]);
            }
        }
        redirect('feedbacks');
    }
}
