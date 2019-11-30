@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{route('tasks.store',['project'=>$project->id])}}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-plus"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="待办清单" aria-label="Username"
                       aria-describedby="basic-addon1" name="name">
            </div>
        </form>


        {{--                  error提示     --}}
        @if($errors->create->any())
            @foreach($errors->create->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{$error}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        @endif

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                   aria-selected="true">待办事项
                    <span class="badge badge-pill badge-danger">{{count($todos)}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                   aria-controls="profile" aria-selected="false">完成事项
                    <span class="badge badge-pill badge-success">{{count($dones)}}</span>
                </a>
            </li>

        </ul>
        <div class="tab-content task-list" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <ul class="list-group mt-3">
                    @if(count($todos)>0)
                        @foreach($todos as $task)
                            <li class="list-group-item task-li">
                                <span class="task-name">
                                    <span class="badge badge-secondary mr-3">{{$task->updated_at->diffForHumans()}}</span>
                                    <a href="{{route('tasks.show',[$task->id])}}">{{$task->name}}</a>
                                </span>

                                <span class="task-status">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                            data-target="#editTasksModal-{{$task->id}}">
                                        编辑
                                    </button>
                                    @include('tasks._editTasksModal')
                                    <form class="task-status-form" action="{{route('tasks.check',[$task->id])}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success btn-sm">完成</button>
                                    </form>
                                    <form class="task-status-form" action="{{route('tasks.destroy',[$task->id])}}" method="post">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-outline-danger btn-sm">删除</button>
                                    </form>
                                </span>


                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            {{$todos->links()}}
            @include('tasks._checkTaskStatus')
        </div>
    </div>
@endsection

