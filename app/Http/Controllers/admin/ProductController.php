<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductView;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {

    public function index(Request $request){
        $products = Product::latest('id')->with('product_images');
        $categories = Category::orderBy('name','ASC')->get();  
        
        $menuCount = DB::table('products')
                    ->select(DB::raw('count(*) as total_products'))
                    ->get()[0]->total_products;

        $products = $products->paginate();

        $data['products'] = $products;
        $data['categories'] = $categories;  
        $data['menuCount'] = $menuCount;            

        return view ('admin.products.list', $data);
    }


    public function create(){
        $data = [];
        $categories = Category::orderBy('name','ASC')->get();        
        $data['categories'] = $categories;

        return view('admin.products.create', $data);
    }


    public function store(Request $request){
        $rules = [
            'name' => 'required',                            
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->passes()) {
            $product = new Product;
            $product->name = $request->name;            
            $product->slug = $request->slug;                 
            $product->category_id = $request->category;
            $product->menu_id = $request->menu;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->veg_nonveg = $request->veg_nonveg;
            $product->save();

        // Save image here
        if (!empty($request->image_id)) {
            $tempImage = TempImage::find($request->image_id);
            $extArray = explode('.',$tempImage->name);
            $ext = last($extArray);

            $newImageName = $product->id.'_'.$product->name.'.'.$ext;                
            $sPath = public_path().'/temp/'.$tempImage->name;
            $dPath = public_path().'/uploads/product/'.$newImageName;                
            File::copy($sPath,$dPath);

            //Generate thumbnail
            $dPath = public_path().'/uploads/product/thumb/'.$newImageName;
            $manager = new ImageManager(new Driver());
            $image = $manager->read($sPath);
            $image->cover(400,300);
            $image->save($dPath);
            $image->save($dPath);                                  
            $product->image = $newImageName;
            $product->save();
        }

        if (!empty($request->image_array)) {
            foreach ($request->image_array as $temp_image_id) {
                $tempImageInfo = TempImage::find($temp_image_id);
                $extArray = explode('.',$tempImageInfo->name);
                $ext = last($extArray);

                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = "NULL";
                $productImage->save();
                $imageName = $product->id.'-'.$productImage->id.'-'.time().'.'.$ext;
                $productImage->image = $imageName;
                $productImage->save();

                //Large Image
                $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                $destPath = public_path().'/uploads/product/large/'.$imageName;
                $manager = new ImageManager(new Driver());
                $image = $manager->read($sourcePath);
                // $image->resize(1000, null, function ($constraint) {
                //     $constraint->aspectRatio();
                // });
                $image->save($destPath);

                //Generate Thumnail
                $destPath = public_path().'/uploads/product/small/'.$imageName;
                $manager = new ImageManager(new Driver());
                $image = $manager->read($sourcePath);
                $image->cover(400,300);
                $image->save($destPath);
            }

        }

        $request->session()->flash('success','Menu added successfully');

        return response()->json([
            'status' => true,
            'message' => 'Menu added successfully'
        ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function view_store(Request $request){
        $rules = [
                                    
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->passes()) {
            $product = new ProductView;
            $product->toggleActive()->save();          
            //$product->name = $request->view;  
            //$product->save();

            $request->session()->flash('success','View set successfully');

            return response()->json([
                'status' => true,
                'message' => 'View set successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }



    public function edit($id, Request $request){
        $product = Product::find($id);

        if (empty($product)) {
            return redirect()->route('products.index')->with('error','Product not found');
        }

        //Fetch Product Images
        $productImages = ProductImage::where('product_id',$product->id)->get();
        $subCategories = Menu::where('category_id',$product->category_id)->get();
        $categories = Category::orderBy('name','ASC')->get();

        $data = [];
        
        $data['categories'] = $categories;
        $data['product'] = $product;
        $data['subCategories'] = $subCategories;
        $data['productImages'] = $productImages;        

        return view('admin.products.edit',$data);
    }




    public function update($id, Request $request){
        $product = Product::find($id);
        $rules = [
            'name' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->passes()) {
            $product->name = $request->name;            
            $product->slug = $request->slug;     
            $product->category_id = $request->category;
            $product->menu_id = $request->menu;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->veg_nonveg = $request->veg_nonveg;
            $product->save();

        $request->session()->flash('success','Product updated successfully');

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully'
        ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id, Request $request){
        $product = Product::find($id);

        if (empty($product)) {
            $request->session()->flash('error','Product not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
            ]);
        }
        $product->delete();
        $productImages = ProductImage::where('product_id',$id)->get();

        if (!empty($productImages)) {
            foreach ($productImages as $productImage) {
                File::delete(public_path('uploads/product/large/'.$productImage->image));
                File::delete(public_path('uploads/product/small/'.$productImage->image));
            }

            ProductImage::where('product_id',$id)->delete();
        }

        

        $request->session()->flash('success','Product deleted successfully');

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully',
        ]);
    }

    public function getProducts(Request $request){

        $tempProduct = [];

        if($request->term != ""){
            $products = Product::where('title','like','%'.$request->term.'%')->get();

            if ($products != null){
                foreach ($products as $product){
                    $tempProduct[] = array(
                        'id' => $product->id,
                        'text' => $product->title,
                    );
                }
            }
        }

        return response()->json([
            'tags' => $tempProduct,
            'status' => true,
        ]);


    }
}
