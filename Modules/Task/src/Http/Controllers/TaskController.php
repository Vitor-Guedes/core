<?php

namespace Task\Http\Controllers;

use App\Http\Controllers\Controller;
use Task\Models\Task;

class TaskController extends Controller
{
    public function index($params = [])
    {
        return view('task::index', $params);
    }

    public function tasks()
    {
        $tasks = Task::simplePaginate(5);
        return view('task::tasks.table', compact('tasks'));
    }

    public function lastTask()
    {
        $tasks = Task::orderBy('created_at', 'desc')->limit(1)->get();
        return view('task::tasks.template', compact('tasks'));
    }

    public function store()
    {
        $message = "Task criada com sucesso.";
        if (! request()->input('title', false)) {
            $message = "Titulo é obrigatório.";
            return view('task::responses.fail', compact('message'));
        }
        
        $task = Task::create(request()->only('title'));
        $message = "Tarefa adicionada com sucesso.";
        return view('task::responses.successful', compact('message'));
    }

    public function destroy($id)
    {
        try {
            $message = 'Tarefa deletada com sucesso.';
            Task::findOrFail($id)->delete();
            return view('task::responses.successful', compact('message'));
        } catch (\Exception $e) {
            $message = "Falha ao tentar exluir";
            return view('task::responses.fail', compact('message'));
        }
    }

    public function update($id)
    {
        try {
            $message = 'Tarefa atualizada com sucesso.';
            $updated = Task::findOrFail($id)->update(request()->only('title'));
            return view('task::responses.successful', compact('message'));
        } catch (\Exception $e) {
            $message = "Falha ao tentar atualizar";
            return view('task::responses.fail', compact('message'));
        }
    }

    public function filter()
    {
        $title = request()->input('filter', '');
        $tasks = Task::where('title', 'like', "%$title%")->simplePaginate();
        return view('task::tasks.table', compact('tasks'));
    }

    public function massAction()
    {
        $action = request()->input('action', '');

        return match($action) {
            'destroy' => $this->massDestroy(),
            default => $this->index()
        };
    }

    public function massDestroy()
    {
        $tasks = array_map(function ($key) {
            list($label, $id) = explode(':', $key);
            return $id;
        }, array_keys(request()->except('action')));

        Task::whereIn('id', $tasks)->delete();

        return $this->index();
    }

    // FORMS
    public function create()
    {   
        return view('task::tasks.create');
    }

    public function edit($id)
    {
        try {
            $task = Task::findOrFail($id);
            return view('task::tasks.edit', compact('task'));
        } catch (\Exception $e) {
            return $this->index(['error' => $e->getMessage()]);
        }
    }

    public function find($id)
    {
        $task = Task::find($id);
        return view('task::tasks.row', compact('task'));
    }

    public function responses()
    {
        $type = request()->input('type', 'fail');
        $message = request()->input('message', '#Error');
        return view("task::responses.".$type, compact('message'));
    }
}