@extends('layouts.back')
@section('title')
    Create New Topic
@endsection
@section('content')
<br>
<div class="container">
    <div class="tt-wrapper-inner">
        <h1 class="tt-title-border">
            Create New Topic
        </h1>
        <form class="form-default form-create-topic" method="POST" action="{{route('post.post-store')}}">
            @csrf
            <div class="form-group">
                <label for="judul">Judul</label>
                <div class="tt-value-wrapper">
                    <input type="text" name="judul" value="{{old('judul')}}" class="form-control is-invalid" id="judul" placeholder="Subject of your topic">
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
                    <textarea id="konten" name="konten" class="form-control">{!! old('konten') !!}</textarea>
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
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="inputTopicTags">Tags</label>
                            <input type="text" name="tag" class="form-control" id="inputTopicTags" placeholder="Use comma to separate tags">
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
                        <button type="submit" class="btn btn-secondary btn-width-lg">Create Post</button>
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