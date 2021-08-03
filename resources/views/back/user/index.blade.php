@extends('layouts.back')
@section('title')
    Pengguna
@endsection
@section('content')
<div class="container">
    <br>
    <h1 class="tt-title-border">
        Pengguna
    </h1>
    <div class="container row mt-4">
        @if (Auth::user()->jenis_akun == 'admin' || Auth::user()->jenis_akun == 'dinas')
        <div class="col">
            <a href="{{route('users.create')}}" class="btn btn-primary"> Tambah</a>
        </div>
        @endif
        {{-- <div class="col" style="text-align: right">
            <form action="{{route('users.filter-category')}}" method="POST">
                @csrf
                <div class="form-group">
                    
                </div>
            </form>
        </div> --}}
    </div>
    <div class="tt-topic-list">
        <div class="tt-followers-list">
            <div class="tt-list-header">
                <div class="tt-col-name">User</div>
                <div class="tt-col-value-large hide-mobile">Email</div>
                <div class="tt-col-value-large hide-mobile">Jenis Akun</div>
                <div class="tt-col-value">Aksi</div>
            </div>
            @if ($list->isEmpty())
                Belum ada data
            @endif
            @foreach ($list as $item)
                <div class="tt-item" id="user_{{$item->id}}">
                    <div class="tt-col-merged">
                        <div class="tt-col-avatar">
                            @php
                                $firstCharacter = strtolower(substr($item->name, 0, 1));
                            @endphp
                            <svg class="tt-icon">
                            <use xlink:href="#icon-ava-{{$firstCharacter}}"></use>
                            </svg>
                        </div>
                        <div class="tt-col-description">
                            <h6 class="tt-title"><a href="#">{{$item->name}}</a></h6>
                            <ul>
                                <li><a href="mailto:{{'@'.$item->username}}">{{'@'.$item->username}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tt-col-value-large hide-mobile">{{$item->email}}</div>
                    <div class="tt-col-value-large hide-mobile tt-color-select">
                        @if ($item->jenis_akun == 'koperasi')
                        <span class="tt-color02 tt-badge">Koperasi</span>
                        @elseif ($item->jenis_akun == 'dinas')
                            <span class="tt-color10 tt-badge">Dinas</span>
                        @else
                            <span class="tt-color07 tt-badge">Admin</span>
                        @endif
                    </div>
                    <div class="tt-col-value">
                        @if (Auth::user()->jenis_akun == 'admin' || 'dinas')
                        @if ($item->is_verified == '0')
                            <a href="javascript:void(0)" id="verifikasi_{{$item->id}}" onclick="verifikasiUser({{$item->id}})"><span
                                class="tt-color07 tt-badge">Verifikasi</span></a>
                        @endif
                        <a href="{{route('users.edit', $item->id)}}" class=""><span
                            class="tt-color03 tt-badge" style="margin-bottom: 3px;">Edit</span></a>
                            @if (Auth::user()->id != $item->id)
                                <a href="javascript:void(0)" onclick="deleteUser({{$item->id}})"><span
                                    class="tt-color08 tt-badge">Hapus</span></a>
                            @endif
                        @else 
                                <i>No Aksi</i>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-12">
            <div class="mt-5">
                {{$list->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function verifikasiUser(id) {
            Swal.fire({
                title: 'apakah kamu yakin memverifikasi data pengguna ini?',
                icon: 'info',
                confirmButtonText: `Ya, Verifikasi !`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('users.user-verifikasi') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },

                        success: function(result) {
                            Swal.fire('pengguna berhasil diverifikasi', '', 'success')
                            $('#verifikasi_' + id).remove();
                        }
                    });
                } else {

                }
            });
        }
        function deleteUser(id) {
            Swal.fire({
                title: 'apakah kamu yakin menghapus pengguna ini?',
                icon: 'info',
                confirmButtonText: `Ya, Hapus !`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('users.user-delete') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },

                        success: function(result) {
                            Swal.fire('pengguna berhasil dihapus', '', 'success')
                            $('#user_' + id).remove();
                        }
                    });
                } else {

                }
            });
        }
    </script>
@endsection