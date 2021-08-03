@extends('layouts.back')
@section('title')
    Perbaharui Pengguna
@endsection
@section('content')
<br>
<div class="container">
    <div class="tt-wrapper-inner">
        <h1 class="tt-title-border">
            Perbaharui Pengguna
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
                     <div class="col">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ubahPasswordModal">
                            Ubah Password
                          </button>
                     </div>
                    <div class="col-auto ml-md-auto" style="text-align: right">
                        <button type="submit" class="btn btn-secondary btn-width-lg">Perbaharui Pengguna</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="ubahPasswordModal" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="tt-modal-advancedSearch">
				<div class="tt-modal-title">
					<i class="pt-icon">
						<svg>
							<use xlink:href="#icon-advanced_search"></use>
						</svg>
					</i>
					Ubah Password
					<a class="pt-close-modal" href="#" data-dismiss="modal">
						<svg class="icon">
							<use xlink:href="#icon-cancel"></use>
						</svg>
					</a>
				</div>
				<form class="form-default" id="ubahPasswordForm">
					<div class="form-group">
						<label for="old_password">Password Sebelumnya</label>
						<input type="password" name="old_password" class="form-control" id="old_password" placeholder="Password Sebelumnya">
                        <div id="old_passwordErrDis" style="display: none;color: red">
                            <small><i id="old_passwordErrMsg"></i></small>
                        </div>
					</div>
					<div class="form-group">
						<label for="password">Password Baru</label>
						<input type="password" name="password" class="form-control" id="password" placeholder="Password Baru">
                        <div id="passwordErrDis" style="display: none;color: red">
                            <small><i id="passwordErrMsg"></i></small>
                        </div>
					</div>
					<div class="form-group">
						<label for="password_confirmation">Konfirmasi Password Baru</label>
						<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password Baru">
                        <div id="password_confirmationErrDis" style="display: none;color: red">
                            <small><i id="password_confirmationErrMsg"></i></small>
                        </div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-secondary btn-block">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    const ubahPasswordForm = document.getElementById('ubahPasswordForm');

    ubahPasswordForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const id = "{{$detail->id}}";
        const old_password = ubahPasswordForm.old_password.value;
        const password = ubahPasswordForm.password.value;
        const password_confirmation = ubahPasswordForm.password_confirmation.value;
        const _token = "{{ csrf_token() }}";

        try {
            let response = await fetch("{{route('users.change-password')}}", {
                method: "POST",
                body: JSON.stringify({
                    id: id,
                    old_password: old_password,
                    password: password,
                    password_confirmation: password_confirmation
                }),
                headers: {
                    "Content-type": 'application/json',
                    "X-CSRF-TOKEN": _token,
                    "X-Requested-With": "XMLHttpRequest"
                }
            });
            var datasend = await response.json();

                if (datasend.errors !== undefined) {
                    for (const [key, value] of Object.entries(datasend.errors)) {
                        obj = document.getElementById(key);
                        obj.classList.add('is-invalid');
                        objErrDis = document.getElementById(key+'ErrDis');
                        objErrDis.style.display = "block";
                        objErrMsg = document.getElementById(key+'ErrMsg');
                        objErrMsg.innerHTML = `${value}`;
                    }
                }else{
                    if (datasend.status == 'error_password_lama') {
                        objErrDis.style.display = "block";
                        objErrDis = document.getElementById('old_passwordErrDis');
                        objErrMsg = document.getElementById('old_passwordErrMsg');
                        objErrMsg.innerHTML = `${value}`;
                    }else if (datasend.status == 'error') {
                        Swal.fire(datasend.msg, '', 'error');
                    }else{
                        Swal.fire(datasend.msg, '', 'success');
                        $('#ubahPasswordModal').modal('hide');
                    }
                }

            return false;
        } catch (err) {
            console.log(err);
        }
    });
  </script>
    
@endsection