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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Nama Lengkap <sup title="Wajib diisi" class="text-red-600">*</sup></label>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" 
                     />
            </div>

            <!-- NIK -->
            <div class="mt-4">
                <label for="number" class="block font-medium text-sm text-gray-700">NIK</label>

                <x-input id="number" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')" 
                     />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="block font-medium text-sm text-gray-700">Email <sup title="Wajib diisi" class="text-red-600">*</sup></label>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Username -->
            <div class="mt-4">
                <label for="username" class="block font-medium text-sm text-gray-700">Username <sup title="Wajib diisi" class="text-red-600">*</sup></label>

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                    required />
            </div>

            <!-- Koperasi -->
            <div class="mt-4">
                <label for="koperasi" class="block font-medium text-sm text-gray-700">Koperasi <sup title="Wajib diisi" class="text-red-600">*</sup></label>
                    <select name="cooperative_id" id="koperasi"
                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Regular input">
                        @foreach ($koperasi as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <a class="italic text-sm text-gray-600 hover:text-gray-900 text-right" href="{{ route('koperasi.create') }}">
                        {{ __('Koperasi belum terdaftar?') }}
                    </a>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Password <sup title="Wajib diisi" class="text-red-600">*</sup></label>

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Password <sup title="Wajib diisi" class="text-red-600">*</sup></label>

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>
            <small class="italic">NB: Inputan dengan tanda (<sup title="Wajib diisi" class="text-red-600">*</sup>) Wajib diisi.</small>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
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

                    // if (datasend.errors !== undefined) {
                    //     for (const [key, value] of Object.entries(datasend.errors)) {
                    //         obj = document.getElementById(key);
                    //         obj.classList.add('is-invalid');
                    //         objErrDis = document.getElementById(key+'ErrDis');
                    //         objErrDis.style.display = "block";
                    //         objErrMsg = document.getElementById(key+'ErrMsg');
                    //         objErrMsg.innerHTML = `${value}`;
                    //     }
                    //     toastr.error('Silahkan coba lagi.', 'Error !')
                    // }else{
                    //     for (const [key, value] of Object.entries(datasend.data)) {
                    //         if (key == 'id' || key == 'created_at' || key == 'updated_at') {
                    //             continue;
                    //         }
                    //         obj = document.getElementById(key);
                    //         obj.classList.remove('is-invalid');
                    //         objErrDis = document.getElementById(key+'ErrDis');
                    //         objErrDis.style.display = "none";
                    //         objErrMsg = document.getElementById(key+'ErrMsg');
                    //         objErrMsg.innerHTML = `${value}`;
                    //     } 
                    //     toastr.success('Web profile berhasil diperbaharui.', 'Success !')
                    // }

            } catch (err) {
                console.log(err);
            }
        });

    </script>
</x-guest-layout>
