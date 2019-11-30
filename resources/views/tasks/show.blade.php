@extends('layouts.app')
@section('content')
    <div class="container" id="app">

        <steps url="{{route('tasks.steps.index',$task->id)}}" :initial-steps="{{$steps}}"></steps>
    </div>
@endsection

