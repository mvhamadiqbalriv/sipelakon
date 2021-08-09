@extends('layouts.back')
@section('title')
    {{ $detail->judul }}
@endsection
@php
    if(Auth::user()->jenis_akun == 'koperasi'){
        $jenis_akun = Auth::user()->koperasi->name;
    }else if(Auth::user()->jenis_akun == 'dinas'){
        $jenis_akun = 'Dinas';
    }else{
        $jenis_akun = 'Admin';
    }
@endphp
@section('content')
    <br>
    <div class="container">
        <div class="tt-single-topic-list" id="single-topik">
            <div class="tt-item">
                <div class="tt-single-topic">
                    <div class="tt-item-header">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                @php
                                    $firstCharacter = strtolower(substr($detail->user->name, 0, 1));
                                @endphp
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-ava-{{ $firstCharacter }}"></use>
                                    </svg></i>
                            </div>
                            <div class="tt-avatar-title">
                                <a href="#"><b>{{ $detail->user->name }}</b> </a>
                                @if ($detail->user->jenis_akun == 'koperasi')
                                <p><small><i>{{ $detail->user->koperasi->name }}</i></small></p>
                                @endif
                            </div>
                            <a href="#" class="tt-info-time">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-time"></use>
                                    </svg></i>{{ date('d M, Y', strtotime($detail->created_at)) }}
                            </a>
                        </div>
                        <h3 class="tt-item-title">
                            <a href="#">{{ $detail->judul }}</a>
                        </h3>
                        <div class="tt-item-tag">
                            <ul class="tt-list-badge">
                                <li><a href="#">
                                        @if ($detail->kategori->id == 1)
                                            <span class="tt-color01 tt-badge">{{ $detail->kategori->nama }}</span>
                                        @elseif ($detail->kategori->id == 2)
                                            <span class="tt-color09 tt-badge">{{ $detail->kategori->nama }}</span>
                                        @elseif ($detail->kategori->id == 3)
                                            <span class="tt-color05 tt-badge">{{ $detail->kategori->nama }}</span>
                                        @else
                                            <span class="tt-color07 tt-badge">{{ $detail->kategori->nama }}</span>
                                        @endif
                                    </a></li>
                                    @if ($detail->tag)
                                        @php
                                            $tags = explode(',', $detail->tag);
                                        @endphp
                                        @foreach ($tags as $tag)
                                            <li><a href="#"><span class="tt-badge">{{ $tag }}</span></a></li>
                                        @endforeach
                                    @endif
                            </ul>
                        </div>
                    </div>
                    <div class="tt-item-description">
                        {!! $detail->konten !!}
                    </div>
                    @if ($detail->file)
                        <hr>
                        <small>Document</small>
                        <ul>
                            <li><small><a href="{{Storage::url($detail->file)}}">Download</a></small></li>
                        </ul>
                    @endif
                </div>
            </div>
            <p class="text-right">
            <h3>-- Balasan --</h3>
            </p>
            @foreach ($comments as $item)
                <div class="tt-item" id="comment_{{ $item->id }}">
                    <div class="tt-single-topic">
                        <div class="tt-item-header pt-noborder">
                            <div class="tt-item-info info-top">
                                <div class="tt-avatar-icon">
                                    @php
                                        $firstCharacter = strtolower(substr($item->user->name, 0, 1));
                                    @endphp
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-ava-{{ $firstCharacter }}"></use>
                                        </svg></i>
                                </div>
                                <div class="tt-avatar-title">
                                    <a href="#"><b>{{ $item->user->name }}</b> </a>
                                    <p><small><i>
                                        @php
                                        if($item->user->jenis_akun == 'koperasi'){
                                            $jenis_akun = $item->user->koperasi->name;
                                        }else if($item->user->jenis_akun == 'dinas'){
                                            $jenis_akun = 'Dinas';
                                        }else{
                                            $jenis_akun = 'Admin';
                                        }
                                        echo $jenis_akun;
                                    @endphp    
                                    </i></small></p>
                                </div>
                                <a href="javascript:void(0)" class="tt-info-time">
                                    <span class="tt-icon">
                                        <svg>
                                            <use xlink:href="#icon-time"></use>
                                        </svg> {{ date('d M, Y', strtotime($item->created_at)) }}
                                    </span>
                                    @if ($item->creator_id == Auth::user()->id)
                                    <span class="tt-icon" onclick="deleteComment({{ $item->id }})">
                                        <svg>
                                            <use xlink:href="#icon-cancel">Hapus</use>
                                        </svg>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </span>
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="tt-item-description">
                            {!! $item->konten !!}
                        </div>
                        <div id="lampiranKomen{{$item->id}}">
                                @if ($item->file)
                                <hr>
                                <small>Lampiran</small>
                                <ul>
                                    <li><small><a href="{{Storage::url($item->file)}}">Download</a></small></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="tt-wrapper-inner">
            <div class="pt-editor form-default">
                <h6 class="pt-title">Post Your Reply</h6>
                <form id="replyAdd" enctype="multipart/form-data">
                    <div class="form-group">
                        <textarea name="konten" id="konten" class="form-control" rows="5"
                            placeholder="Lets get started"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Sematkan file</label>
                        <input type="file" class="form-control" name="file">
                    </div>
                    <div class="pt-row">
                        <div class="col-auto">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-secondary btn-width-lg">Reply</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    </script>
    <script>
        //Aksi Tambah
        const replyAdd = document.getElementById('replyAdd');

        replyAdd.addEventListener('submit', async (e) => {
            e.preventDefault();

            const konten = CKEDITOR.instances.konten.getData();
            const file = replyAdd.file.files[0];
            const post_id = "{{ $detail->id }}";
            const creator_id = "{{ Auth::user()->id }}";
            const _token = "{{ csrf_token() }}";

            let formData = new FormData();
             formData.append("konten", konten);
             formData.append("file", file);
             formData.append("post_id", post_id);
             formData.append("creator_id", creator_id);

            try {
                let response = await fetch("{{ route('post.comment-store') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": _token,
                    }
                });
                var datasend = await response.json();

                if (datasend.status == 'success') {
                    var authName = "{{ Auth::user()->name }}";
                    var firstChar = authName.charAt(0).toLowerCase();
                    var koperasiName = "{{$jenis_akun}}";
                    let craetedAt = new Date(datasend.data.created_at);
                    createdAtFormat = craetedAt.toLocaleString('en-US', {
                        day: 'numeric', // numeric, 2-digit
                        year: 'numeric', // numeric, 2-digit
                        month: 'short', // numeric, 2-digit, long, short, narrow
                    });

                    var row = '<div class="tt-item" id="comment_' + datasend.data.id +
                        '"> <div class="tt-single-topic"> <div class="tt-item-header pt-noborder"> <div class="tt-item-info info-top">';
                    row += '<div class="tt-avatar-icon"> <i class="tt-icon"><svg> <use xlink:href="#icon-ava-' +
                        firstChar + '"></use> </svg></i> </div> <div class="tt-avatar-title">';
                    row += '<a href="javascript:void(0)">' + authName + '</a> <p><small><i>' + koperasiName +
                        '</i></small></p> </div> <a href="javascript:void(0)" class="tt-info-time"> <span class="tt-icon"><svg>';
                    row +=
                        '<use xlink:href="#icon-time"></use> </svg></span>' + createdAtFormat +
                        '<span class="tt-icon" onclick="deleteComment(' +
                        datasend.data.id +
                        ')"> <svg> <use xlink:href="#icon-cancel">Hapus</use> </svg>       </span></a> </div> </div> <div class="tt-item-description">' +
                        datasend.data.konten + '</div><div id="lampiranKomen'+datasend.data.id+'"></div></div></div>';
                    
                    $('#konten').empty();
                    $('#single-topik').append(row);
                    
                    if (datasend.data.file != null) {
                        var url = window.location.origin;
                        var lampiran = '<hr> <small>Lampiran</small>  <ul> <li><small><a href="'+url+'/'+datasend.data.file.replace('public/','storage/')+'" download>Download</a></small></li> </ul>';
                        $('#lampiranKomen'+datasend.data.id).append(lampiran);
                    }

                }

                return false;
            } catch (err) {
                console.log(err);
            }
        });

        //Aksi Delete

        function deleteComment(id) {
            Swal.fire({
                title: 'apakah kamu yakin menghapus komentar ini?',
                icon: 'info',
                confirmButtonText: `Ya, Hapus !`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('post.comment-delete') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },

                        success: function(result) {
                            Swal.fire('Komentar berhasil dihapus', '', 'success')
                            $('#comment_' + id).remove();
                        }
                    });
                } else {

                }
            });
        }
    </script>

@endsection
