<?php

namespace Portfolio\Http\Controllers;

use App\Http\Controllers\Controller;
use Portfolio\Models\Task;

class PortfolioController extends Controller
{
    public function index($params = [])
    {
        return view('portfolio::index', $params);
    }

    public function tasks()
    {
        $tasks = Task::simplePaginate(5);
        return view('portfolio::tasks.table', compact('tasks'));
    }

    public function lastTask()
    {
        $tasks = Task::orderBy('created_at', 'desc')->limit(1)->get();
        return view('portfolio::tasks.template', compact('tasks'));
    }

    public function store()
    {
        $message = "Task criada com sucesso.";
        if (! request()->input('title', false)) {
            $message = "Titulo é obrigatório.";
            return view('portfolio::responses.fail', compact('message'));
        }
        
        $task = Task::create(request()->only('title'));
        $message = "Tarefa adicionada com sucesso.";
        return view('portfolio::responses.successful', compact('message'));
    }

    public function destroy($id)
    {
        try {
            $message = 'Tarefa deletada com sucesso.';
            Task::findOrFail($id)->delete();
            return view('portfolio::responses.successful', compact('message'));
        } catch (\Exception $e) {
            $message = "Falha ao tentar exluir";
            return view('portfolio::responses.fail', compact('message'));
        }
    }

    public function update($id)
    {
        try {
            $message = 'Tarefa atualizada com sucesso.';
            $updated = Task::findOrFail($id)->update(request()->only('title'));
            return view('portfolio::responses.successful', compact('message'));
        } catch (\Exception $e) {
            $message = "Falha ao tentar atualizar";
            return view('portfolio::responses.fail', compact('message'));
        }
    }

    public function filter()
    {
        $title = request()->input('filter', '');
        $tasks = Task::where('title', 'like', "%$title%")->simplePaginate();
        return view('portfolio::tasks.table', compact('tasks'));
    }

    // FORMS
    public function create()
    {   
        return view('portfolio::tasks.create');
    }

    public function edit($id)
    {
        try {
            $task = Task::findOrFail($id);
            return view('portfolio::tasks.edit', compact('task'));
        } catch (\Exception $e) {
            return $this->index(['error' => $e->getMessage()]);
        }
    }

    public function find($id)
    {
        $task = Task::find($id);
        return view('portfolio::tasks.row', compact('task'));
    }

    public function responses()
    {
        $type = request()->input('type', 'fail');
        $message = request()->input('message', '#Error');
        return view("portfolio::responses.".$type, compact('message'));
    }
}