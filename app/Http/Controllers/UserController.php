<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Cooperative;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['list'] = User::filterName($request->keyword)->paginate(5);
        return view('back.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['koperasi'] = Cooperative::all();
        return view('back.user.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = [
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        if ($request->jenis_akun == 'koperasi') {
            $validation['cooperative_id'] = 'required';
        }
         
        $request->validate($validation);

        $new = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'username' => $request->username,
            'cooperative_id' => $request->cooperative_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($new->save()) {
            Alert::success('Success', 'Pengguna berhasil ditambahkan');
            return redirect(route('users.index'));
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
        $data['detail'] = User::findOrFail($id);
        return view('back.user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['detail'] = User::findOrFail($id);
        $data['koperasi'] = Cooperative::all();
        return view('back.user.edit', $data);
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
        $validation = [
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ];

        if ($request->jenis_akun == 'koperasi') {
            $validation['cooperative_id'] = 'required';
        }
         
        $request->validate($validation);

        $update = User::findOrFail($id);
        $update->name = $request->name;
        $update->nik = $request->nik;
        $update->username = $request->username;
        $update->cooperative_id = $request->cooperative_id;
        $update->email = $request->email;

        if ($update->save()) {
            Alert::success('Success', 'Pengguna berhasil diperbaharui');
            return redirect(route('users.index'));
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
        $delete = User::findOrFail($id);
        if ($delete->delete()) {
            return response()->json([
                'status' => 'Success',
                'data' => $delete,
            ], 200);
        }else{
            return response()->json([
                'status' => 'Error'
            ], 404);
        }
    }

    public function changePassword(Request $request){

        $id = $request->id;
        $user = User::findOrFail($id);

        $request->validate([
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password'
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Password lama anda salah'
            ]);
        }

        $user->password = Hash::make($request->password);

        if ($user->save()) {
            return response()->json([
                'status' => 'success',
                'msg' => 'Password berhasil diperbaharui'
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'msg' => 'Password gagal diperbaharui'
            ]);
        }

    }

    public function userDelete(Request $request)
    {
        $delete = User::findOrFail($request->id);

        if ($delete->delete()) {
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);

        }
    }

    public function userVerifikasi(Request $request)
    {
        $verifikasi = User::findOrFail($request->id);
        $verifikasi->is_verified = '1';

        if ($verifikasi->save()) {
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);

        }
    }

    public function setting(){
        $data['koperasi'] = Cooperative::all();
        return view('back.setting', $data);
    }
}
