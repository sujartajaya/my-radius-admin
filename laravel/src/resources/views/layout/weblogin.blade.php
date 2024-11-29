<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body  class="w-screen overflow-y-auto overflow-x-hidden flex items-center justify-center" style="background: #ccf5ff;">
    <main class="flex py-4 mx-2">
            @yield('content')
    </main>
</body>
</html>