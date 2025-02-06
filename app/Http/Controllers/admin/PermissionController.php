<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller implements HasMiddleware 
{
    public static function middleware(): array {
        return [
                new Middleware('permission:view permissions', only: ['index']),
                new Middleware('permission:edit permissions', only: ['edit']),
                new Middleware('permission:create permissions', only: ['create']),
                new Middleware('permission:delete permissions', only: ['destroy']),
            ];
        }

    public function index(){
        $permissions = Permission::orderBy('created_at','DESC')->paginate(10);

        $totalPermissions = DB::table('permissions')
                    ->select(DB::raw('count(*) as total'))
                    ->get()[0]->total;

        return view("admin.permissions.list", [
            'permissions' => $permissions,
            'totalPermissions' => $totalPermissions
        ]);
    }

    public function create(){
        return view("admin.permissions.create");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|unique:permissions|min:3'
        ]);        

        if($validator->passes()){
            Permission::create([ 'name' => $request->name ]);

            return redirect()->route('permissions.index')->with('success','Permission added successfully.');
        } else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }
    }

    public function edit($id){
        $permission = Permission::findOrFail($id);

        return view("admin.permissions.edit", [
            'permission' => $permission
        ]);
    }

    public function update($id, Request $request){
        $permission = Permission::findOrFail($id);

        $validator = Validator::make($request->all(), [ 
            'name' => 'required|min:3|unique:permissions,name,'.$id.',id'
        ]);        

        if($validator->passes()){
            $permission->name = $request->name;
            $permission->save();

            return redirect()->route('permissions.index')->with('success','Permission updated successfully.');
        } else {
            return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validator);
        }
    }

    public function destroy(Request $request){
        $id = $request->id;

        $permission = Permission::findOrFail($id);

        if($permission == null){
            session()->flash('error','Permission not found');
            return response()->json([
                'status' => false
            ]);
        }

        $permission->delete();

        session()->flash('success','Permission deleted successfully');
        return response()->json([
            'status' => true
        ]);
    }
}
