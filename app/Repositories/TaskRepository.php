<?php

namespace App\Repositories;


use App\Task;
use Image;

class TaskRepository
{


    public function create($request)
    {
        return Task::create([
            'name' => $request->name,
            'completion' => (int)false,
            'project_id' => $request->project
        ]);
    }

    public function find($id)
    {
        return Task::findOrFail($id);
    }

    public function check($id)
    {
        $task = $this->find($id);
        if ($task->completion == 0) {
            $task->update([
                'completion' => (int)True
            ]);
        }
        else {
            $task->update([
                'completion' => (int)False
            ]);
        }


    }


    public function update($request, $id)
    {
        $task = $this->find($id);
        $task->update([
            'name' => $request->name,
            'project_id' => $request->project
        ]);
    }

    public function destroy($id)
    {
        $task = $this->find($id);
        $task->delete();
    }

    public function todos()
    {
        return auth()->user()->tasks()->where('completion', 0)->paginate(5);
    }

    public function dones()
    {
        return auth()->user()->tasks()->where('completion', 1)->paginate(5);
    }

    public function todosCount(){
        return auth()->user()->tasks()->where('completion', 0)->count();
    }
    public function donesCount(){
        return auth()->user()->tasks()->where('completion', 1)->count();
    }

    public function alltasks(){
        return auth()->user()->tasks()->count();
    }


}
