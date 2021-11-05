<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('backend/css/styles.css') }}" rel="stylesheet" />

    @stack('css')
</head>

<body class="nav-fixed">
    <div class="overlay"></div>
    <!-- Navbar -->
    @include('partials.nav')
    <!-- Sidebar -->
    <div id="layoutSidenav">
        @include('partials.aside')
        <div id="layoutSidenav_content">
            <main>
                <!-- Main content-->
                <div class="container mt-4">
                    <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                        {{-- <div class="bg-red"> --}}
                        <h1 class="mb-5">@yield('banner')</h1>
                    
                        @can('company')
                        <div>
                            <span class="font-weight-500 text-primary">
                                Current Balance:
                                &#8358; {{auth()->user()->balance()}}
                            </span>
                        </div>                   
                    @endcan
                    </div>
                    <!-- Header -->
                    @yield('header')

                    @if(session('success'))
                    <x-base.alert type="primary" title="Success" icon="fa-check">
                        {{ session('success') }}
                    </x-base.alert>
                    @endif

                    @if(session('error'))
                    <x-base.alert type="danger" title="Error" icon="fa-times">
                        {{ session('error') }}
                    </x-base.alert>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('backend/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/main.js') }}"></script>
    <script src="{{ asset('backend/js/app.js') }}"></script>
    <script>
        function turnOnOverlay() {
            $('.overlay').css('display', 'block');
        }

        function turnOffOverlay() {
            $('.overlay').css('display', 'none');
        }
    </script>
    @stack('scripts')
</body>

</html>