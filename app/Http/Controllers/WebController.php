<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Web;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['detail'] = Web::findOrFail(1);
        return view('back.web', $data);
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

        $detail = Web::findOrFail(1);
        
        $validation = ([
            'instagram' => 'required',
            'whatsapp' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'email' => 'required',
        ]);

        if (empty($detail->logo) && empty($request->file('logo'))) {
            $validation['logo'] = 'required|mimes:png,jpeg,jpg|max:1024';
        }
        if (!empty($request->file('logo'))) {
            if (!empty($detail->logo)) {
                Storage::delete($detail->logo);
            }
            $path = Storage::put('public/web', $request->file('logo'));
            $detail->logo = $path;
        }

        $request->validate($validation);

        $detail->instagram = $request->post('instagram');
        $detail->twitter = $request->post('twitter');
        $detail->facebook = $request->post('facebook');
        $detail->email = $request->post('email');
        $detail->whatsapp = $request->post('whatsapp');

        if ($detail->save()) {
            return response()->json([
                'status' => 'Success',
                'data' => $detail,
            ], 200);
        }else{
            return response()->json([
                'status' => 'Gagal',
                'data' => $detail,
            ], 404);
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
