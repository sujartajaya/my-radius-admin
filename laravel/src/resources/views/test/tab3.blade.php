<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Multi-Login dengan Tailwind CSS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Container Login -->
  <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
      <h2 class="text-2xl font-semibold text-center mb-6">Masuk ke Akun Anda</h2>

      <!-- Form Login Email -->
      <div class="mb-6">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Email Anda" required>
      </div>
      
      <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Password Anda" required>
      </div>

      <button class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
        Masuk
      </button>

      <!-- Or Divider -->
      <div class="flex items-center my-4">
        <div class="flex-grow border-t border-gray-300"></div>
        <span class="mx-4 text-gray-600">Atau</span>
        <div class="flex-grow border-t border-gray-300"></div>
      </div>

      <!-- Social Media Login -->
      <div class="space-y-4">
        <button class="w-full py-3 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all">
          Login dengan Google
        </button>
        <button class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
          Login dengan Facebook
        </button>
      </div>

      <!-- Link ke halaman Register -->
      <div class="mt-6 text-center text-sm text-gray-600">
        Belum punya akun? <a href="#" class="text-blue-600 hover:text-blue-700">Daftar Sekarang</a>
      </div>
    </div>
  </div>

</body>
</html>
