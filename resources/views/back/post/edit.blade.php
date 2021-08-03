@extends('layouts.back')
@section('title')
    Perbaharui Postingan
@endsection
@section('content')
<br>
<div class="container">
    <div class="tt-wrapper-inner">
        <h1 class="tt-title-border">
            Perbaharui Postingan
        </h1>
        <form class="form-default form-create-topic" method="POST" action="{{route('post.update', $detail->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="judul">Judul</label>
                <div class="tt-value-wrapper">
                    <input type="text" name="judul" value="{{$detail->judul ?? old('judul')}}" class="form-control is-invalid" id="judul" placeholder="Judul dari Postingan">
                </div>
                @error('judul')
                    <div class="tt-note" style="color:red">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="pt-editor">
                <h6 class="pt-title">Isi</h6>
                <div class="form-group">
                    <textarea id="konten" name="konten" class="form-control">{!! $detail->konten ?? old('konten') !!}</textarea>
                    @error('konten')
                        <div class="tt-note" style="color:red">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Category</label>
                            <select name="category_post_id" class="form-control">
                                <option value="">-- Select --</option>
                                @foreach ($kategori as $item)
                                    @php
                                        $selected = $detail->category_post_id;
                                        if (old('category_post_id') != null) {
                                            $selected = old('category_post_id');
                                        }
                                    @endphp
                                    <option value="{{$item->id}}" {{($selected == $item->id) ? 'selected' : null}}>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_post_id')
                            <div class="tt-note" style="color:red">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="inputTopicTags">Tags</label>
                            <input type="text" name="tag" value="{{$detail->tag ?? old('tag')}}" class="form-control" id="inputTopicTags" placeholder="Gunakan koma untuk memisahkan tag">
                            @error('tag')
                                <div class="tt-note" style="color:red">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-auto ml-md-auto">
                        <button type="submit" class="btn btn-secondary btn-width-lg">Perbaharui Postingan</button>
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