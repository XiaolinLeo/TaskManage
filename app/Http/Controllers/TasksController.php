<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Project;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;


class TasksController extends Controller
{
    protected $repo;

    public function __construct(TaskRepository $repo)
    {
        $this->repo = $repo;
        $this->middleware('auth');

    }


    public function index()
    {
        $todos = $this->repo->todos();
        $dones = $this->repo->dones();
//        $projects = request()->user()->projects()->get();
        return view('tasks.index', compact('todos', 'dones'));
    }

    public function search()
    {
        return response()->json([
            'tasks' => $this->repo->all()
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(CreateTaskRequest $request)
    {
//        $this->authorize('update',$user);
        $this->repo->create($request);
        return back();
    }


    public function show(Task $task)
    {
        $steps = $task->steps;
        return view('tasks.show', compact('task', 'steps'));
    }

    public function check($id)
    {

        $this->repo->check($id);

        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {

        $this->repo->update($request, $id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->destroy($id);
        return back();
    }
}
