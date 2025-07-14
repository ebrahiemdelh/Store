<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layout.css')
    @stack('styles')
    <title>@yield('title', 'Title Page')</title>
</head>

<body>
    @include('layout.header')
    {{-- @include('layout.sidebar') --}}
    <x-nav />
    @yield('content')
    @flasher
    @section('breadcrumb')
        @include('layout.footer')
        @stack('scripts')
        @flasherScripts
    </body>

    </html>
