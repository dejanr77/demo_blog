<!DOCTYPE html>
<html lang="en">
<head>
    @include('public.partials.head')
</head>

<body>

    @include('public.partials.navbar')

    @yield('header')

    @include('flash::message')

    @yield('content')

<hr>

    @include('public.partials.footer')

    @section('footer')

    <script src="{{ url(elixir('js/demo_blog.js')) }}"></script>

    <script>
        $('#flash-overlay-modal').modal();
    </script>
    @show

</body>

</html>
