<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDAM TIRTA MUSI</title>
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.lineicons.com/2.0/LineIcons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables.css') }}">
    <link href="{{ asset('assets/select2.css') }}" rel="stylesheet" />
    <script src="{{asset('assets/select2.js')}}"></script>
    @yield('styles')

</head>

<body>
    <div class="">
        {{-- Sidebar --}}
        <x-sidebar/>

        {{-- Content --}}
        <div class="main p-4 ms-3 mt-3">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('assets/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/datatables.js') }}"></script>
    <script src="{{ asset('assets/datatables.bootstrap.js') }}"></script>

    @yield('scripts')
</body>

</html>
