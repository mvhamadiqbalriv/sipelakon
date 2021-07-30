<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{asset('assets/back/images/sumedang.png')}}" width="100px;" alt="">
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
                <x-label for="name" :value="__('Nama Koperasi')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- NIK -->
            <div class="mt-4">
                <x-label for="nik" :value="__('NIK Koperasi')" />

                <x-input id="number" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')" required
                    autofocus />
            </div>

            <!-- Kecamatan -->
            <div class="mt-4">
                <x-label for="kecamatan" :value="__('Kecamatan')" />
                    <select name="district_id" id="kecamatan"
                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Regular input">
                        <option value="">-- Pilih Kecamatan --</option>
                        @foreach ($kecamatan as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
            </div>

            <!-- Desa -->
            <div class="mt-4">
                <x-label for="desa" :value="__('Desa / Kelurahan')" />
                    <select name="village_id" id="desa"
                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Regular input">
                        <option value="">-- Pilih Desa --</option>
                        <option value="">Pilih kecamatan terlebih dahulu</option>
                    </select>
            </div>

            <!-- Alamat -->
            <div class="mt-4">
                <x-label for="alamat" :value="__('Alamat')" />

                <x-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" />
            </div>
            
            <!-- Jenis Usaha -->
            <div class="mt-4">
                <x-label for="jenis_usaha" :value="__('Jenis Usaha')" />
                    <select name="category_cooperative_id" id="jenis_usaha"
                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Regular input">
                        @foreach ($jenis_usaha as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
            </div>

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
                var _token = "{{csrf_token()}}"

                try {
                let response = await fetch("{{route('directory-village')}}", {
                    method: "POST",
                    body: JSON.stringify({
                        id : id
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
                    
                    for(var k in datasend) {
                        var opt = '<option value="'+k+'">'+datasend[k]+'</option>';
                        obj.innerHTML = obj.innerHTML + opt;
                    }
                }

            } catch (err) {
                console.log(err);
            }
        });

    </script>
</x-guest-layout>
