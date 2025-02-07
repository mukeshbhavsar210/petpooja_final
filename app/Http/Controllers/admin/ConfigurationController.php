<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ConfigurationController extends Controller
{
    public function index(){
        $configurations = Configuration::get();

        return view("admin.configurations.list", [
            'configurations' => $configurations
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [ 
            'name' => 'required'
        ]);        

        if($validator->passes()){
            $data = new Configuration();
            $data->name = $request->name;
            $data->image = $request->image;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->primary_color = $request->primary_color;
            $data->secondary_color = $request->secondary_color;
            $data->save();

            // if (!empty($request->image_id)) {
            //     $tempImage = TempImage::find($request->image_id);
            //     $extArray = explode('.',$tempImage->name);
            //     $ext = last($extArray);

            //     $newImageName = $data->name.'.'.$ext;                
            //     $sPath = public_path().'/temp/'.$tempImage->name;
            //     $dPath = public_path().'/uploads/website_logo/'.$newImageName;                
            //     File::copy($sPath,$dPath);
            //     $data->save();

            //     // //Generate thumbnail
            //     // $dPath = public_path().'/uploads/website_logo/'.$newImageName;
            //     // $manager = new ImageManager(new Driver());
            //     // $image = $manager->read($sPath);
            //     // $image->cover(400,300);
            //     // $image->save($dPath);
            //     // $image->save($dPath);                                  
            //     // $data->image = $newImageName;
            //     // $data->save();
            // }

            return redirect()->route('configurations.index')->with('success','Configurations added successfully.');
        } else {
            return redirect()->route('configurations.create')->withInput()->withErrors($validator);
        }
    }

    public function edit($id){
        $configuration = Configuration::findOrFail($id);

        return view("admin.configurations.edit", [
            'configuration' => $configuration
        ]);
    }

    public function update($id, Request $request){
        $configuration = Configuration::findOrFail($id);

        $validator = Validator::make($request->all(), [ 
            'name' => 'required|min:3|unique:configurations,name,'.$id.',id'
        ]);        

        if($validator->passes()){
            $configuration->name = $request->name;
            $configuration->logo = $request->logo;
            $configuration->email = $request->email;
            $configuration->phone = $request->phone;
            $configuration->address = $request->address;
            $configuration->theme = $request->theme;
            $configuration->save();

            return redirect()->route('configurations.index')->with('success','Configuration updated successfully.');
        } else {
            return redirect()->route('configurations.edit',$id)->withInput()->withErrors($validator);
        }
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
}
