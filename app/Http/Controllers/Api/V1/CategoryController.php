<?php
namespace App\Http\Controllers\Api\V1;

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
        return new CategoryCollection($categories);
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
            'name' => 'required|string|max:45|unique:categories',
            'description' => 'required|string',
            'banner' => 'required|image|mimes:jpeg,jpg,png|max:5120',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
        $user_id = auth('api')->user()->id;
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
                return response()->json([
                    'message'=>'New category added'
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
        $category = Category::find($id);
        return response()->json([
            'data'=>[
                'id'=>$category->id,
                'name'=>$category->name,
                'description'=>$category->description,
                'banner'=>$category->banner
            ]
        ],200);
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
        $user_id = auth('api')->user()->id;
        $AuthController = new AuthController();
        if($AuthController->is_admin($user_id) !== true){
            return response()->json([
                    'message' => 'Only users with administrative roles are allowed to perform this action',
                ]);
        }
        $category = Category::find($id);
        $banner = $request->file('banner');
        if (isset($banner)) {
            // return $category->banner_public_id;
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
                $category->save();
                    return response()->json([
                        'message'=>'Category updated successfully',
                        ],200);
        }
        else{
            return response()->json([
                        'message'=>'We were unable to remove the old banner image. Please try again',
                        ],501);
        }
        }
        else{
                $category->name = $request->name;
                $category->description = $request->description;
                $category->save();
                    return response()->json([
                        'message'=>'Category updated successfully',
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
        $category = Category::find($id);
        $user_id = auth('api')->user()->id;
        $AuthController = new AuthController();
        if($AuthController->is_admin($user_id) !== true){
            return response()->json([
                    'message' => 'Only users with administrative roles are allowed to perform this action',
                ]);
        }
        $destroy_banner = cloudinary()->destroy($category->banner_public_id);
            if ($destroy_banner['result'] == 'ok') {
                if($category->delete()){
                    return response()->json([
                        'message'=>'category removed successfully'
                    ]);
                }
            }else{
            return response()->json([
                        'message'=>'We were unable to remove the old banner image. Please try again',
                        ],501);
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
