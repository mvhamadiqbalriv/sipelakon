@extends('layouts.back')
@section('title')
    Pengguna
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-separator-1">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
              </ol>
            </nav>
            <h3>Pengguna</h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl">
        <div class="card">
            <div class="card-body">
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
                <h5 class="card-title">Daftar Pengguna</h5>
                <a href="{{route('users.create')}}" class="btn btn-info mb-1"><i class="fa fa-plus-circle"></i> Tambah</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"></th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    @php
                                        $path = asset('assets/back/images/avatars/default_user.png');
                                        if ($item->photo) {
                                            $path = Storage::url($item->photo);
                                        }
                                    @endphp
                                    <img src="{{$path}}" width="35" height="35" style="object-fit: cover" class="rounded" alt="">
                                </td>
                                <td>
                                    <a href="{{route('users.show', $item->id)}}">
                                        <b>{{$item->name}}</b>
                                    </a>
                                </td>
                                <td>{{$item->email}}</td>
                                <td>
                                    <a href="{{route('users.edit', $item->id)}}" class="btn btn-success"><i class="fa fa-edit"></i> </a>
                                    <a href="javascript:void(0)" data-name="{{$item->name}}" data-uid="{{$item->id}}" onclick="deleteUser(this)" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>       
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        function deleteUser(obj){
            var nama = obj.getAttribute('data-name');
            alert(nama);
        }
    </script>
@endsection