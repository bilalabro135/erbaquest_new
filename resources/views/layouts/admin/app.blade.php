<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@isset($title)
            {{$title}}
           @else
             {{ ($globalsettings->getValue('site_title')) ? $globalsettings->getValue('site_title') : config('app.name', 'Laravel') }}            
           @endif

    </title>
    @if($globalsettings->getValue('site_fav'))
        <link rel="icon" type="image/x-icon" href="{{$globalsettings->getValue('site_fav')}}" sizes="16x16">
    @endif        
    <script src="https://kit.fontawesome.com/7ada220a14.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Styles -->

    @yield('head')
    
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">
</head>
<body class="{{ (isset($body_class)) ? $body_class : '' }}">


    <div id="wrapper">
        @if(!isset($sidebar) || $sidebar)
            @include('layouts.admin.sidebar')
        @endif
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">                    
                    @if(!isset($topbar) || $topbar)
                        @include('layouts.admin.topbar')
                    @endif
                    <div class="container-fluid">

                        @yield('content')

                    </div>
                </div>
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; {{ ($globalsettings->getValue( 'site_name')) ? $globalsettings->getValue( 'site_name') : config('app.name', 'Laravel') }} 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Scripts -->
        <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/admin/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/admin/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/admin/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('js/admin/sb-admin-2.js') }}" defer></script>

    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>

    @yield('scripts')
</body>
</html>