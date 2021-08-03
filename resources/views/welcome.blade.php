
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        SIPELAKON - Sistem Pelaporan dan
    </title>
    <meta name="description" content="Dinas, Koperasi, UMKM" />
    <meta name="keywords" content="SIPELAKON" />
    <meta name="author" content="DISKOMINFOSANDITIK" />
    <link rel="shortcut icon" href="{{asset('assets/back/favicon/favicon-smd.ico')}}">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" />
    <!--Replace with your tailwind.css once created-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
    <!-- Define your gradient here - use online tools to find a gradient matching your branding-->
    <style>
        .gradient {
            background: linear-gradient(90deg, #00BFA6 0%, #F8F926 100%);
        }

    </style>
</head>

<body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">
    <!--Nav-->
    <nav id="header" class="fixed w-full z-30 top-0 text-white">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
            <div class="pl-4 flex items-center">
                <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                    href="#">
                    <!--Icon from: http://www.potlabicons.com/ -->
                    <img class="inline-flex" src="{{asset('assets/back/images/sumedang.png')}}" width="50px;" alt="">
                    SIPELAKON
                </a>
            </div>
        </div>
        <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
    </nav>
    <!--Hero-->
    <div class="pt-24">
        <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <!--Left Col-->
            <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
                <p class="uppercase tracking-loose w-full">Selamat Datang di Official Website Aplikasi</p>
                <h1 class="my-4 text-5xl font-bold leading-tight">
                    Sistem Pelaporan dan Konsultasi (SIPELAKON)
                </h1>
                <p class="leading-normal text-2xl mb-8">
                    Dinas Koperasi dan UMKM Kabupaten Sumedang
                </p>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                            Log in
                        </a>
                    @endauth
                @endif
            </div>
            <!--Right Col-->
            <div class="w-full md:w-3/5 py-6 text-center">
                <img class="w-full md:w-4/5 z-50" src="{{ asset('assets/back/images/hero.svg') }}" />
            </div>
        </div>
    </div>
</body>

</html>
