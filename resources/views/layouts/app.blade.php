<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <div class="container">
        {{-- header --}}
        @include('layouts.header')

        {{-- navbar --}}
        @include('layouts.navbar')

        {{-- content --}}
        @include('layouts.content')

        {{-- sidebar --}}
        @include('layouts.sidebar')

        {{-- footer --}}
        @include('layouts.footer')
    </div>
    <script src="js/app.js"></script>
</body>
</html>