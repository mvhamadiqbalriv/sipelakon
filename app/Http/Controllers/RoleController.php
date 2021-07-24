<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Role_has_permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['list'] = Role::all();
        $data['permission'] = Permission::all();
        return view('back.role',$data);
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
        $request->validate([
            'name' => 'required|max:50|unique:roles',
            'permission' => 'required'
        ]);

        $new = Role::create(['name' => $request->name, 'guard_name' => 'web']);
        $new->syncPermissions($request->permission);

        if ($new->save()) {
            return response()->json([
                'status' => 'Success',
                'data' => $new
            ], 200);
        }else{
            return response()->json([
                'status' => 'Error'
            ], 500);

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
        //
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
        $request->validate([
            'name' => 'required|max:50|unique:roles,name,'.$id
        ]);

        $update = Role::findOrFail($id);
        $update->name = $request->name;

        if ($update->save()) {
            return response()->json([
                'status' => 'Success',
                'data' => $update
            ], 200);
        }else{
            return response()->json([
                'status' => 'Error'
            ], 500);

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
        $delete = Role::findOrFail($id);

        if ($delete->delete()) {
            return response()->json([
                'status' => 'Success',
            ], 200);
        }else{
            return response()->json([
                'status' => 'Error'
            ], 500);

        }
    }

    public function roleHasPermission($id){

        $roleHasPermissions = Role_has_permission::join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                                                ->select('role_has_permissions.*', 'permissions.name')
                                                ->where('role_has_permissions.role_id', '=', $id)
                                                ->get();

        if ($roleHasPermissions) {
            return response()->json($roleHasPermissions, 200);
        }else{
            return response()->json([
                'message' => 'Terjadi kesalahan, silahkan coba lagi !'
            ], 500);
        }

    }
}
