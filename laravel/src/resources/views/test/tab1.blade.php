@extends('layout.weblogin')
    @section('content')
<div class="max-w-4xl mx-auto mt-3">
    <!-- Tab Navigation -->
    <div class="bg-white shadow-md rounded-t-lg">
      <div class="flex">
        <button class="tab-btn py-2 px-6 w-full text-lg font-medium text-gray-700 focus:outline-none hover:text-blue-600 transition-all border-b-2 border-transparent hover:border-blue-500" onclick="openTab(event, 'tab1')">Staff</button>
        <button class="tab-btn py-2 px-6 w-full text-lg font-medium text-gray-700 focus:outline-none hover:text-blue-600 transition-all border-b-2 border-transparent hover:border-blue-500" onclick="openTab(event, 'tab2')">Guest</button>
      </div>
    </div>

    <!-- Tab Content -->
    <div class="bg-white p-6 rounded-b-lg shadow-md mt-2">
      <div id="tab1" class="tab-pane hidden">
        <div class="flex flex-col items-center justify-center px-6 py-6 mx-auto lg:py-0 mt-0">
            <div class="flex flex-col items-center justify-center px-6 py-6 mx-auto lg:py-0 mt-4">
                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <img src="/logo_tsi.png" alt="Logo tsi"/>
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl items-center">
                                Welcome to Bali Marine Park
                            </h1>
                            <form class="space-y-4 md:space-y-6" name="login" action="" method="post" onSubmit="return doLogin()">
                                @csrf
                                <div>
                                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Your username</label>
                                    <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="username" required="" autofocus >
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Your password</label>
                                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="password" required="">
                                </div>
                                <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign in</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
      </div>
      <div id="tab2" class="tab-pane hidden">
        <h2 class="text-2xl font-semibold">Konten Tab 2</h2>
        <p>Ini adalah konten untuk tab kedua. Cobalah menambahkan berbagai elemen lain di sini.</p>
      </div>
    </div>
</div>

  <script>
    function openTab(event, tabName) {
      // Sembunyikan semua tab
      const tabContents = document.querySelectorAll('.tab-pane');
      tabContents.forEach((tab) => tab.classList.add('hidden'));

      // Nonaktifkan semua tombol tab
      const tabButtons = document.querySelectorAll('.tab-btn');
      tabButtons.forEach((button) => button.classList.remove('text-blue-600', 'border-blue-500'));

      // Tampilkan tab yang dipilih
      document.getElementById(tabName).classList.remove('hidden');

      // Tambahkan gaya aktif pada tombol tab
      event.currentTarget.classList.add('text-blue-600', 'border-blue-500');
    }

    // Default buka tab pertama
    document.querySelector('.tab-btn').click();
  </script>
    @endsection

