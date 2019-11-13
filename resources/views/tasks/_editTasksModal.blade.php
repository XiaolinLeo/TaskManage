<!-- Modal -->
<div class="modal fade" id="editTasksModal-{{$task->id}}" tabindex="-1" role="dialog"
     aria-labelledby="editTasksModal-{{$task->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTasksModal-{{$task->id}}">编辑任务</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('tasks.update',$task->id)}}" method="POST" accept-charset="UTF-8"
                      enctype="multipart/form-data">
                    @csrf
                    {{@method_field('patch')}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>项目名称</label>
                            <input type="text" class="form-control" id="projectName"
                                   placeholder="项目名称" value="{{$task->name}}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="projectsSelect">所属项目</label>
                            <select class="form-control" id="projectsSelect" name="project" required>
{{--                                <option value="" hidden disabled {{$project->id ? " ":'selected'}}></option>--}}
                                @foreach($projects as $id =>$name)
                                    <option value="{{$id}}" name="project" {{$project->id == $id ? 'selected':''}}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--                  error提示     --}}
                        @if($errors->getBag('update-'.$task->id)->any())
                            @foreach($errors->getBag('update-'.$task->id)->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{$error}}
                                </div>
                            @endforeach
                        @endif

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">编辑项目</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
