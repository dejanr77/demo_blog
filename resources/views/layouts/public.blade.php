<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.public_head')
</head>

<body>

    @include('partials.public_navbar')

    @yield('header')

    @include('flash::message')

    @yield('content')

<hr>

    @include('partials.public_footer')

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
