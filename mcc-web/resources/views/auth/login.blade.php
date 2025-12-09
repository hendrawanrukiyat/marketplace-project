<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Majalengka Creative Center</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    
    <div class="flex min-h-screen">
        
        <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900">
            <img src="{{ asset('images/MCC.jpg') }}" alt="Gedung MCC" class="absolute inset-0 w-full h-full object-cover opacity-60">
            
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>

            <div class="relative z-10 flex flex-col justify-end p-12 text-white w-full">
                <div class="mb-6">
                    <div class="w-12 h-12 bg-[#E67E22] rounded-xl flex items-center justify-center text-white font-bold text-2xl mb-6 shadow-lg">M</div>
                    <h2 class="text-4xl font-bold tracking-tight mb-4">Selamat Datang Kembali, <br>Pelaku Ekraf!</h2>
                    <p class="text-gray-300 text-lg max-w-md">
                        Kelola produk kreatif Anda, pantau performa, dan jangkau pasar yang lebih luas melalui platform Majalengka Creative Center.
                    </p>
                </div>
                <div class="flex gap-2">
                    <span class="h-1 w-12 bg-[#E67E22] rounded-full"></span>
                    <span class="h-1 w-2 bg-gray-600 rounded-full"></span>
                    <span class="h-1 w-2 bg-gray-600 rounded-full"></span>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 lg:p-24 bg-white">
            
            <div class="w-full max-w-md space-y-8">
                <div class="lg:hidden text-center mb-8">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-[#E67E22] text-white font-bold text-2xl mb-4">M</div>
                    <h2 class="text-2xl font-bold text-gray-900">Masuk ke Akun Anda</h2>
                </div>

                <div class="hidden lg:block">
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Login Pelaku Ekraf</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Belum punya akun? 
                        <a href="#" class="font-medium text-[#E67E22] hover:text-orange-600 transition">Hubungi Admin MCC</a>
                        untuk pendaftaran.
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="block w-full appearance-none rounded-lg border border-gray-300 px-4 py-3 placeholder-gray-400 shadow-sm focus:border-[#E67E22] focus:outline-none focus:ring-1 focus:ring-[#E67E22] sm:text-sm transition"
                                placeholder="nama@email.com"
                                value="{{ old('email') }}">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="current-password" required 
                                class="block w-full appearance-none rounded-lg border border-gray-300 px-4 py-3 placeholder-gray-400 shadow-sm focus:border-[#E67E22] focus:outline-none focus:ring-1 focus:ring-[#E67E22] sm:text-sm transition"
                                placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-[#E67E22] focus:ring-[#E67E22]">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">Ingat saya</label>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-medium text-[#E67E22] hover:text-orange-600 transition">
                                    Lupa kata sandi?
                                </a>
                            </div>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-full border border-transparent bg-[#E67E22] py-3 px-4 text-sm font-bold text-white shadow-lg hover:bg-[#D35400] hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-[#E67E22] focus:ring-offset-2 transition transform hover:-translate-y-0.5">
                            Masuk Sekarang
                        </button>
                    </div>
                </form>
                
                <div class="mt-6 text-center">
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-400 hover:text-gray-600 transition flex items-center justify-center gap-2">
                        &larr; Kembali ke Halaman Utama
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>