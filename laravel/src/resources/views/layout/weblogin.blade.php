<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body  class="w-screen overflow-y-auto overflow-x-hidden tems-center justify-center" style="background: #ccf5ff;">
    <nav class="bg-green-600 border-gray-200 ">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="/logo.png" class="h-8" alt="Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Bali Marine Login Page</span>
        </a>
      </div>
    </nav>  
    <main class="flex py-4 mx-2">
            @yield('content')
    </main>
</body>
</html>