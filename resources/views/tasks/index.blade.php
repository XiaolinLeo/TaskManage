@extends('layouts.app')
@section('content')
    <div class="container">

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
                                    {{$task->name}}</span>
                                <span class="task-status">
                                    <button type="button" class="btn btn-sm btn-info">{{$task->project->name}}</button>
                        <form action="{{route('tasks.check',[$task->id])}}" class="task-status-form" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-sm">完成</button>
                        </form>
                        <form action="{{route('tasks.destroy',[$task->id])}}" class="task-status-form" method="post">
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
            <p></p>
            {{$todos->links()}}
            @include('tasks._checkTaskStatus')
        </div>
    </div>
@endsection

