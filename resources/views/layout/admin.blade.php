<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    
</head>
<body>
    <header>
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="/js/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
    </header>
    
    <section>
        @include('admin.common.leftmenu')
    <section>

    <article>
        @yield('content')
    </article>

    <footer></footer>
</body>
</html>