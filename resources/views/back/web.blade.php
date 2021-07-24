@extends('layouts.back')
@section('title')
    Profile Web
@endsection
@section('css')
    <link href="{{asset('assets/back/plugins/toastr/toastr.min.css')}}" rel="stylesheet">  
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-separator-1">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile Web</li>
              </ol>
            </nav>
            <h3>Profile Web</h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl">
        <div class="card">
            <div class="card-body">
                <form id="webForm" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col">
                        <label for="instagram">Instagram</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-white" style="background-color: rgb(225,48,108)" id="inputGroupPrepend3"><i class="fab fa-instagram"></i></span>
                              </div>
                              <input type="text" id="instagram" onkeyup="keyup('instagram')" name="instagram" value="{{old('instagram') ?? $detail->instagram}}" class="form-control @error('instagram') is-invalid @enderror text-dark" placeholder="Username instagram">
                            </div>
                            <small>https://instagram.com/<b id="instagramUsername">{{old('instagram') ?? $detail->instagram}}</b></small>
                            <div id="instagramErrDis" style="display: none">
                                <small class="text-danger"><i id="instagramErrMsg"></i></small>
                            </div>
                      </div>
                      <div class="col">
                        <label for="facebook">Facebook</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="inputGroupPrepend3"><i class="fab fa-facebook-f"></i></span>
                              </div>
                              <input type="text" id="facebook" onkeyup="keyup('facebook')" name="facebook" class="form-control @error('facebook') is-invalid @enderror text-dark" value="{{old('facebook') ?? $detail->facebook}}" placeholder="Username facebook">
                        </div>
                        <small>https://facebook.com/<b id="facebookUsername">{{old('facebook') ?? $detail->facebook}}</b></small>
                        <div id="facebookErrDis" style="display: none">
                            <small class="text-danger"><i id="facebookErrMsg"></i></small>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col">
                        <label for="twitter">Twitter</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-white" style="background-color: rgb(29, 161, 242)" id="inputGroupPrepend3"><i class="fab fa-twitter"></i></span>
                              </div>
                              <input type="text" id="twitter" onkeyup="keyup('twitter')" name="twitter" class="form-control @error('twitter') is-invalid @enderror text-dark" value="{{old('twitter') ?? $detail->twitter}}" placeholder="Username twitter">
                        </div>
                        <small>https://twitter.com/<b id="twitterUsername">{{old('twitter') ?? $detail->twitter}}</b></small>
                        <div id="twitterErrDis" style="display: none">
                            <small class="text-danger"><i id="twitterErrMsg"></i></small>
                        </div>
                      </div>
                      <div class="col">
                        <label for="whatsapp">Whatsapp</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-white" style="background-color: rgb(37, 211, 102)" id="inputGroupPrepend3"><i class="fab fa-whatsapp"></i></span>
                              </div>
                              <input type="text" id="whatsapp" onkeyup="keyup('whatsapp')" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror text-dark" value="{{old('whatsapp') ?? $detail->whatsapp}}" placeholder="Ganti awalan 0 dengan 62">
                            </div>
                            <small>https://wa.me/<b id="whatsappUsername">{{old('whatsapp') ?? $detail->whatsapp}}</b></small>
                            <div id="whatsappErrDis" style="display: none">
                                <small class="text-danger"><i id="whatsappErrMsg"></i></small>
                            </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-danger text-white" id="inputGroupPrepend3"><i class="fa fa-envelope"></i> </span>
                              </div>
                              <input type="email" id="email" onkeyup="keyup('email')" name="email" class="form-control @error('email') is-invalid @enderror text-dark" value="{{old('email') ?? $detail->email}}" placeholder="Alamat email">
                        </div>
                        <small>mailto:<b id="emailUsername">{{old('email') ?? $detail->email}}</b></small>
                        <div id="emailErrDis" style="display: none">
                            <small class="text-danger"><i id="emailErrMsg"></i></small>
                        </div>
                    </div>
                    <div class="col">
                        <label for="logo">Logo</label>

                        @php
                            $display = 'none';
                            if ($detail->logo) {
                                $display = 'block';
                            }
                        @endphp
                        <div class="mt-2 mb-3" id="dis" style="display: <?=$display?>">
                            <img width="200" style="object-fit: contain" id="imagePreview" src="{{Storage::url($detail->logo)}}" alt="">
                        </div>
                        
                        <div class="custom-file mb-3">
                            <input type="file" name="logo" accept="image/*" onchange="preview_image(event)" class="custom-file-input form-control @error('logo') is-invalid @enderror" id="logo">
                            <label class="custom-file-label" for="logo">Pilih gambar</label>
                        </div>
                        <small>Format <b>png,jpg,jpeg</b> (1MB max)</small>
                        <div id="logoErrDis" style="display: none">
                            <small class="text-danger"><i id="logoErrMsg"></i></small>
                        </div>
                    </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col text-right">
                            <button class="btn btn-lg btn-primary perbaharui"><i class="fa fa-save"></i> Perbaharui</button>
                        </div>
                    </div>
                  </form>     
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('assets/back/plugins/toastr/toastr.min.js')}}"></script>
<script type='text/javascript'>
    function preview_image(event) 
    {
     var reader = new FileReader();
     reader.onload = function()
     {
      var output = document.getElementById('imagePreview');
      var dis = document.getElementById('dis');
      output.src = reader.result;
      dis.style.display = "block";
     }
     reader.readAsDataURL(event.target.files[0]);
    }
    function keyup(socmed){
        var socmedVal = document.getElementById(socmed);
        var username = document.getElementById(socmed+'Username');
        username.innerHTML = socmedVal.value;
    }

    const form = document.getElementById('webForm');
 
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const file_data = $('#logo')[0].files;
        const instagram = form.instagram.value;
        const facebook = form.facebook.value;
        const twitter = form.twitter.value;
        const whatsapp = form.whatsapp.value;
        const email = form.email.value;
        const _token = "{{ csrf_token() }}";

        let formData = new FormData();
        formData.append('instagram', instagram);
        formData.append('facebook', facebook);
        formData.append('twitter', twitter);
        formData.append('whatsapp', whatsapp);
        formData.append('email', email);
        formData.append('_token', _token);
        formData.append('logo', file_data[0]);

        try {
            let response = await fetch("{{route('web.store')}}", {
                method: "POST",
                body: formData,
                headers: {
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
                    toastr.error('Silahkan coba lagi.', 'Error !')
                }else{
                    for (const [key, value] of Object.entries(datasend.data)) {
                        if (key == 'id' || key == 'created_at' || key == 'updated_at') {
                            continue;
                        }
                        obj = document.getElementById(key);
                        obj.classList.remove('is-invalid');
                        objErrDis = document.getElementById(key+'ErrDis');
                        objErrDis.style.display = "none";
                        objErrMsg = document.getElementById(key+'ErrMsg');
                        objErrMsg.innerHTML = `${value}`;
                    } 
                    toastr.success('Web profile berhasil diperbaharui.', 'Success !')
                }

            return false;
        } catch (err) {
            console.log(err);
        }
    });
    </script>
@endsection