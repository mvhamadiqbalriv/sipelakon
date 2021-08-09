@extends('layouts.back')
@section('title')
    Tambah Postingan Baru
@endsection
@section('content')
<br>
<div class="container">
    <div class="tt-wrapper-inner">
        <h1 class="tt-title-border">
            Tambah Postingan Baru
        </h1>
        <form class="form-default form-create-topic" method="POST" action="{{route('post.post-store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="judul">Judul <sup style="color:red">*</sup></label>
                <div class="tt-value-wrapper">
                    <input type="text" name="judul" value="{{old('judul')}}" class="form-control is-invalid" id="judul" placeholder="Judul dari Postingan">
                </div>
                @error('judul')
                    <div class="tt-note" style="color:red">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="pt-editor">
                <h6 class="pt-title">Isi <sup style="color:red">*</sup></h6>
                <div class="form-group">
                    <textarea id="konten" name="konten" class="form-control">{!! old('konten') !!}</textarea>
                    @error('konten')
                        <div class="tt-note" style="color:red">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label >Category <sup style="color:red">*</sup></label>
                            <select name="category_post_id" class="form-control">
                                <option value="">-- Select --</option>
                                @foreach ($kategori as $item)
                                    @php
                                        if($item->nama == 'Informasi' && Auth::user()->jenis_akun == 'koperasi'){
                                            continue;
                                        }
                                    @endphp
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_post_id')
                            <div class="tt-note" style="color:red">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="inputTopicTags">Tags</label>
                            <input type="text" name="tag" class="form-control" id="inputTopicTags" placeholder="Gunakan koma untuk memisahkan tag">
                            @error('tag')
                                <div class="tt-note" style="color:red">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="file">Sematkan File</label>
                            <input type="file" name="file" class="form-control" id="file" >
                            @error('file')
                                <div class="tt-note" style="color:red">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <small class="italic">NB: Inputan dengan tanda (<sup title="Wajib diisi" style="color:red">*</sup>) Wajib diisi.</small>
                 <div class="row">
                    <div class="col-auto ml-md-auto">
                        <button type="submit" class="btn btn-secondary btn-width-lg">Tambah Postingan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
  </script>
  <script>
    CKEDITOR.replace('konten', options);
  </script>
    
@endsection