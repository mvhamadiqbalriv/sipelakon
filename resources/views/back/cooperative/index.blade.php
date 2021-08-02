@extends('layouts.back')
@section('title')
    Koperasi
@endsection
@section('content')
<div class="container">
    <br>
    <h1 class="tt-title-border">
        Koperasi
    </h1>
    <div class="container row mt-4">
        <div class="col">
            <a href="{{route('cooperative.create')}}" class="btn btn-primary"> Tambah</a>
        </div>
        <div class="col" style="text-align: right">
            <form action="{{route('cooperative.filter-kecamatan')}}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="custom-select-01">
                    <select name="kecamatan" class="form-control" onchange="this.form.submit()" id="">
                        <option value="">--Filter by Kecamatan--</option>
                        @foreach ($kecamatan as $item)
                            @php
                                $selected = null;
                                if (isset($_POST['kecamatan'])) {
                                    $selected = $_POST['kecamatan'];
                                }
                            @endphp
                            <option value="{{$item->id}}" {{($selected == $item->id) ? 'selected' : null}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                </div>
            </form>
        </div>
    </div>
    <div class="tt-followers-list">
        <div class="tt-list-header">
            <div class="tt-col-name">Nama</div>
            <div class="tt-col-value-large hide-mobile">NIK</div>
            <div class="tt-col-value-large hide-mobile">Alamat</div>
            <div class="tt-col-value-large hide-mobile">Kategori</div>
            <div class="tt-col-value">Aksi</div>
        </div>
        <hr>
        @if ($list->isEmpty())
            Belum ada data
        @endif
        @foreach ($list as $item)
            <div class="tt-item" id="cooperative_{{$item->id}}">
                <div class="tt-col-merged tt-color-select">
                    {{$item->name}}
                </div>
                <div class="tt-col-value-large hide-mobile">
                    {{$item->nik}}
                </div>
                <div class="tt-col-value-large hide-mobile">Ds/Kel. {{$item->desa->name}}, Kec. {{$item->kecamatan->name}}, {{$item->alamat}} .</div>
                <div class="tt-col-value-large hide-mobile">
                    @php
                        $coma = null;
                        if ($item->kategori->count() > 0) {
                            $coma = ',';
                        }
                    @endphp
                    @foreach ($item->kategori as $key => $i)
                        {{$i->nama}} {{ $loop->last ? '.' : '' }}
                    @endforeach
                </div>
                <div class="tt-col-value">
                    @if ($item->is_verified == 0)
                        <a href="javascript:void(0)" id="verifikasi_{{$item->id}}" onclick="verifikasiCooperative({{$item->id}})" class=""><span
                            class="tt-color07 tt-badge">Verifikasi</span></a>
                    @endif
                    <a href="{{route('cooperative.edit', $item->id)}}" class="" style="margin-bottom: 3px;"><span
                        class="tt-color03 tt-badge">Edit</span></a>
                    <a href="javascript:void(0)" onclick="deleteCooperative({{$item->id}})" class=""><span
                        class="tt-color08 tt-badge">Hapus</span></a>
                </div>
            </div>
        @endforeach
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
        function verifikasiCooperative(id) {
            Swal.fire({
                title: 'apakah kamu yakin memverifikasi data koperasi ini?',
                icon: 'info',
                confirmButtonText: `Ya, Verifikasi !`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('cooperative.cooperative-verifikasi') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(result) {
                            Swal.fire('koperasi berhasil diverifikasi', '', 'success')
                            $('#verifikasi_' + id).remove();
                        }
                    });
                } else {

                }
            });
        }
        function deleteCooperative(id) {
            Swal.fire({
                title: 'apakah kamu yakin menghapus koperasi ini?',
                icon: 'info',
                confirmButtonText: `Ya, Hapus !`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('cooperative.cooperative-delete') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(result) {
                            Swal.fire('koperasi berhasil dihapus', '', 'success');
                            $('#cooperative_' + id).remove();
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            Swal.fire('koperasi gagal dihapus', '', 'error');
                            Swal.fire('hapus pengguna terkait terlebih dahulu', '', 'warning');
                        } 
                    });
                } else {

                }
            });
        }
    </script>
@endsection