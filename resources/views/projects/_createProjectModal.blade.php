<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProjectModal">
    新建任务
</button>

<!-- Modal -->
<div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProjectModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('projects.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>项目名称</label>
                        <input type="text" class="form-control" id="projectName"
                               placeholder="项目名称" name="name">
                    </div>
                    <div class="form-group">
                        <label>缩略图</label>
                        <input type="file" class="form-control-file" id="thumbnail" placeholder="缩略图" name="thumbnail">
                    </div>
          @include('shared._errors')
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">新建项目</button>
                </div>
            </form>
        </div>
    </div>
</div>
