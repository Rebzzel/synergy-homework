<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/css/app.css" rel="stylesheet">
    @stack('css')
</head>
<body>
    @yield('body')
    <script src="/js/app.js"></script>
    @stack('js')
</body>
</html>