@section('title')
    Daftar Koperasi
@endsection
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('assets/back/images/sumedang.png') }}" width="100px;" alt="">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        @if (session('success'))
            <div class="font-medium text-green-600">
                {{ session('success') }}
            </div>
        @endif
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('koperasi.store') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Nama Koperasi <sup title="Wajib diisi" class="text-red-600">*</sup></label>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    autofocus />
            </div>

            <!-- NIK -->
            <div class="mt-4">
                <label for="number" class="block font-medium text-sm text-gray-700">NIK Koperasi <sup title="Wajib diisi" class="text-red-600">*</sup></label>

                <x-input id="number" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')"
                    autofocus />
            </div>

            <!-- Kecamatan -->
            <div class="mt-4">
                <label for="kecamatan" class="block font-medium text-sm text-gray-700">Kecamatan <sup title="Wajib diisi" class="text-red-600">*</sup></label>
                <select name="district_id" id="kecamatan"
                    class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Regular input">
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach ($kecamatan as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Desa -->
            <div class="mt-4">
                <label for="desa" class="block font-medium text-sm text-gray-700">Desa <sup title="Wajib diisi" class="text-red-600">*</sup></label>
                <select name="village_id" id="desa"
                    class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Regular input">
                    <option value="">-- Pilih Desa --</option>
                    <option value="">Pilih kecamatan terlebih dahulu</option>
                </select>
            </div>

            <!-- Alamat -->
            <div class="mt-4">
                <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat <sup title="Wajib diisi" class="text-red-600">*</sup></label>

                <x-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" />
            </div>

            <!-- Jenis Usaha -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700">Jenis Usaha <sup title="Wajib diisi" class="text-red-600">*</sup></label>
                @foreach ($jenis_usaha as $item)
                    <label for="jenis_usaha_{{$item->id}}" class="inline-flex items-center">
                        <input type="checkbox" value="{{$item->id}}" name="category[]" id="jenis_usaha_{{$item->id}}" class="form-checkbox h-5 w-5 text-gray-600"><span
                            class="ml-2 text-gray-700">{{$item->nama}}</span>
                    </label>
                    <br>
                @endforeach
            </div>

            <small class="italic">NB: Inputan dengan tanda (<sup title="Wajib diisi" class="text-red-600">*</sup>) Wajib diisi.</small>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Login ?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
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
</x-guest-layout>
