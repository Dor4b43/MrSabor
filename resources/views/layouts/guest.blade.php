<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mr. Sabor Burgers — @yield('title', 'Bienvenido')</title>
    <meta name="description" content="Mr. Sabor Burgers — La mejor comida artesanal de la ciudad.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background:var(--bg-main, #181109); min-height:100vh;">
    {{ $slot }}
</body>
</html>
