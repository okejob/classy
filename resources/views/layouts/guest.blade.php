<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    <div class="d-flex">
        <div id="content" class="position-relative" style="overflow-y: auto;">
            @yield('content')
        </div>
    </div>
</body>
</html>
