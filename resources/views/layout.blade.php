<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>{{$title ?? 'Job advertisement'}}</title>

</head>
<body class="bg-gray-100">
<x-header />
@if(request()->is('/'))
    <x-hero />
    <x-top-banner />
@endif
<main class="container mx-auto p-4 mt-4">
    {{$slot}}
</main>

<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
