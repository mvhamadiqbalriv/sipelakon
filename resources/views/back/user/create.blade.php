@extends('layouts.back')
@section('title')
    Tambah Pengguna
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="page-title">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-separator-1">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/users') }}">Pengguna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
                <h3>Tambah Pengguna</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row mb-3">
                            <label for="name">Nama Lengkap <sup class="text-danger" title="Wajib diisi">*</sup> </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ old('name') }}" placeholder="Masukan nama lengkap">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-6">
                                <label for="username">Username <sup class="text-danger" title="Wajib diisi">*</sup></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        name="username" id="username" placeholder="Masukan username"
                                        value="{{ old('username') }}">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="email">Email <sup class="text-danger" title="Wajib diisi">*</sup></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}" placeholder="Masukan email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-6">
                                <label for="password">Password <sup class="text-danger" title="Wajib diisi">*</sup></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password" placeholder="Masukan password"
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="confirm_password">Konfirmasi Password <sup class="text-danger"
                                        title="Wajib diisi">*</sup></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    <input type="password"
                                        class="form-control @error('confirm_password') is-invalid @enderror"
                                        name="confirm_password" id="confirm_password"
                                        value="{{ old('confirm_password') }}" placeholder="Konfirmasi password">
                                    @error('confirm_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-6">
                                <label for="telepon">No telepon <sup class="text-danger" title="Wajib diisi">*</sup></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="number" class="form-control @error('telepon') is-invalid @enderror"
                                        name="telepon" id="telepon" value="{{ old('telepon') }}"
                                        placeholder="Masukan no telepon">
                                    @error('telepon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="pria" value="pria"
                                        checked>
                                    <label class="form-check-label" for="pria">
                                        Pria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="wanita"
                                        value="wanita">
                                    <label class="form-check-label" for="wanita">
                                        Wanita
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-6">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-map-pin"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                                        value="{{ old('tempat_lahir') }}" placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control " name="tanggal_lahir" id="tanggal_lahir"
                                        value="{{ old('tanggal_lahir') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-6">
                                <label for="tentang">Deskripsikan diri</label>
                                <textarea name="tentang" id="tentang" class="form-control" cols="30"
                                    rows="5">{{ old('tentang') }}</textarea>
                            </div>
                            <div class="col-6">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30"
                                    rows="5">{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-6">
                                <label for="jenis_user">Jenis User</label>
                                <select name="jenis_user" id="jenis_user" class="form-control">
                                    <option value="">-- Pilih --</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="photo">Photo Profile</label>
                                <div class="mt-2 mb-3" id="dis" style="display: none">
                                    <img width="80" height="80" style="object-fit: cover" id="imagePreview" alt="">
                                </div>
                                <div class="custom-file mb-3">
                                    <input type="file" name="photo" accept="image/*" onchange="preview_image(event)"
                                        class="custom-file-input form-control @error('photo') is-invalid @enderror"
                                        id="photo">
                                    <label class="custom-file-label" for="photo">Pilih gambar</label>
                                </div>
                                @error('photo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i>
                                    Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                var dis = document.getElementById('dis');
                output.src = reader.result;
                dis.style.display = "block";
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
