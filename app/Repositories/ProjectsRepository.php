<?php

namespace App\Repositories;

use App\Project;
use Image;
use Auth;

class ProjectsRepository
{

    //SOC设计原则
    public function list(){
        return request()->user()->projects()->get();//返回的是一个connection集合
    }


    // 项目创建逻辑
    public function create($request)
    {
        $request->user()->projects()->create([
            'name' => $request->name,
            'thumbnail' => $this->thumb($request)
        ]);
    }

    public function find($id)
    {
        return Project::findOrFail($id);
    }

    public function update($request, $id)
    {
        $project = $this->find($id);
        $project->name = $request->name;
        if ($request->hasFile('thumbnail')) {
            $project->thumbnail = $this->thumb($request);
        }

        $project->save();
    }

    public function todos($project){
        return $project->tasks()->where('completion',0)->paginate(5);
    }

    public function dones($project){
        return $project->tasks()->where('completion',1)->paginate(5);
    }

    public function delete($id)
    {
        $project = $this->find($id);
        $project->delete();

    }

//缩略图处理逻辑
    public function thumb($request)
    {
        $path = null;
        //判断上传文件是否存在
        if ($request->hasFile('thumbnail')) {
            // 文件具体存储的物理路径
//            $upload_path =public_path("uploads/images/".date("Ym/d", time()));
//            $thumb = $request->thumbnail;
//            $file_name = $thumb->hashName();
//
//            $file_path = $upload_path.'/'.$file_name;
//            $image = Image::make($thumb);
//            $image->save($file_path);
//
//            return $file_path;
            $thumb = $request->thumbnail;
            $name = $thumb->hashName();
            $thumb->storeAs('public/thumbs/', $name);

            return $name;


        }
    }


}
