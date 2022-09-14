<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    @include('includes.header')
    <div class="d-flex">
        @include('includes.sidenav')
        <div id="content" class="position-relative" style="overflow-y: auto;">
            @yield('content')
        </div>
    </div>
</body>
</html>
