<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ecorewards') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link href="{{ asset('static/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('static/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="{{ asset('static/css/style.css') }}" rel="stylesheet">

    <!--@vite(['resources/sass/app.scss', 'resources/js/app.js'])-->
    @vite(['resources/sass/style.scss'])
    @vite(['resources/css/style.css'])

    <style>
        .bg-custom {
            background-color: #ffffff;
        }
        .brand-text {
            color: #f8f9fa;
        }

        .brand-text:hover {
            color: #669928;
        }
        .logo-size {
            width: 50px;
            height: 50px;
            opacity: 0.8;
        }
    </style>
</head>

