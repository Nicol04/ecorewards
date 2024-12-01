@include('layouts.head')
@include('layouts.navbar')
<body>
    @if ( ($message = Session::get('mensaje')) && ($icono = Session::get('icono')) )
    <script>
        Swal.fire({
            title: "Mensaje",
            text: "{{$message}}",
            icon: "{{$icono}}"
        });
    </script>
    @endif
    @include('layouts.mid')
    <div id="app">

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
@include('layouts.end')
</html>