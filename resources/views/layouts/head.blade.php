<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Moving Company</title>
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}">
    
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{asset('template/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/bootstrap-extend.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/site.min.css')}}">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{asset('template/vendor/animsition/animsition.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/asscrollable/asScrollable.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/switchery/switchery.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/intro-js/introjs.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/slidepanel/slidePanel.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/flag-icon-css/flag-icon.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/blueimp-file-upload/jquery.fileupload.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/dropify/dropify.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/summernote/summernote.css')}}">

    <link rel="stylesheet" href="{{asset('template/vendor/bootstrap-datepicker/bootstrap-datepicker.css')}}">

    <!-- Jsgrid -->
    <link rel="stylesheet" href="{{asset('template/css/jsgrid-theme.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/Plugins/jsgrid/css/jsgrid.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/Plugins/jsgrid/css/jsgrid-theme.min.css')}}">

    <!-- custom made css -->
    <link rel="stylesheet" href="{{asset('template/css/js-grid-table.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/general.css')}}">


    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('template/fonts/font-awesome/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('template/fonts/web-icons/web-icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/fonts/brand-icons/brand-icons.min.css')}}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


    <!-- Scripts -->
    <script src="{{asset('template/vendor/breakpoints/breakpoints.js')}}"></script>
    <script>
        Breakpoints();
    </script>

    <style>
        .disable input{
            background:#eee;
            border:none;
            outline: none;
        }
    </style>

    @yield('insert-css')
</head>

