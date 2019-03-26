<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HIRE < Profs />') }}</title>
    <link rel="shortcut icon" href="{{asset('storage/img/favicon.png')}}" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <!--OWN-->
    @section('style')
        @include('partials.styles')
        @yield('css-styles')
    @show
</head>


<body>

<!--NAVBAR-->
@include('partials.header')
<main class="minh-50">
    @yield('content')
</main>


<!-- footer-->
@include('partials.footer')

<!-- Modal -->
<!--LOGIN MODAL-->
@guest
    @include('partials.auth-modal')

@endguest

@section('script')
    @include('partials.scripts')
    @yield('js-scripts')
@show
</body>

</html>
