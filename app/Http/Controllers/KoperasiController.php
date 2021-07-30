<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cooperative;
use App\Models\District;
use App\Models\Category_cooperative;
use Illuminate\Support\Str;

class KoperasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return view('cooperative_register', $data);
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
            'category_cooperative_id' => 'required',
            'alamat' => 'required|unique:cooperatives'
        ]);

        $new = Cooperative::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'village_id' => $request->village_id,
            'district_id' => $request->district_id,
            'category_cooperative_id' => $request->category_cooperative_id,
            'alamat' => $request->alamat,
            'slug' => Str::slug($request->name),
        ]);

        if ($new->save()) {
            return redirect()
            ->back()
            ->with('success', 'Your koperasi has been added!');
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
        //
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
}
