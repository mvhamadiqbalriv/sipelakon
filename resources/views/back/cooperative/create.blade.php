@extends('layouts.back')
@section('title')
    Create
@endsection
@section('content')
    <br>
    <div class="container">
        <div class="tt-wrapper-inner">
            <h1 class="tt-title-border">
                Create New Koperasi
            </h1>
            <form action="{{route('cooperative.cooperative-store')}}" method="POST" class="form-default form-create-topic">
                @csrf
                <div class="form-group">
                    <label for="inputTopicTitle">Nama Koperasi</label>
                    <div class="tt-value-wrapper">
                        <input type="text" name="name" {{old('name')}} class="form-control" id="inputTopicTitle"
                            placeholder="Masukan nama koperasi">
                    </div>
                    @error('name')
                    <div class="tt-note" style="color:red">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="inputTopicTitle">NIK</label>
                    <div class="tt-value-wrapper">
                        <input type="number" name="nik" value="{{old('nik')}}" class="form-control" id="inputTopicTitle"
                            placeholder="NIK Koperasi">
                    </div>
                    @error('nik')
                    <div class="tt-note" style="color:red">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="jenis_usaha">Jenis Kategori</label>
                    <br>
                    @php
                        $oldCat = array();
                        if(old('category') != null){
                            $oldCat = old('category');
                        }
                    @endphp
                    @foreach ($jenis_usaha as $item)
                        <label for="jenis_usaha_{{$item->id}}" class="inline-flex items-center">
                            <input type="checkbox" value="{{$item->id}}" {{(in_array($item->id,$oldCat)) ? 'checked' : null}} name="category[]" id="jenis_usaha_{{$item->id}}" class="form-checkbox h-5 w-5 text-gray-600"><span
                                class="ml-2 text-white-300">{{$item->nama}}</span>
                        </label>
                        <br>
                    @endforeach
                    @error('category')
                        <div class="tt-note" style="color:red">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="pt-editor">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputTopicTitle">Kecamatan</label>
                                <select name="district_id" id="kecamatan" class="form-control">
                                    <option value="">-- Pilih Kecamatan --</option>
                                    @foreach ($kecamatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('district_id')
                                    <div class="tt-note" style="color:red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputTopicTitle">Desa</label>
                                <select name="village_id" id="desa" class="form-control">
                                    <option value="">-- Select --</option>
                                </select>
                                @error('village_id')
                                    <div class="tt-note" style="color:red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTopicTitle">Alamat</label>
                        <textarea name="alamat" class="form-control" id="" cols="30" rows="10">{{old('alamat')}}</textarea>
                        @error('alamat')
                            <div class="tt-note" style="color:red">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-auto ml-md-auto">
                            <button type="submit" class="btn btn-secondary btn-width-lg">Create Koperasi</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const kecamatanDropdown = document.getElementById('kecamatan');

        kecamatanDropdown.addEventListener('change', async (e) => {
            e.preventDefault();

            var id = kecamatanDropdown.value;
            var _token = "{{ csrf_token() }}"

            try {
                let response = await fetch("{{ route('directory-village') }}", {
                    method: "POST",
                    body: JSON.stringify({
                        id: id
                    }),
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": _token,
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });
                var datasend = await response.json();
                if (datasend !== undefined) {
                    var obj = document.getElementById('desa');
                    obj.innerHTML = "";

                    for (var k in datasend) {
                        var opt = '<option value="' + k + '">' + datasend[k] + '</option>';
                        obj.innerHTML = obj.innerHTML + opt;
                    }
                }

            } catch (err) {
                console.log(err);
            }
        });
    </script>
@endsection
