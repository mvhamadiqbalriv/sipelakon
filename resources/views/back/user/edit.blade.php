@extends('layouts.back')
@section('title')
    Update User
@endsection
@section('content')
<br>
<div class="container">
    <div class="tt-wrapper-inner">
        <h1 class="tt-title-border">
            Update User
        </h1>
        <form class="form-default form-create-topic" method="POST" action="{{route('users.update', $detail->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama</label>
                <div class="tt-value-wrapper">
                    <input type="text" name="name" value="{{$detail->name ?? old('name')}}" class="form-control" id="name" placeholder="Nama Lengkap">
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
                    <input type="text" name="nik" value="{{$detail->nik ?? old('nik')}}" class="form-control" id="nik" placeholder="Nomor Induk Kepegawaian">
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
                                <input type="email" name="email" value="{{$detail->email ?? old('email')}}" class="form-control" id="email" placeholder="Alamat Email">
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
                                <input type="text" name="username" value="{{$detail->username ?? old('username')}}" class="form-control" id="username" placeholder="Username">
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
                                <option value="admin" {{($detail->jenis_akun == 'admin') ? 'selected' : null}}>Admin</option>
                                <option value="dinas" {{($detail->jenis_akun == 'dinas') ? 'selected' : null}}>Dinas</option>
                                <option value="koperasi" {{($detail->jenis_akun == 'koperasi') ? 'selected' : null}}>Koperasi</option>
                            </select>
                        </div>
                        @error('jenis_akun')
                            <div class="tt-note" style="color:red">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    @php
                        $styleCop = 'none';
                        if($detail->jenis_akun == 'koperasi'){
                            $styleCop = 'block';
                        }
                    @endphp
                    <div class="col-md-6" id="koperasi" style="display: {{$styleCop}}">
                        <div class="form-group">
                            <label >Koperasi</label>
                            <select name="cooperative_id" onchange="showCate" class="form-control">
                                @foreach ($koperasi as $item)
                                    <option value="{{$item->id}}" {{($detail->cooperative_id == $item->id) ? 'selected' : null}}>{{$item->name}}</option>
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
                    <div class="col-auto ml-md-auto" style="text-align: right">
                        <button type="submit" class="btn btn-secondary btn-width-lg">Update User</button>
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