@extends('layouts.back')
@section('title')
    Ubah Pengguna
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="page-title">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-separator-1">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/users') }}">Pengguna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
                <h3>Ubah Pengguna</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.update', $detail->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row mb-3">
                            <label for="name">Nama Lengkap <sup class="text-danger" title="Wajib diisi">*</sup> </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ $detail->name ?? old('name') }}" placeholder="Masukan nama lengkap">
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
                                        value="{{ $detail->username ?? old('username') }}">
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
                                        name="email" id="email" value="{{ $detail->email ?? old('email') }}"
                                        placeholder="Masukan email">
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
                                <label for="telepon">No telepon <sup class="text-danger" title="Wajib diisi">*</sup></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="number" class="form-control @error('telepon') is-invalid @enderror"
                                        name="telepon" id="telepon" value="{{ $detail->telepon ?? old('telepon') }}"
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
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="pria" value="Pria"
                                        {{ $detail->jenis_kelamin == 'Pria' ? 'checked' : null }}>
                                    <label class="form-check-label" for="pria">
                                        Pria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="wanita"
                                        value="Wanita" {{ $detail->jenis_kelamin == 'Wanita' ? 'checked' : null }}>
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
                                        value="{{ $detail->tempat_lahir ?? old('tempat_lahir') }}"
                                        placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control " name="tanggal_lahir" id="tanggal_lahir"
                                        value="{{ $detail->tanggal_lahir ?? old('tanggal_lahir') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-6">
                                <label for="tentang">Deskripsikan diri</label>
                                <textarea name="tentang" id="tentang" class="form-control" cols="30"
                                    rows="5">{{ $detail->tentang ?? old('tentang') }}</textarea>
                            </div>
                            <div class="col-6">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30"
                                    rows="5">{{ $detail->alamat ?? old('alamat') }}</textarea>
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
                                <div class="mt-2 mb-3" id="dis">
                                    @php
                                        $path = asset('assets/back/images/avatars/default_user.png');
                                        if ($detail->photo) {
                                            $path = Storage::url($detail->photo);
                                        }
                                    @endphp
                                    <img width="80" height="80" style="object-fit: cover" class="rounded" id="imagePreview" src="{{$path}}" alt="">
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
                            <div class="col text-left">
                                <button type="button" class="btn btn-xs btn-secondary" data-toggle="modal"
                                    data-target="#ubahPasswordModal"><i class="fa fa-key"></i> Ubah password</button>
                            </div>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-save"></i>
                                    Perbaharui</button>
                            </div>
                        </div>
                    </form>
                    <!-- Modal ubah password -->
                    <div class="modal fade" id="ubahPasswordModal" tabindex="-1" role="dialog"
                        aria-labelledby="ubahPasswordModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ubahPasswordTitle">Ubah Password</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <i class="anticon anticon-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        @if ($msg = Session::get('success'))
                                                    <div class="alert alert-success">
                                                        {{$msg}}
                                                    </div>
                                            @endif
                                            @if ($msg = Session::get('error'))
                                                    <div class="alert alert-danger">
                                                        {{$msg}}
                                                    </div>
                                            @endif
                                    <form action="{{route('change_password', $detail->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        <label for="">Password Lama</label>
                                        <input type="password" class="form-control m-b-15 @error('old_password') is-invalid @enderror" name="old_password"  placeholder="Password Lama">
                                        @error('old_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <label for="">Password Baru</label>
                                        <input type="password" class="form-control m-b-15 @error('new_password') is-invalid @enderror" name="new_password"  placeholder="Password Baru">
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <label for="">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control m-b-15 @error('confirm_password') is-invalid @enderror" name="confirm_password"  placeholder="Konfirmasi Password Baru">
                                        @error('confirm_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    @if (Session::get('success') || Session::get('error'))
        <script>
            $('#ubahPasswordModal').modal('show');
        </script>
    @endif
    @error('new_password')
        <script>
            $('#ubahPasswordModal').modal('show');
        </script>
    @enderror
    @error('confirm_password')
        <script>
            $('#ubahPasswordModal').modal('show');
        </script>
    @enderror
@endsection
