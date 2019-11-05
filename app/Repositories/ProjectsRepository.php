<?php

namespace App\Repositories;

class ProjectsRepository
{

    //SOC设计原则
    // 项目创建逻辑
    public function create($request)
    {
        $request->user()->projects()->create([
            'name' => $request->name,
            'thumbnail' => $this->thumb($request)
        ]);
    }

//缩略图处理逻辑
    public function thumb($request)
    {
        $path = null;
        //判断上传文件是否存在
        if ($request->hasFile('thumbnail')) {
            $path = $request->thumbnail->store('public/thumb/' . date("Y/m/d"));
            return $path;
        }
    }


}
