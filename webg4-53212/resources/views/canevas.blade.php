<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/content/style.css">
    <title>{{config('app.name', 'Laravel')}}</title>
    @yield('header')
</head>
<body>
    <header>
        <h1><img src="/content/logo.png" >{{config('app.name', 'Laravel')}}</h1>
    <a href="/">Home</a>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
    WEBG4 - WEBII - TNI
    </footer>
</body>
</html>
