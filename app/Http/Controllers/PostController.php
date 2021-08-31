<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category_post;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Models\Comment_post;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['list'] = Post::filterJudul($request->keyword)->filterCategory($request->category)->withCount('comments')->filterPermission()->orderBy('created_at','desc')->paginate(5);
        $data['kategori'] = Category_post::all();
        return view('back.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kategori'] = Category_post::all();
        return view('back.post.create', $data);
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
            'judul' => 'required|max:255',
            'konten' => 'required',
            'category_post_id' => 'required',
        ];

        if (Auth::user()->jenis_akun == 'koperasi') {
            $slug = Str::random(11);
        }else{
            $slug = Str::slug($request->judul);
        }

        $path = null;
        if ($request->file('file')) {
            $validation['file'] = 'file|max:10000';
        }
        
        $request->validate($validation);
        
        if ($request->file('file')) {
            $path = Storage::putFile('public/post/file',$request->file('file'));
        }

        $new = Post::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'konten' => $request->konten,
            'category_post_id' => $request->category_post_id,
            'tag' => $request->tag, 
            'creator_id' => Auth::user()->id,
            'file' => $path
        ]);

        if ($new->save()) {
            Alert::success('Success', 'Postingan berhasil ditambahkan');
            return redirect(route('post.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data['detail'] = Post::where('slug', '=', $slug)->first();
        $data['comments'] = Comment_post::where('post_id', '=', $data['detail']->id)->get();
        return view('back.post.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['kategori'] = Category_post::all();
        $data['detail'] = Post::findOrFail($id);
        return view('back.post.edit', $data);
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
            'judul' => 'required|max:255',
            'konten' => 'required',
            'category_post_id' => 'required',
        ];

        if ($request->file('file')) {
            $validation['file'] = 'file|max:10000';
        }
        
        $request->validate($validation);
        
        $updated = Post::findOrFail($id);

        if ($request->file('file')) {
            $path = Storage::putFile('public/post/file',$request->file('file'));
            Storage::delete($updated->file);
            $updated->file = $path;
        }

        if (Auth::user()->jenis_akun == 'koperasi') {
            $slug = Str::random(11);
        }else{
            $slug = Str::slug($request->judul);
        }

        $updated->judul = $request->judul;
        $updated->slug = $slug;
        $updated->konten = $request->konten;
        $updated->category_post_id = $request->category_post_id;
        $updated->tag = $request->tag; 
        $updated->creator_id = Auth::user()->id;

        if ($updated->save()) {
            Alert::success('Success', 'Postingan berhasil diperbaharui');
            return redirect(route('post.index'));
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

    public function commentStore(Request $request)
    {
        $validation = ['konten' => 'required'];

        $path = null;
        if ($request->file('file')) {
            $validation['file'] = 'file|max:10000';
        }

        $request->validate($validation);

        if ($request->file('file')) {
            $path = Storage::putFile('public/comment/file',$request->file('file'));
        }

        $new = Comment_post::create([
            'konten' => $request->konten,
            'file' => $path,
            'post_id' => $request->post_id,
            'creator_id' => $request->creator_id,
        ]);

        if ($new->save()) {
            return response()->json([
                'status' => 'success',
                'data' => $new
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);

        }
    }

    public function commentDelete(Request $request)
    {
        $delete = Comment_post::findOrFail($request->id);
        if ($delete->file) {
            Storage::delete($delete->file);
        }

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

    public function postDelete(Request $request)
    {
        $delete = Post::findOrFail($request->id);
        if ($delete->file) {
            Storage::delete($delete->file);
        }

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
}
