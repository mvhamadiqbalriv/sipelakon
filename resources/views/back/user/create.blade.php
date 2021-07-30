@extends('layouts.back')
@section('title')
    Create User
@endsection
@section('content')
<br>
<div class="container">
    <div class="tt-wrapper-inner">
        <h1 class="tt-title-border">
            Create User
        </h1>
        <form class="form-default form-create-topic" method="POST" action="{{route('users.store')}}">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <div class="tt-value-wrapper">
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Nama Lengkap">
                </div>
                @error('name')
                    <div class="tt-note" style="color:red">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">NIK</label>
                <div class="tt-value-wrapper">
                    <input type="text" name="nik" value="{{old('nik')}}" class="form-control" id="nik" placeholder="Nomor Induk Kepegawaian">
                </div>
                @error('nik')
                    <div class="tt-note" style="color:red">
                        {{$message}}
                    </div>
                @enderror
            </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="tt-value-wrapper">
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Alamat Email">
                            </div>
                            @error('email')
                                <div class="tt-note" style="color:red">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="tt-value-wrapper">
                                <input type="text" name="username" value="{{old('username')}}" class="form-control" id="username" placeholder="Username">
                            </div>
                            @error('username')
                                <div class="tt-note" style="color:red">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >Jenis Akun</label>
                            <select name="jenis_akun" onchange="showCop(this.value)" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="admin">Admin</option>
                                <option value="dinas">Dinas</option>
                                <option value="koperasi">Koperasi</option>
                            </select>
                        </div>
                        @error('jenis_akun')
                            <div class="tt-note" style="color:red">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6" id="koperasi" style="display: none">
                        <div class="form-group">
                            <label >Koperasi</label>
                            <select name="cooperative_id" onchange="showCate" class="form-control">
                                @foreach ($koperasi as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('cooperative_id')
                            <div class="tt-note" style="color:red">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="tt-value-wrapper">
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                            @error('password')
                                <div class="tt-note" style="color:red">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6" id="koperasi">
                        <div class="form-group">
                            <label for="password_confirmation">Password</label>
                            <div class="tt-value-wrapper">
                                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control" id="password_confirmation">
                            </div>
                            @error('password_confirmation')
                                <div class="tt-note" style="color:red">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        @error('cooperative_id')
                            <div class="tt-note" style="color:red">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                 <div class="row">
                    <div class="col-auto ml-md-auto" style="text-align: right">
                        <button type="submit" class="btn btn-secondary btn-width-lg">Create User</button>
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

    function showCop(val) {
        if(val == 'koperasi'){
            document.getElementById('koperasi').style.display = 'block';
        }else{
            document.getElementById('koperasi').style.display = 'none';
        }
    }
  </script>
    
@endsection