<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->

        <link href="{{ asset('admin_assets/css/style.css')}}" rel="stylesheet">
        <link href="{{ asset('admin_assets/css/main.87c0748b313a1dda75f5.css')}}" rel="stylesheet">
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.js"></script>
        @yield('before_body')

        @livewireStyles

        <!-- Scripts -->
    </head>
    <body class="font-sans antialiased">


        @include('partial.menu')
       
        {{-- <x-jet-banner /> --}}

        {{-- <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
        </div> --}}
            {{-- <main>
                {{ $slot }}
            </main> --}}
        @livewireScripts
        <script src="{{ asset('js/app.js') }}" ></script>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ asset('admin_assets/scripts/main.87c0748b313a1dda75f5.js')}}"></script>
       <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

        <script type="text/javascript">

                $(document).ready( function () {

                $('.vertical-nav-menu li').on('click',function () {
                   // alert('dsafdsa');
                })
                    $('#DataTable').DataTable();
                } );
        </script>
        @yield('afterScript')
       

    </body>
</html>
