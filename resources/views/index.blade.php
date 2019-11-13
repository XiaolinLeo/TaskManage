@extends('layouts.app')
@section('content')
    @include('projects._createProjectModal')
    <div class="container">
        <div class="card-deck">
            @each('projects._card',$projects,'project')
        </div>
    </div>
@section('customJS')
    <script>
        $(document).ready(function(){
            $('.icon-bar').hide();
            $('.project-card').hover(function () {
                $(this).find('.icon-bar').toggle();
            })
        })
    </script>
@endsection()
@endsection
