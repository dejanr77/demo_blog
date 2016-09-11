<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.partials.head')
</head>
<body>
<div class="wrapper">
    @include('admin.partials.header')

    @include('admin.partials.sidebar')

    <div class="main-content">
        @yield('content')
    </div><!-- ./content-wrapper -->

</div><!-- ./wrapper -->

@section('footer')
    <script src="{{ url(elixir('js/dashboard.js')) }}"></script>

    <script>
        $('#flash-overlay-modal').modal();
    </script>
@show
</body>
</html>
