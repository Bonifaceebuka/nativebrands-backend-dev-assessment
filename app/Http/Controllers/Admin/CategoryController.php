<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Resources\CategoryCollection;
use Auth;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');        
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
            'name' => 'required|string|max:45|unique:categories',
            'description' => 'required|string',
            'banner' => 'required|image|mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:5120',
        ]);
        $user_id = Auth::user()->id;
        $AuthController = new AuthController();
        if($AuthController->is_admin($user_id) == true){
            $banner_name = strtolower($request->name.'-'.time());
            $banner_file = $request->file('banner')->storeOnCloudinaryAs('tacc-app/images/categories',$banner_name);          
            $banner = $banner_file->getSecurePath();
            $banner_pubID = $banner_file->getPublicId();
            $category = new Category([
                'name'=>$request->name,
                'description'=>$request->description,
                'banner'=>$banner,
                'banner_public_id'=>$banner_pubID,
            ]);
            if($category->save()){
                $success='Category created successfully.';
                return redirect()->back()->with('success-message', $success);
            }
            else{
                $error ='Category was not successfully created.';
                return redirect()->back()->with('error-message', $error );
            }
        }else{
                $error='Only users with administrative roles are allowed to perform this action';
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
        $category = Category::find($id);
        return view('admin.categories.edit',['category'=>$category]);
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
            'name' => 'required|string|max:45',
            'description' => 'required|string',
            'banner' => 'image|mimes:jpeg,jpg,png|max:5120',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
        $user_id = Auth::user()->id;
        $AuthController = new AuthController();
        if($AuthController->is_admin($user_id) !== true){
            $error='Only users with administrative roles are allowed to perform this action';
            return redirect()->back()->with('error-message', $error);
        }
        $category = Category::find($id);
        $banner = $request->file('banner');
        if (isset($banner)) {
            // return $category->banner_public_id;
            if($category->banner_public_id !== null){
                    $destroy_banner = cloudinary()->destroy($category->banner_public_id);
                    if ($destroy_banner['result'] == 'ok') {
                        $banner_name = strtolower($request->name.'-'.time());
                        $banner_file = $banner->storeOnCloudinaryAs('tacc-app/images/categories',$banner_name);
                        $banner = $banner_file->getSecurePath();
                        $banner_pubID = $banner_file->getPublicId();
                        $category->name = $request->name;
                        $category->description = $request->description;
                        $category->banner = $banner;
                        $category->banner_public_id = $banner_pubID;
                        
                        if($category->save()){
                            $success='Category updated successfully.';
                            return redirect()->back()->with('success-message', $success);
                        }
                        else{
                            $error ='Category was not successfully updated.';
                            return redirect()->back()->with('error-message', $error );
                        }
                }
                else{
                    $error ='We were unable to remove the old banner image. Please try again';
                    return redirect()->back()->with('error-message', $error );
                }
            }
            else{
                    $banner_name = strtolower($request->name.'-'.time());
                    $banner_file = $banner->storeOnCloudinaryAs('tacc-app/images/categories',$banner_name);
                    $banner = $banner_file->getSecurePath();
                    $banner_pubID = $banner_file->getPublicId();
                    $category->name = $request->name;
                    $category->description = $request->description;
                    $category->banner = $banner;
                    $category->banner_public_id = $banner_pubID;
                    
                    if($category->save()){
                        $success='Category updated successfully.';
                        return redirect()->back()->with('success-message', $success);
                    }
                    else{
                        $error ='Category was not successfully updated.';
                        return redirect()->back()->with('error-message', $error );
                    }
            }
              
        }
        else{
                $category->name = $request->name;
                $category->description = $request->description;
                if($category->save()){
                    $success='Category updated successfully.';
                    return redirect()->back()->with('success-message', $success);
                }
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
        $category = Category::find($id);
        $user_id = Auth::user()->id;
        $AuthController = new AuthController();
        if($AuthController->is_admin($user_id) !== true){
            $error='Only users with administrative roles are allowed to perform this action';
            return redirect()->back()->with('error-message', $error);
        }
        if($category->banner_public_id !== null){
            $destroy_banner = cloudinary()->destroy($category->banner_public_id);
            if (isset($destroy_banner['result']) && $destroy_banner['result'] == 'ok') {
                if($category->delete()){
                    $success='category removed successfully';
                    return redirect()->back()->with('success-message', $success);
                }
            }else{
            $success='We were unable to remove the old banner image. Please try again';
            return redirect()->back()->with('success-message', $success);
        }
        }
        else{
            if($category->delete()){
                $success='category removed successfully';
                return redirect()->back()->with('success-message', $success);
            }else{
                $error='category was not removed successfully';
                return redirect()->back()->with('error-message', $error);
            }
        }
        
        
    }

    public function already_exists($name){
        if (is_numeric($name)) {
           if(Category::find($name) !=null){
                return true;
                }
                else{
                    return false;
                }
        }
        else{
            if(Category::where('name',$name)->first() !=null){
            return false;
                }
                else{
                    return true;
                }
        }
    
}
}
