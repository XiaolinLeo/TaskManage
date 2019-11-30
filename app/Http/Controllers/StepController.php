<?php

namespace App\Http\Controllers;

use App\Step;
use App\Task;
use Illuminate\Http\Request;

class StepController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        return response()->json([
            'steps' => $task->steps,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Task $task)
    {
        $step = $task->steps()->create([
            'name' => $request->name
        ]);
        $step->refresh();
        return response()->json([
            'step' => $step
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Step $step
     * @return \Illuminate\Http\Response
     */
    public function show(Step $step)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Step $step
     * @return \Illuminate\Http\Response
     */
    public function edit(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Step $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Task $task, Step $step)
    {
        $step->update([
            'completion'=>$request->completion
        ]);
    }

    public function completeAll(Task $task){
        $task->steps()->update([
            'completion'=>1
        ]);
    }

    public function clear(Task $task){
        $task->steps()->where('completion',1)->delete();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Step $step
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task,Step $step)
    {
        $step->delete();
    }
}
