<?php

namespace App\Http\Controllers;

use App\Models\Category_cooperative;
use Illuminate\Http\Request;
use App\Models\Cooperative;
use App\Models\District;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Village;

class CooperativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['list'] = Cooperative::filterName($request->keyword)->filterKecamatan($request->kecamatan)->orderBy('created_at', 'desc')->paginate(5);
        $data['kecamatan'] = District::where('regency_id', '=', 3211)->get();
        $data['keyword'] = $request->keyword ?? null;
        return view('back.cooperative.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kecamatan'] = District::where('regency_id', '=', 3211)->get();
        $data['jenis_usaha'] = Category_cooperative::all();
        return view('back.cooperative.create', $data);
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
            'name' => 'required|string|max:255|unique:cooperatives',
            'nik' => 'required|string|unique:cooperatives',
            'village_id' => 'required',
            'district_id' => 'required',
            'category' => 'required',
            'alamat' => 'required'
        ]);

        $new = Cooperative::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'village_id' => $request->village_id,
            'district_id' => $request->district_id,
            'alamat' => $request->alamat,
            'slug' => Str::slug($request->name),
            'is_verified' => '1'
        ]);

        $new->kategori()->attach($request->category);

        if ($new->save()) {
            Alert::success('Success', 'Koperasi berhasil ditambahkan');
            return redirect(route('cooperative.index'));
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
        $data['detail'] = Cooperative::findOrFail($id);
        $data['kecamatan'] = District::where('regency_id', '=', 3211)->get();
        $data['desa'] = Village::where('district_id', '=', $data['detail']->district_id)->get();
        $data['jenis_usaha'] = Category_cooperative::all();
        return view('back.cooperative.edit', $data);
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
            'name' => 'required|string|max:255|unique:cooperatives,name,'.$id,
            'nik' => 'required|string|unique:cooperatives,nik,'.$id,
            'village_id' => 'required',
            'district_id' => 'required',
            'category' => 'required',
            'alamat' => 'required'
        ]);

        $update = Cooperative::findOrFail($id);
        $update->name = $request->name;
        $update->nik = $request->nik;
        $update->village_id = $request->village_id;
        $update->district_id = $request->district_id;
        $update->alamat = $request->alamat;
        $update->slug = Str::slug($request->name);

        $update->kategori()->sync($request->category);

        if ($update->save()) {
            Alert::success('Success', 'Koperasi berhasil diperbaharui');
            return redirect(route('cooperative.index'));
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
        //
    }

    public function cooperativeDelete(Request $request)
    {
        $delete = Cooperative::findOrFail($request->id);
        $delete->kategori()->detach($delete->kategori);

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

    public function cooperativeVerifikasi(Request $request)
    {
        $verifikasi = Cooperative::findOrFail($request->id);
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
}
