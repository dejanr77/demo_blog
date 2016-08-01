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
    <!-- jQuery -->
    <script src="{{ url('js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('js/bootstrap.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('js/clean-blog.min.js') }}"></script>

    <script>
        $('#flash-overlay-modal').modal();
    </script>
    @show

</body>

</html>
