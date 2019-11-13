

<!-- Modal -->
<div class="modal fade" id="editProjectModal-{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="editProjectModal-{{$project->id}}"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModal">编辑项目</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('projects.update',[$project->id])}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                {{@method_field('patch')}}
                <div class="modal-body">
                    <div class="form-group">
                        <label>项目名称</label>
                        <input type="text" class="form-control" id="projectName"
                               placeholder="项目名称" value="{{$project->name}}" name="name">
                    </div>
                    <div class="form-group">
                        <label>缩略图</label>
                        <input type="file" class="form-control-file" id="thumbnail" placeholder="缩略图" name="thumbnail">
                    </div>
                    {{--                  error提示     --}}
                    @if($errors->getBag('update-'.$project->id)->any())
                        @foreach($errors->getBag('update-'.$project->id)->all() as $error)
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
