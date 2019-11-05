<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use Illuminate\Http\Request;
use App\Repositories\ProjectsRepository;


class ProjectsController extends Controller
{
    protected $repo;
    public function __construct(ProjectsRepository $repo){
        $this->repo = $repo;
    }


    public function store(CreateProjectRequest $request)
    {
        //SOC 设计原则
        $this->repo->create($request);
    }



}
