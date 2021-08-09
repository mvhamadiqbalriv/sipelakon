@extends('layouts.back')
@section('title')
    Forum
@endsection
@section('css')
<style>
    .pagination a {
      color: black;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
      transition: background-color .3s;
    }
    
    .pagination a.active {
      background-color: dodgerblue;
      color: white;
    }
    
    .pagination a:hover:not(.active) {background-color: #ddd;}
    </style>
@endsection
@section('content')
<div class="container">
    <br>
    <h1 class="tt-title-border">
        Forum
    </h1>
    <div class="container row mt-4">
        <div class="col">
            <a href="{{route('post.create')}}" class="btn btn-primary"> Tambah</a>
        </div>
        <div class="col" style="text-align: right">
            <div class="custom-select-01">
            <form action="{{route('post.filter-category')}}" method="POST">
                @csrf
                <div class="form-group">
                    <select name="category" class="form-control" onchange="this.form.submit()" id="">
                        <option value="">--Filter by Kategori--</option>
                        @foreach ($kategori as $item)
                            @php
                                $selected = null;
                                if (isset($_POST['category'])) {
                                    $selected = $_POST['category'];
                                }
                            @endphp
                            <option value="{{$item->id}}" {{($selected == $item->id) ? 'selected' : null}}>{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
                </div>
            </form>
        </div>
    </div>
    <div class="tt-topic-list">
        <div class="tt-list-header">
            <div class="tt-col-topic"><b>Judul</b> </div>
            <div class="tt-col-category">Kategori</div>
            <div class="tt-col-value hide-mobile">Balasan</div>
            <div class="tt-col-value">Aksi</div>
        </div>
        @if ($list->isEmpty())
            Belum ada data
        @endif
        @foreach ($list as $item)
            <div class="tt-item" id="post_{{$item->id}}">
                <div class="tt-col-avatar">
                    @php
                        $firstCharacter = strtolower(substr($item->user->name, 0, 1));
                    @endphp
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-{{$firstCharacter}}"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="{{route('post.show',$item->slug)}}">
                            {{$item->judul}}
                        </a></h6>
                    <div class="row align-items-center no-gutters">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                @if ($item->tag)
                                    @php
                                        $tags = explode(',',$item->tag);
                                    @endphp
                                    @foreach ($tags as $tag)
                                        <li><a href="#"><span class="tt-badge">{{$tag}}</span></a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category">
                    @if ($item->category_post_id == 1)
                        <span class="tt-color01 tt-badge">{{$item->kategori->nama}}</span>
                    @elseif ($item->category_post_id == 2)
                        <span class="tt-color09 tt-badge">{{$item->kategori->nama}}</span>
                        @elseif ($detail->kategori->id == 3)
                        <span class="tt-color05 tt-badge">{{ $detail->kategori->nama }}</span>
                    @else
                        <span class="tt-color07 tt-badge">{{ $detail->kategori->nama }}</span>
                    @endif
                </div>
                <div class="tt-col-value tt-color-select hide-mobile">{{$item->comments_count}}</div>
                <div class="tt-col-value hide-mobile">
                    @if ($item->creator_id == Auth::user()->id || Auth::user()->jenis_akun == 'admin')
                        <a href="{{route('post.edit', $item->id)}}" class=""><span
                            class="tt-color03 tt-badge" style="margin-bottom: 3px;">Edit</span></a>
                        <a href="javascript:void(0)" onclick="deletePost({{$item->id}})"><span
                            class="tt-color08 tt-badge">Hapus</span></a>
                    @else 
                            <i>No Aksi</i>
                    @endif
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
        function deletePost(id) {
            Swal.fire({
                title: 'apakah kamu yakin menghapus postingan ini?',
                icon: 'info',
                confirmButtonText: `Ya, Hapus !`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('post.post-delete') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },

                        success: function(result) {
                            Swal.fire('postingan berhasil dihapus', '', 'success')
                            $('#post_' + id).remove();
                        }
                    });
                } else {

                }
            });
        }
    </script>
@endsection