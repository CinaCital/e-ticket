<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Juragan Flight</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm">
            <div class="container">
                <a class="btn btn-danger" href="{{ url('welcome') }}">
                    Juragan flight
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- login admin  --}}
                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('penerbangan.index') }}">Penerbangan</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('transaksi.index') }}">Transaksi</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('riwayati')}}">Riwayat Transaksi</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index')}}">user-control</a>
                            </li>
                        </li>
                    @elseif (Auth::check() && Auth::user()->role == 'user')
                        <ul class="navbar-nav me-auto">
                            <li>
                                <a class="nav-link" href="{{ route('riwayati')}}">Riwayat Transaksi</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('transaksi.checkout') }}">Checkout</a>
                            </li>
                        </ul>
                        @elseif (Auth::check() && Auth::user()->role == 'maskapai')
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('penerbangan.index') }}">Penerbangan</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('transaksi.index') }}">Transaksi</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('riwayati')}}">Riwayat Transaksi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index')}}">user-control</a>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav me-auto">
                        </ul>
                    @endif



                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
