@extends('layouts.back')
@section('title')
    {{$detail->name}}
@endsection
@section('css')
    
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-separator-1">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/users') }}">Pengguna</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$detail->name}}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="profile-cover"></div>
        <div class="profile-header">
            <div class="profile-img">
                @php
                    $path = asset('assets/back/images/avatars/default_user.png');
                    if ($detail->photo) {
                        $path = Storage::url($detail->photo);
                    }
                @endphp
                <img src="{{$path}}">
            </div>
            <div class="profile-name">
                <h3>{{$detail->name}}</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tentang saya</h5>
                <p>{{$detail->tentang ?? '-'}}</p>
                <ul class="list-unstyled profile-about-list">
                    <li><i class="material-icons">transgender</i><span>{{$detail->jenis_kelamin ?? '-'}}</span></li>
                    <li><i class="material-icons">calendar_today</i><span>{{$detail->tempat_lahir ?? '-'}},{{$detail->tanggal_lahir ?? '-'}}</span></li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Contact Info</h5>
                <ul class="list-unstyled profile-about-list">
                    <li><i class="material-icons">mail_outline</i><span>{{$detail->email ?? '-'}}</span></li>
                    <li><i class="material-icons">home</i><span>{{$detail->alamat ?? '-'}}</span></li>
                    <li><i class="material-icons">local_phone</i><span>{{$detail->telepon ?? '-'}}</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col">
        <h5><b>{{$detail->name}}</b> <i>belum</i> membuat artikel apapun.</h5>
    </div>
@endsection
@section('js')
    
@endsection