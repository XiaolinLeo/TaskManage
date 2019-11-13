<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\EditProjectRequest;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\ProjectsRepository;


class ProjectsController extends Controller
{
    protected $repo;

    public function __construct(ProjectsRepository $repo)
    {
        $this->repo = $repo;
        $this->middleware('auth');
    }


    public function index()
    {
        $projects = $this->repo->list();
        return view('index', compact('projects'));
    }

    public function store(CreateProjectRequest $request)
    {
        //SOC 设计原则
        $this->repo->create($request);
        return back();
    }

    public function destroy($id){
        $this->repo->delete($id);
        return back();
    }

    public function update(EditProjectRequest $request,$id){
        $this->repo->update($request,$id);
        return back();
    }

    public function show(Project $project){
        $todos = $this->repo->todos($project);
        $dones = $this->repo->dones($project);
        $projects = request()->user()->projects()->pluck('name','id');
        return view('projects.show',compact('project','todos','dones','projects'));
    }


//    public function destroy(Project $project)
//    {
//        $project->delete();
//        return back();
//    }



//    public function update(Request $request, Project $project)
//    {
//
//        $project->name = $request->name;
//        if ($request->hasFile('thumbnail')) {
//            $project->thumbnail = $this->repo->thumb($request);
//        }
//        $project->save();
//        return back();
//    }


}
