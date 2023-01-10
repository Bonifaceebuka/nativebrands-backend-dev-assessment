<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VideoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'videos' => $this->collection->map(function($data) {
                return [
                    'id'=>$data->id,
                    'title'=>$data->title,
                    'description'=>$data->description,
                    'category'=>[
                        'id'=>$data->category->id,
                        'name'=>$data->category->name,
                            ],
                    'is_paid'=>$data->is_paid,
                    'slug'=>$data->slug,
                    'poster'=>$data->poster,
                    'admin_id'=>$data->admin_id,
                    'video_file'=>$data->video_file,
                    'total_comments'=>count($data->comments),
                ];
            })
        ];
    }
}
