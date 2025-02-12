<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
//use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\User;

class ConfigurationController extends Controller
{
    public function index(){
        $configurations = Configuration::get();

        return view("admin.configurations.list", [
            'configurations' => $configurations
        ]);
    }

    public function create(){        
        return view("admin.configurations.create");
    }

    public function update(Request $request){
        $configurations = Configuration::first()->update($request->all());
        //$configurations->name = $request->name;
        // $configurations->logo = $request->logo;
        // $configurations->email = $request->email;
        // $configurations->phone = $request->phone;
        // $configurations->address = $request->address;
        // $configurations->theme = $request->theme;
        //$configurations->save();

        return redirect()->route('configurations.index')->with('success','Configuration updated successfully.');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            //'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);   

        $filepath = null;        

        if($validator->passes()){
            $data = new Configuration();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->primary_color = $request->primary_color;
            $data->secondary_color = $request->secondary_color;

            //Image upload
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $fileName = $data->name.'_'.time().'.'.$extenstion;
            $path = public_path().'/uploads/logo/'.$fileName;
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $image->toJpeg(80)->save($path);
            $image->cover(300,300)->save($path);
            $data->image = $fileName;
            
            $data->save();

            return redirect()->route('configurations.index')->with('success','Configurations added successfully.');
        } else {
            return redirect()->route('configurations.index')->withInput()->withErrors($validator);
        }
    }

    // public function store(Request $request){
    //     $validator = Validator::make($request->all(), [ 
    //         'name' => 'required',
    //         //'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
    //     ]);   

    //     $imageName = time().'.'.$request->image->extension();

    //     // Public Folder
    //     //$request->image->move(public_path('website_logo'), $imageName);
    //     $request->image->storeAs('website_logo', $imageName);
        
    //     if($validator->passes()){
    //         $data = new Configuration();
    //         $data->name = $request->name;
    //         $data->email = $request->email;
    //         $data->phone = $request->phone;
    //         $data->address = $request->address;
    //         $data->primary_color = $request->primary_color;
    //         $data->secondary_color = $request->secondary_color;
    //         $data->save();

    //         if($request->hasfile('image')) {
    //             $image = $request->file('image');
    //             $extenstion = $image->getClientOriginalExtension();
    //             $newImageName = $data->id.'_'.$data->name.'.'.$extenstion;
    //             $image->move('website_logo/', $newImageName);
    //             $data->image = $newImageName;
    //             $data->save();
    //         }

    //         return redirect()->route('configurations.index')->with('success','Configurations added successfully.');
    //     } else {
    //         return redirect()->route('configurations.index')->withInput()->withErrors($validator);
    //     }
    // }

    public function edit(){
        $configuration = Configuration::all();

        return view("admin.configurations.edit", [
            'configuration' => $configuration
        ]);
    }

    

    public function destroy(Request $request){
        $id = $request->id;

        $configuration = Configuration::findOrFail($id);

        if($configuration == null){
            session()->flash('error','Configuration not found');
            return response()->json([
                'status' => false
            ]);
        }

        $configuration->delete();

        session()->flash('success','Configuration deleted successfully');
        return response()->json([
            'status' => true
        ]);
    }


    public function update_logo(Request $request){
        $validator = Validator::make($request->all(),[
            'image' => 'required|image',
        ]);

        $id = Auth::user()->id;
        
        if($validator->passes()) {
            $user = User::find($id);
            $user->restaurant_logo = $request->image;
            $ext = $user->restaurant_logo->getClientOriginalExtension();
            $imageName = $id.'-'.$user->restaurant_name.'.'.$ext;
            $user->restaurant_logo->move(public_path('/website_logo/'), $imageName);

            //Delete old profile pic
            File::delete(public_path('/website_logo/'.Auth::user()->restaurant_logo));            
            User::where('id',$id)->update(['restaurant_logo' => $imageName]);

            session()->flash('success','Logo updated successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
}
