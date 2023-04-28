<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    public function index(): View
    {
        $tasks = Task::all()->sortBy('id');

        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        $task = new Task();
        $taskStatuses = TaskStatus::all()->pluck('name', 'id');
        $executors = User::all()->pluck('name', 'id');
        $labels = Label::all()->pluck('name', 'id');

        return view('tasks.create', compact('task', 'taskStatuses', 'executors', 'labels'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $labels = array_filter($request->get('labels', []));

        $task = new Task();
        $task->fill($request->validated());
        $task->creator()->associate(Auth::user());
        $task->save();
        $task->labels()->attach($labels);

        flash(__('task.created-successfully'))->success();

        return redirect()->route('tasks.index');
    }

    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        $taskStatuses = TaskStatus::all()->pluck('name', 'id');
        $executors = User::all()->pluck('name', 'id');
        $labels = Label::all()->pluck('name', 'id');

        return view('tasks.edit', compact('task', 'taskStatuses', 'executors', 'labels'));
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $labels = array_filter($request->get('labels', []));

        $task->fill($request->validated());
        $task->labels()->sync($labels);
        $task->save();

        flash(__('task.changed-successfully'))->success();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        flash(__('task.deleted-successfully'))->success();

        return redirect()->route('tasks.index');
    }
}
