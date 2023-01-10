<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Comment;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Resources\VideoCollection;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::get();
        return new VideoCollection($videos);
    }

    public function category($id)
    {
        $videos = Video::where('category_id',$id)->get();
        if($videos !== null){
        return new VideoCollection($videos);
        }
        else{
            return response()->json([
                'message'=>'No Videos Registered With Category ID '.$id
            ],200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator =  Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'category_id' => 'required|int',
            'is_paid' => 'required|int',
            'poster' => 'required|image|mimes:jpeg,jpg,png|max:5120',
            'video_file' => 'required|mimes:mp4|max:1048576',///I GB file max
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
        $user_id = auth('api')->user()->id;
        $AuthController = new AuthController();
        $CategoryController = new CategoryController();
        if($AuthController->is_admin($user_id) == true){
            if ($CategoryController->already_exists($request->category_id) == false) {
                return response()->json([
                    'message'=>'Unregistered Category ID'
                ],200);
            }
            $poster_name = strtolower($request->title.'-'.time());
            $poster_file = $request->file('poster')->storeOnCloudinaryAs('tacc-app/images/video-posters',$poster_name);          
            $poster = $poster_file->getSecurePath();
            $poster_pubID = $poster_file->getPublicId();

            $video_name = strtolower($request->title.'-'.time());
            $video_file = $request->file('video_file')->storeOnCloudinaryAs('tacc-app/videos',$video_name);          
            $video = $video_file->getSecurePath();
            $video_pubID = $video_file->getPublicId();
            $Video = new Video([
                'title'=>$request->title,
                'description'=>$request->description,
                'category_id'=>$request->category_id,
                'is_paid'=>$request->is_paid,
                'slug'=>Str::slug($request->title.'-'.time()),
                'poster'=>$poster,
                'admin_id'=>$user_id,
                'poster_public_id'=>$poster_pubID,
                'video_file'=>$video,
                'video_public_id'=>$video_pubID,
            ]);
            if($Video->save()){
                return response()->json([
                    'message'=>'New Video added'
                ],200);
            }
        }else{
                return response()->json([
                    'message' => 'Only users with administrative roles are allowed to perform this action',
                ]);
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::where('id',$id)->with('comments')->first();
        // $Video_comments = Comment::where('video_id',$id)->with('users')->get();
        // return $video;
        if($video !== null){
        $comments = [];
        $i = 0;
        foreach ($video->comments as $comment) {
            if($comment->users->avatar == 'default.png')
            {
                $avatar = asset('assets/images/default/user.jpg');
            }else{
                $avatar = $comment->users->avatar;                
            }
            $comments[] = [
                'body'=>$comment['body'],
                'author'=>
                    [                       
                        'id'=>$comment->users->id,
                        'first_name'=>$comment->users->first_name,
                        'last_name'=>$comment->users->last_name,
                        'avatar'=>$avatar,
                    ]
            ];
            // $++;
        }
        return response()->json([
            'video'=>[
                'id'=>$video->id,
                'title'=>$video->title,
                'description'=>$video->description,
                'category_id'=>[
                    'id'=>$video->category->id,
                    'name'=>$video->category->name,
                        ],
                'is_paid'=>$video->is_paid,
                'slug'=>$video->slug,
                'poster'=>$video->poster,
                'admin_id'=>$video->admin_id,
                'video_file'=>$video->video_file,
                'total_comments'=>count($video->comments),
                'comments'=>[
                        $comments,
                        // 'users'=>
                        //         [
                        //             'name'=>$video->comments[0]->users->id,
                        //         ]
                            ],
            ]
        ],200);
    }
        else{
            return response()->json([
                'message'=>'Unregistered Video ID'
            ],301);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator =  Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'category_id' => 'required|int',
            'is_paid' => 'required|int',
            'poster' => 'image|mimes:jpeg,jpg,png|max:5120',
            'video_file' => 'mimes:mp4|max:1048576',///I GB file max
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
        $Video = Video::find($id);
        $poster = $request->file('poster');
        $video_file = $request->file('video_file');
        $AuthController = new AuthController();
        $user_id = auth('api')->user()->id;
        $CategoryController = new CategoryController();
        if($AuthController->is_admin($user_id) !== true){
            return response()->json([
                    'message' => 'Only users with administrative roles are allowed to perform this action',
                ]);
        }
        if ($CategoryController->already_exists($request->category_id) == false) {
                return response()->json([
                    'message'=>'Unregistered Category ID'
                ],200);
            }
        if (isset($poster) && isset($video_file)) {
            $destroy_poster = cloudinary()->destroy($Video->poster_public_id);
            if ($destroy_poster['result'] !== 'ok') {
                return response()->json([
                            'message'=>'We were unable to replace the old poster image. Please try again',
                            ],501);
            }
            $destroy_video_file = cloudinary()->destroy($Video->video_public_id,['resource_type' => 'video']);
            if ($destroy_video_file['result'] !== 'ok') {
                return response()->json([
                            'message'=>'We were unable to replace the old video file. Please try again',
                            ],501);
                 }
            $poster_name = strtolower($request->title.'-'.time());
            $poster_file = $poster->storeOnCloudinaryAs('tacc-app/images/video-posters',$poster_name);
            $poster = $poster_file->getSecurePath();
            $poster_pubID = $poster_file->getPublicId();

            $Video->title = $request->title;
            $Video->description = $request->description;
            $Video->category_id = $request->category_id;
            $Video->is_paid = $request->is_paid;
            $Video->slug = Str::slug($request->title.'-'.time());
            $Video->admin_id = $user_id;
            $Video->poster = $poster;
            $Video->poster_public_id = $poster_pubID;

            $video_file_name = strtolower($request->title.'-'.time());
            $video_file_file = $video_file->storeOnCloudinaryAs('tacc-app/videos',$video_file_name);
            $video_file = $video_file_file->getSecurePath();
            $video_file_pubID = $video_file_file->getPublicId();
            $Video->video_file = $video_file;
            $Video->video_public_id = $video_file_pubID;
            $Video->save();
                return response()->json([
                    'message'=>'Video updated successfully',
                    ],200);
        }
        else if (isset($poster) && !isset($video_file)) {
                $destroy_poster = cloudinary()->destroy($Video->poster_public_id);
            if ($destroy_poster['result'] == 'ok') {
                $poster_name = strtolower($request->title.'-'.time());
                $poster_file = $poster->storeOnCloudinaryAs('tacc-app/images/video-posters',$poster_name);
                $poster = $poster_file->getSecurePath();
                $poster_pubID = $poster_file->getPublicId();

                $Video->title = $request->title;
                $Video->description = $request->description;
                $Video->category_id = $request->category_id;
                $Video->is_paid = $request->is_paid;
                $Video->slug = Str::slug($request->title.'-'.time());
                $Video->admin_id = $user_id;
                $Video->poster = $poster;
                $Video->poster_public_id = $poster_pubID;
                $Video->save();
                    return response()->json([
                        'message'=>'Video updated successfully',
                        ],200);
        }
        else{
            return response()->json([
                        'message'=>'We were unable to replace the old poster image. Please try again',
                        ],501);
        }
    }
        else if (isset($video_file) && !isset($poster)) {
                $destroy_video_file = cloudinary()->destroy($Video->video_public_id,['resource_type' => 'video']);
            if ($destroy_video_file['result'] == 'ok') {
                $video_file_name = strtolower($request->title.'-'.time());
                $video_file_file = $video_file->storeOnCloudinaryAs('tacc-app/videos',$video_file_name);
                $video_file = $video_file_file->getSecurePath();
                $video_file_pubID = $video_file_file->getPublicId();
                $Video->title = $request->title;
                $Video->description = $request->description;
                $Video->category_id = $request->category_id;
                $Video->is_paid = $request->is_paid;
                $Video->slug = Str::slug($request->title.'-'.time());
                $Video->admin_id = $user_id;
                $Video->video_file = $video_file;
                $Video->video_public_id = $video_file_pubID;
                $Video->save();
                    return response()->json([
                        'message'=>'Video updated successfully',
                        ],200);
        }
        else{
            return response()->json([
                        'message'=>'We were unable to replace the old video file. Please try again',
                        ],501);
        }
        }
        else{
                $Video->title = $request->title;
                $Video->description = $request->description;
                $Video->category_id = $request->category_id;
                $Video->is_paid = $request->is_paid;
                $Video->slug = Str::slug($request->title.'-'.time());
                $Video->admin_id = $user_id;
                $Video->save();
                    return response()->json([
                        'message'=>'Video updated successfully',
                        ],200);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Video = Video::find($id);
        $AuthController = new AuthController();
        $user_id = auth('api')->user()->id;
        $CategoryController = new CategoryController();
        if($AuthController->is_admin($user_id) !== true){
            return response()->json([
                    'message' => 'Only users with administrative roles are allowed to perform this action',
                ]);
        }
        $destroy_poster = cloudinary()->destroy($Video->poster_public_id);
            if ($destroy_poster['result'] !== 'ok') {
            return response()->json([
                        'message'=>'We were unable to remove the old poster image. Please try again',
                        ],501);
        }
        $destroy_video = cloudinary()->destroy($Video->video_public_id,['resource_type' => 'video']);
            if ($destroy_video['result'] == 'ok') {
                if($Video->delete()){
                    return response()->json([
                        'message'=>'Video removed successfully'
                    ]);
                }
            }else{
            return response()->json([
                        'message'=>'We were unable to remove the old video file. Please try again',
                        ],501);
        }
        
    }

    public function already_exists($name){
    if(Video::where('name',$name)->first() !=null){
        return false;
    }
    else{
        return true;
    }
}
}
