<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request, $video_id){
    	// VIDEO COMMENT
	     $validator =  Validator::make($request->all(), [
            'body' => 'required|string',
        ]);
		if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
        $video = Video::find($video_id);
        if ($video !== null) {
        	$new_comment = new Comment();
        	$new_comment->body = $request->body;
        	$new_comment->video_id = $video_id;
        	$new_comment->user_id = auth('api')->user()->id;
        }
        if($new_comment->save()){
                return response()->json([
                    'message'=>'New comment added'
                ],200);
            }else{
            	 return response()->json([
                    'message'=>'We are unable to add new comment.'
                ],501);
            }
    }
}
