<?php

namespace App\Controllers;

use App\Models\State;

/**
 * Class StatesController
 * @package App\Controllers
 */
class StatesController extends Controller
{
    /**
     * @var State
     */
    private State $state;

    /**
     * StatesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->state = (new State());
    }

    /**
     * Show all cities
     */
    public function index()
    {
        $this->guard(['admin']);
        $states = $this->state->all();
        view('states/index', compact('states'));
    }

    /**
     * Show state creation page
     */
    public function create()
    {
        $this->guard(['admin']);
        view('states/create');
    }

    /**
     * Store state in the database.
     */
    public function store()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'name' => ['required', 'string'],
        ]);

        if($this->state->create($data)) {
            session()->flash(['success' => "State saved!"]);
        }

        redirect('states');
    }

    /**
     * Edit an existing state.
     */
    public function edit()
    {
        $this->guard(['admin']);
        if (request()->has('id')) {
            $state = $this->state->getById(request()->get('id'));
            if ($state) {
                view('states/edit', compact('state'));
            } else {
                view('404');
            }
        } else {
            view('404');
        }
    }

    /**
     * Update an existing state.
     */
    public function update()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'id' => ['required', 'integer'],
            'name' => ['required', 'string'],
        ]);

        $status = $this->state->updateById($data['id'], [
            'name' => $data['name']
        ]);

        if($status) {
            session()->flash(['success' => "State Updated!"]);
        }

        redirect('states');
    }

    /**
     * Delete an existing state.
     */
    public function delete()
    {
        $this->guard(['admin']);
        if (request()->has('state_id')) {
            $status = $this->state->deleteById(request()->get('state_id'));
            if($status) {
                session()->flash(['success' => "State Removed!"]);
            }
        }
        redirect('states');
    }
}
