<div class="col-3 my-2">
    <div class="card project-card">

        <ul class="icon-bar">
            <li>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#editProjectModal-{{$project->id}}">
                    <i class="fa fa-btn fa-cog"></i>
                </button>
            </li>
            <li>
                <form action="{{route('projects.destroy',$project->id)}}" method="POST"

                      onsubmit="return confirm('您确定要删除吗')">
                    @csrf
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-default"><i class="fa fa-btn fa-times"></i></button>
                </form>
            </li>

        </ul>
        <a href="{{route('projects.show',[$project->id])}}">
            <img class="card-img-top" style="height: 180px;" src="{{asset('storage/thumbs/')}}{{$project->thumbnail ? '/'.$project->thumbnail:'/default.jpeg'}}" alt="Card image cap">
            <div class="card-body">
                <h6 class="card-title text-center">{{$project->name}}</h6>
            </div>
        </a>
    </div>
    @include('projects._editProjectModal')
</div>

{{--@if(count($projects)>0)--}}
{{--    <div class="card-deck">--}}
{{--        @foreach($projects as $project)--}}
{{--            <a href="$" class="col-3 my-2">--}}
{{--                <div class="card">--}}
{{--                    <img class="card-img-top" src="{{asset('storage/thumbs/'.$project->thumbnail)}}" alt="Card image cap">--}}
{{--                    <div class="card-body">--}}
{{--                        <h6 class="card-title text-center">{{$project->name}}</h6>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--@endif--}}
