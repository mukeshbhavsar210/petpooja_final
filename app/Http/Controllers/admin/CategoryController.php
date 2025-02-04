<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Flash;
use App\Models\Category;
use App\Models\Menu;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = Category::latest();
        $menus = DB::table('menus')
                    ->join('categories', 'categories.id', '=', 'menus.category_id')
                    ->select('menus.category_id AS id',
                    DB::raw("count(categories.id) AS total_products"))
                    ->groupBy('menus.category_id')
                    ->get();

        //$userNames = Menu::pluck('slug'); 

        //$menus = Menu::orderBy('name','ASC')->get();

        $totalMenu = DB::table('categories')
                    ->select(DB::raw('count(*) as total'))
                    ->get()[0]->total;

        $menuCount = DB::table('menus')
                    ->select(DB::raw('count(*) as total'))
                    ->get()[0]->total;

        if(!empty($request->get('keyword'))){
            $categories = $categories->where('name', 'like', '%'.$request->get('keyword').'%');
        }

        $categories = $categories->paginate(10);

        $data['categories'] = $categories;
        $data['totalMenu'] = $totalMenu;
        $data['menus'] = $menus;
        $data['menuCount'] = $menuCount;

        //dd($userNames);
        
        return view('admin.category.list', $data);
    }

   


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
                   
        ]);

        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->save();

            // Save image here
            // if (!empty($request->image_id)) {
            //     $tempImage = TempImage::find($request->image_id);
            //     $extArray = explode('.',$tempImage->name);
            //     $ext = last($extArray);

            //     $newImageName = $category->id.'_'.$category->name.'.'.$ext;                
            //     $sPath = public_path().'/temp/'.$tempImage->name;
            //     $dPath = public_path().'/uploads/category/'.$newImageName;                
            //     File::copy($sPath,$dPath);

            //     //Generate thumbnail
            //     $dPath = public_path().'/uploads/category/thumb/'.$newImageName;
            //     $manager = new ImageManager(new Driver());
            //     $image = $manager->read($sPath);
            //     $image->cover(400,300);
            //     $image->save($dPath);
            //     $image->save($dPath);                                  
            //     $category->image = $newImageName;
            //     $category->save();
            // }

            $request->session()->flash('success', 'Category added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Category added successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }



    public function edit($categoryId, Request $request){
        $category = Category::find($categoryId);

        if (empty($category)) {
            return redirect()->route('categories.index');
        }

        return view('admin.category.edit', compact('category'));
    }



    public function update($categoryId, Request $request){

        $category = Category::find($categoryId);

        if (empty($category)) {
            $request->session()->flash('error', 'Category not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Category not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id.',id',
        ]);

        if ($validator->passes()) {
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            $oldImage = $category->image;

            // Save image here
            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/category/'.$newImageName;
                File::copy($sPath,$dPath);

                //Generate image thumbnail
                $dPath = public_path().'/uploads/category/thumb/'.$newImageName;
                File::copy($sPath,$dPath);

                $category->image = $newImageName;
                $category->save();

                //Delete old image
                File::delete(public_path().'/uploads/category/thumb/'.$oldImage);
                File::delete(public_path().'/uploads/category/'.$oldImage);
            }

            $request->session()->flash('success', 'Category updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($categoryId, Request $request){
        $category = Category::find($categoryId);

        if(empty($category)){
            $request->session()->flash('error', 'Category not found');
            return response()->json([
                'status' => true,
                'message' => 'Category not found'
            ]);
            //return redirect()->route('categories.index');
        }

        //Delete old image
        File::delete(public_path().'/uploads/category/thumb/'.$category->image);
        File::delete(public_path().'/uploads/category/'.$category->image);

        $category->delete();

        $request->session()->flash('success', 'Category deleted successfully');

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
}
