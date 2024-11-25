<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ecorewards') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="static/css/style.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="static/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="static/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .bg-custom {
            background-color: #ffffff;
        }
        .brand-text {
            color: #f8f9fa;
        }

        .brand-text:hover {
            color: #002451;
        }
        .logo-size {
            width: 50px;
            height: 50px;
            opacity: 0.8;
        }
    </style>
</head>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="static/lib/easing/easing.min.js"></script>
    <script src="static/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="static/lib/tempusdominus/js/moment.min.js"></script>
    <script src="static/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="static/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="static/mail/jqBootstrapValidation.min.js"></script>
    <script src="static/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="static/js/main.js"></script>