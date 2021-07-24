<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['list'] = User::all();
        return view('back.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = ([
            'name' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
            'username' => 'required|unique:users|max:20|min:6|alpha_dash',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            'email' => 'required|unique:users',
            'telepon' => 'required|unique:users|max:13',
        ]);
        if (empty($request->file('photo'))) {
            $validation['photo'] = 'mimes:jpeg,bmp,png,jpg|max:2048';
        };
        $request->validate($validation);

        $path = null;
        if (!empty($request->file('photo'))) {
            $path = Storage::put('public/user', $request->file('photo'));
        }

        $new = new User([
            'name' => $request->post('name'),
            'username' => $request->post('username'),
            'email' => $request->post('email'),
            'password' => bcrypt($request->post('password')),
            'telepon' => $request->post('telepon'),
            'jenis_kelamin' => $request->post('jenis_kelamin'),
            'tempat_lahir' => $request->post('tempat_lahir'),
            'tanggal_lahir' => $request->post('tanggal_lahir'),
            'alamat' => $request->post('alamat'),
            'photo' => $path
        ]);

        if ($new->save()) {
            return redirect('/users')->with('success', 'Pengguna berhasil ditambahkan!');
        }else{
            return redirect('/users')->with('error', 'Pengguna gagal ditambahkan!');
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
        $validation = ([
            'name' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
            'username' => 'required|max:20|min:6|alpha_dash|unique:users,username,'.$id,
            'email' => 'required|unique:users,email,'.$id,
            'telepon' => 'required|max:13|unique:users,telepon,'.$id,
        ]);
        if (empty($request->file('photo'))) {
            $validation['photo'] = 'mimes:jpeg,bmp,png,jpg|max:2048';
        };
        $request->validate($validation);

        $update = User::findOrFail($id);

        if (!empty($request->file('photo'))) {
            if (!empty($update->photo)) {
                Storage::delete($update->photo);
            }
            $path = Storage::put('public/user', $request->file('photo'));
            $update->photo = $path;
        }

        $update->name = $request->post('name');
        $update->username = $request->post('username');
        $update->email = $request->post('email');
        $update->telepon = $request->post('telepon');
        $update->jenis_kelamin = $request->post('jenis_kelamin');
        $update->tempat_lahir = $request->post('tempat_lahir');
        $update->tanggal_lahir = $request->post('tanggal_lahir');
        $update->alamat = $request->post('alamat');

        if ($update->save()) {
            return redirect('/users')->with('success', 'Pengguna berhasil diperbaharui!');
        }else{
            return redirect('/users')->with('error', 'Pengguna gagal diperbaharui!');
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

    public function changePassword(Request $request, $id){

        $user = User::findOrFail($id);

        $request->validate([
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:new_password'
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect(route('users.edit', $id))->with('error', 'Password lama anda salah!');
        }

        $user->password = Hash::make($request->new_password);

        if ($user->save()) {
            return redirect(route('users.edit', $id))->with('success', 'Password berhasil diperbaharui!');
        }else{
            return redirect(route('users.edit', $id))->with('error', 'Password gagal diperbaharui!');
        }

    }
}
