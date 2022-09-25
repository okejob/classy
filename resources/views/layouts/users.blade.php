<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    @include('includes.header')
    <div class="d-flex">
        @include('includes.sidenav')
        <div id="content" class="position-relative w-100 pb-5" style="max-height: calc(100vh - 60px); max-width: calc(100vw - 200px); overflow-y: auto;">
            @yield('content')
        </div>
    </div>
</body>
</html>
