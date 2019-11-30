<?php

namespace App\Http\ViewComposer;


use App\Repositories\TaskRepository;
use Illuminate\Contracts\View\View;


class TaskCountComposer
{
    protected $task;

    public function __construct(TaskRepository $task)
    {
        $this->task = $task;
    }

    public function compose(View $view)
    {
        if(auth()->user()){
            $view->with([
                'total' => $this->task->total(),
                'todosCount' => $this->task->todosCount(),
                'donesCount' => $this->task->donesCount()
            ]);
        }

    }


}

