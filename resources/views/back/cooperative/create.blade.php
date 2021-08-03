@extends('layouts.back')
@section('title')
    Tambah Koperasi
@endsection
@section('content')
    <br>
    <div class="container">
        <div class="tt-wrapper-inner">
            <h1 class="tt-title-border">
                Tambah Koperasi Baru
            </h1>
            <form action="{{route('cooperative.cooperative-store')}}" method="POST" class="form-default form-create-topic">
                @csrf
                <div class="form-group">
                    <label for="inputTopicTitle">Nama Koperasi <sup style="color:red">*</sup> </label>
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
                    <label for="inputTopicTitle">NIK <sup style="color:red">*</sup></label>
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
                    <label for="jenis_usaha">Jenis Kategori <sup style="color:red">*</sup></label>
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
                        {!! $loop->last ? null : '<br>' !!}
                    @endforeach
                    @error('category')
                        <div class="tt-note" style="color:red">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputTopicTitle">Kecamatan <sup style="color:red">*</sup></label>
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
                                <label for="inputTopicTitle">Desa <sup style="color:red">*</sup></label>
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
                        <label for="inputTopicTitle">Alamat <sup style="color:red">*</sup></label>
                        <textarea name="alamat" class="form-control" id="" cols="30" rows="3">{{old('alamat')}}</textarea>
                        @error('alamat')
                            <div class="tt-note" style="color:red">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <small class="italic">NB: Inputan dengan tanda (<sup title="Wajib diisi" style="color:red">*</sup>) Wajib diisi.</small>
                    <div class="row">
                        <div class="col-auto ml-md-auto">
                            <button type="submit" class="btn btn-secondary btn-width-lg">Tambah Koperasi</button>
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
