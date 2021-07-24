@extends('layouts.back')
@section('title')
    Role
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="page-title">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-separator-1">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Role</li>
                    </ol>
                </nav>
                <h3>Role</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    @if ($msg = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $msg }}
                        </div>
                    @endif
                    @if ($msg = Session::get('error'))
                        <div class="alert alert-danger">
                            {{ $msg }}
                        </div>
                    @endif
                    <h5 class="card-title">Daftar Role</h5>
                    <a href="javascript:void(0)" class="btn btn-info mb-1" onclick="addModal()"><i
                            class="fa fa-plus-circle"></i> Tambah</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="item_list">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($list as $item)
                                <tr id="item_{{ $item->id }}">
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="javascript:void(0)" data-name="{{ $item->name }}"
                                            data-uid="{{ $item->id }}" onclick="editModal(this)"
                                            class="btn btn-success"><i class="fa fa-edit"></i> </a>
                                        <a href="javascript:void(0)" data-name="{{ $item->name }}"
                                            data-uid="{{ $item->id }}" onclick="deleteModal(this)"
                                            class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal add -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalTitle">Tambah Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <form id="addForm">
                    <div class="modal-body">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama Role">
                        <div id="nameErrDis" style="display: none">
                            <small class="text-danger"><i id="nameErrMsg"></i></small>
                        </div>
                        <br>
                        <h6>Permission</h6>
                        <div id="nameErrDis" style="display: none">
                            <small class="text-danger"><i id="nameErrMsg"></i></small>
                        </div>
                        @foreach ($permission as $item)
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" name="permission" type="checkbox" value="{{$item->name}}" id="{{$item->id}}">
                                <label class="custom-control-label" for="{{$item->id}}">
                                    {{$item->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle">Ubah Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <form id="editForm">
                    <input type="hidden" name="id_edit" id="id_edit">
                    <div class="modal-body">
                        <input type="text" name="name_edit" id="name_edit" class="form-control">
                        <div id="nameErrDisEdit" style="display: none">
                            <small class="text-danger"><i id="nameErrMsgEdit"></i></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Perbaharui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal delete -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalTitle">Hapus user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <form id="confirmDeleteForm">
                    <input type="hidden" name="id_delete" id="id_delete">
                    <div class="modal-body">
                        apakah anda yakin menghapus <b id="namaItemModal"></b> ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Ya, Hapus !</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function addModal() {
            $('#addModal').modal('show');
        }

        function editModal(obj) {
            var id = obj.getAttribute('data-uid');
            var nama = obj.getAttribute('data-name');
            $('#id_edit').val(id);
            $('#name_edit').val(nama);

            try {
                let response = await fetch("{{ url('roles') }}/" + uid, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": _token,
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });
                var datasend = await response.json();

                $('#confirmDeleteModal').modal('hide');

                if (datasend.errors !== undefined) {
                    toastr.error('Silahkan coba lagi.', 'Error !');
                } else {
                    if (datasend.status == 'Error') {
                        toastr.error('Silahkan coba lagi.', 'Error !');
                    } else {
                        toastr.success('Data berhasil dihapus.', 'Success !');
                        document.getElementById('item_' + uid).remove();
                    }
                }

                return false;
            } catch (err) {
                console.log(err);
            }
            
            $('#editModal').modal('show');
        }

        function deleteModal(obj) {
            var id = obj.getAttribute('data-uid');
            var nama = obj.getAttribute('data-name');
            $('#id_delete').val(id);
            $('#namaItemModal').html(nama);
            $('#confirmDeleteModal').modal('show');
        }

        //Aksi Tambah
        const formAdd = document.getElementById('addForm');

        formAdd.addEventListener('submit', async (e) => {
            e.preventDefault();

            const name = formAdd.name.value;
            var permission = new Array();
            $("input:checkbox[name=permission]:checked").each(function(){
                permission.push($(this).val());
            });
            const _token = "{{ csrf_token() }}";

            try {
                let response = await fetch("{{ route('roles.store') }}", {
                    method: "POST",
                    body: JSON.stringify({
                        name: name,
                        permission : permission
                    }),
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        "X-CSRF-TOKEN": _token,
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });
                var datasend = await response.json();

                // console.log(datasend.data.id);

                if (datasend.errors !== undefined) {
                    for (const [key, value] of Object.entries(datasend.errors)) {
                        if (key != 'permission') {
                            obj = document.getElementById(key);
                            obj.classList.add('is-invalid');
                        }
                        objErrDis = document.getElementById(key + 'ErrDis');
                        objErrDis.style.display = "block";
                        objErrMsg = document.getElementById(key + 'ErrMsg');
                        objErrMsg.innerHTML = `${value}`;
                    }
                    toastr.error('Silahkan coba lagi.', 'Error !');
                } else {
                    $('#addModal').modal('hide');
                    var row = '<tr id="item_' + datasend.data.id + '"><td>' + datasend.data.name +
                        '</td>';
                    row += '<td ><a href="javascript:void(0)" data-name="' + datasend.data
                        .name + '" data-uid="' + datasend.data.id +
                        '" class="btn btn-success" onclick="editModal(this)"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" data-name="' +
                        datasend.data.name + '" data-uid="' + datasend.data.id +
                        '" class="btn btn-danger"><i class="fa fa-trash"></i> </a></td></tr>';
                    $('#item_list').prepend(row);
                    toastr.success('Data berhasil ditambahkan.', 'Success !');
                }

                return false;
            } catch (err) {
                console.log(err);
            }
        });

        // Aksi Ubah
        const formEdit = document.getElementById('editForm');

        formEdit.addEventListener('submit', async (e) => {
            e.preventDefault();

            const uid = formEdit.id_edit.value;
            const name = formEdit.name_edit.value;
            const _token = "{{ csrf_token() }}";

            try {
                let response = await fetch("{{ url('roles') }}/" + uid, {
                    method: "PUT",
                    body: JSON.stringify({
                        name: name
                    }),
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        "X-CSRF-TOKEN": _token,
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });
                var datasend = await response.json();

                if (datasend.errors !== undefined) {
                    for (const [key, value] of Object.entries(datasend.errors)) {
                        obj = document.getElementById(key);
                        obj.classList.add('is-invalid');
                        objErrDis = document.getElementById(key + 'ErrDisEdit');
                        objErrDis.style.display = "block";
                        objErrMsg = document.getElementById(key + 'ErrMsgEdit');
                        objErrMsg.innerHTML = `${value}`;
                    }
                    toastr.error('Silahkan coba lagi.', 'Error !');
                } else {
                    if (datasend.status == 'Error') {
                        toastr.error('Silahkan coba lagi.', 'Error !');
                    } else {
                        $('#editModal').modal('hide');
                            var row = '<tr id="item_' + datasend.data.id + '"><td>' + datasend.data.name +
                            '</td>';
                        row += '<td ><a href="javascript:void(0)" data-name="' + datasend.data
                            .name + '" data-uid="' + datasend.data.id +
                            '" class="btn btn-success" onclick="editModal(this)"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" data-name="' +
                            datasend.data.name + '" data-uid="' + datasend.data.id +
                            '" class="btn btn-danger"><i class="fa fa-trash"></i> </a></td></tr>';
                        $('#item_'+datasend.data.id).replaceWith(row);
                        toastr.success('Data berhasil diperbaharui.', 'Success !');
                    }
                }

                return false;
            } catch (err) {
                console.log(err);
            }
        });

        //Aksi Hapus
        const formDelete = document.getElementById('confirmDeleteForm');

        formDelete.addEventListener('submit', async (e) => {
            e.preventDefault();

            const uid = formDelete.id_delete.value;
            const _token = "{{ csrf_token() }}";

            try {
                let response = await fetch("{{ url('roles') }}/" + uid, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": _token,
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });
                var datasend = await response.json();

                $('#confirmDeleteModal').modal('hide');

                if (datasend.errors !== undefined) {
                    toastr.error('Silahkan coba lagi.', 'Error !');
                } else {
                    if (datasend.status == 'Error') {
                        toastr.error('Silahkan coba lagi.', 'Error !');
                    } else {
                        toastr.success('Data berhasil dihapus.', 'Success !');
                        document.getElementById('item_' + uid).remove();
                    }
                }

                return false;
            } catch (err) {
                console.log(err);
            }
        });
    </script>
@endsection
