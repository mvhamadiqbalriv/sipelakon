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
                    <select name="kecamatan" class="form-control" onchange="this.form.submit()" id="">
                        <option value="kecamatan">--Filter by Kecamatan--</option>
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
                    @if ($item->category_cooperative_id == 1)
                        <div style="background-color: #355c7d;color:white;border-radius:10px;">{{$item->kategori->nama}}</div>
                    @elseif ($item->category_cooperative_id == 2)
                        <div style="background-color: #6c5b7b;color:white;border-radius:10px;">{{$item->kategori->nama}}</div>
                    @else
                        <div style="background-color: #c06c84;color:white;border-radius:10px;">{{$item->kategori->nama}}</div>
                    @endif
                </div>
                <div class="tt-col-value">
                    <a href="{{route('cooperative.edit', $item->id)}}" class="" style="margin-bottom: 3px;"><span
                        class="tt-color03 tt-badge">Edit</span></a>
                    <a href="javascript:void(0)" onclick="deleteCooperative({{$item->id}})" class=""><span
                        class="tt-color08 tt-badge">Hapus</span></a>
                </div>
            </div>
        @endforeach
        <div class="col-12">
            <div class="tt-row-btn">
                <button type="button" class="btn-icon js-topiclist-showmore">
                    <svg class="tt-icon">
                      <use xlink:href="#icon-load_lore_icon"></use>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
                            Swal.fire('koperasi berhasil dihapus', '', 'success')
                            $('#cooperative_' + id).remove();
                        }
                    });
                } else {

                }
            });
        }
    </script>
@endsection