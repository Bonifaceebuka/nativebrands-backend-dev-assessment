<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
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
        $videos = Video::with('user')->get();
        // return $videos;
        return view('admin.videos.index',['videos'=>$videos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.videos.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'category_id' => 'required|int',
            'is_paid' => 'required|int',
            'poster' => 'required|image|mimes:jpeg,jpg,png|max:5120',
            'video_file' => 'required|mimes:mp4|max:1048576',///I GB file max
        ]);
        $user_id = Auth::user()->id;
        $AuthController = new AuthController();
        $CategoryController = new CategoryController();
        if($AuthController->is_admin($user_id) == true){
            if ($CategoryController->already_exists($request->category_id) == false) {
                $error = 'Unregistered Category ID';
                return redirect()->back()->with('error-message', $error);
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
                $success = 'New Video Added Successfully';
                return redirect()->back()->with('success-message', $success);
            }
            else{
                $error = 'New Video Was Not Added Successfully';
                return redirect()->back()->with('error-message', $error);
            }
        }else{
            $error = 'Only users with administrative roles are allowed to perform this action';
                return redirect()->back()->with('error-message', $error);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        if($video !== null){
            $categories = Category::get();
            return view('admin.videos.edit',['categories'=>$categories,'video'=>$video]);
        }else{
            $error = 'Invalid Video ID';
            return redirect()->back()->with('error-message', $error);
        }
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
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'category_id' => 'required|int',
            'is_paid' => 'required|int',
            'poster' => 'image|mimes:jpeg,jpg,png|max:5120',
            'video_file' => 'mimes:mp4|max:1048576',///I GB file max
        ]);
        $Video = Video::find($id);
        $poster = $request->file('poster');
        $video_file = $request->file('video_file');
        $AuthController = new AuthController();
        $user_id = Auth::user()->id;
        $CategoryController = new CategoryController();
        if($AuthController->is_admin($user_id) !== true){
            $error = 'Only users with administrative roles are allowed to perform this action';
            return redirect()->back()->with('error-message', $error);
        }
        if ($CategoryController->already_exists($request->category_id) == false) {
                $error = 'Unregistered Category ID';
                return redirect()->back()->with('error-message', $error);
            }
        if (isset($poster) && isset($video_file)) {
            $destroy_poster = cloudinary()->destroy($Video->poster_public_id);
            if ($destroy_poster['result'] !== 'ok') {
                $error = 'We were unable to replace the old poster image. Please try again';
                return redirect()->back()->with('error-message', $error);
            }
            $destroy_video_file = cloudinary()->destroy($Video->video_public_id,['resource_type' => 'video']);
            if ($destroy_video_file['result'] !== 'ok') {
                $error = 'We were unable to replace the old video file. Please try again';
                return redirect()->back()->with('error-message', $error);
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
            $success = 'Video updated successfully';
            return redirect()->back()->with('success-message', $success);
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
                $success = 'Video updated successfully';
                return redirect()->back()->with('success-message', $success);
        }
        else{
            $error = 'We were unable to replace the old poster image. Please try again';
            return redirect()->back()->with('error-message', $error);
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
                $success = 'Video updated successfully';
                return redirect()->back()->with('success-message', $success);
        }
        else{
            $error = 'We were unable to replace the old video file. Please try again';
            return redirect()->back()->with('error-message', $error);
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
                $success = 'Video updated successfully';
                return redirect()->back()->with('success-message', $success);
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
        $user_id = Auth::user()->id;
        $CategoryController = new CategoryController();
        if($AuthController->is_admin($user_id) !== true){
            $error='Only users with administrative roles are allowed to perform this action';
            return redirect()->back()->with('error-message', $error);
        }
        if($Video->poster_public_id !== null){
                $destroy_poster = cloudinary()->destroy($Video->poster_public_id);
                if ($destroy_poster['result'] !== 'ok' || !isset($destroy_poster)) {
                    $error='We were unable to remove the old poster image. Please try again';
                    return redirect()->back()->with('error-message', $error);
            }
        }
        if($Video->video_public_id !== null){
            $destroy_video = cloudinary()->destroy($Video->video_public_id,['resource_type' => 'video']);
            if ($destroy_video['result'] !== 'ok') {
                $error='We were unable to remove the old video file. Please try again';
                return redirect()->back()->with('error-message', $error);
            }
        }
        $success='Video removed successfully';
        if($Video->delete()){
            $success='Video removed successfully';
            return redirect()->back()->with('success-message', $success);
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
