@extends('layout.weblogin')
    @section('content')
        <form name="sendin" action="{{ $data['link-login'] }}" method="post">
          <input type="hidden" name="username" />
          <input type="hidden" name="password" />
          <input type="hidden" name="dst" value="{{ $data['link-orig'] }}" />
          <input type="hidden" name="popup" value="true" />
        </form>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script type="text/javascript" src="/tsi/md5.js"></script>
        <script type="text/javascript">
            function doLogin() {
                  <?php if(strlen($data['chap-id']) < 1) echo "return true;\n"; ?>
                  document.sendin.username.value = document.login.username.value;
                  document.sendin.password.value = hexMD5('<?php echo $data['chap-id']; ?>' + document.login.password.value + '<?php echo $data['chap-challenge']; ?>');
                  document.sendin.submit();
                  return false;
            }
            /** guest email login */
            function emailLogin(email) {
                  <?php if(strlen($data['chap-id']) < 1)  { ?>
                    document.sendin.username.value = email; //document.login.username.value;
                    document.sendin.password.value = email; //document.login.username.value;
                    document.sendin.submit();
                  <?php }  else { ?>
                    document.sendin.username.value = email; //document.login.username.value;
                    document.sendin.password.value = hexMD5('<?php echo $data['chap-id']; ?>' + email + '<?php echo $data['chap-challenge']; ?>');
                    document.sendin.submit();
                  <?php } ?>
            }
            function checkEmail() {
                let email = document.getElementById('email');
                    axios
                        .post("<?php echo env('APP_URL'); ?>:8000/web/api/logmail",{
                            'email' : email.value
                        },{
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then ((response) => {
                            console.log(response.data);
                            const data = response.data;
                            if (data['error']) {
                                //alert(data['data']);
                                document.getElementById("error").innerHTML = data['data'];
                            } else {
                                /** Kode untuk langsung login */
                                emailLogin(email.value);
                                //document.getElementById("error").innerHTML = data['data'];
                            }
                            //const data = response.data;
                            //username.value = data[0].username                        
                        })                        
            }
        </script>

        <div class="max-w-4xl mx-auto mt-1">
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
                <!-- start awal-->
                    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0 mt-10">
                            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
                                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                    <img src="/logo_tsi.png" alt="Logo tsi"/>
                                    @if($data['error'])
                                        <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <div>
                                            <span class="font-medium">Error Messages!</span> {{ $data['error'] }}
                                        </div>
                                        </div>
                                    @endif    
                                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl items-center">
                                        Welcome to Bali Marine Park
                                    </h1>
                                    <form class="space-y-4 md:space-y-6" name="login" action="<?php echo $data['link-login']; ?>" method="post" onSubmit="return doLogin()">
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
                <!-- end -->
                </div>
                <div id="tab2" class="tab-pane hidden">
                    <!-- guest email login -->
                        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0 mt-10">
                            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
                                
                                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                    <img src="/logo_tsi.png" alt="Logo tsi"/>
                                    @if($data['error'])
                                        <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <div>
                                            <span class="font-medium">Error Messages!</span> {{ $data['error'] }}
                                        </div>
                                        </div>
                                    @endif
                                    <div id="error" class="invalid block text-sm font-medium text-gray-700 dark:text-red-600 mb-2"></div>    
                                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl items-center">
                                        Welcome to Bali Marine Park
                                    </h1>
                                    <form class="space-y-4 md:space-y-6" name="login" action="<?php echo $data['link-login']; ?>" method="post">
                                        @csrf
                                        <div>
                                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="yourname@company.com" required autofocus >
                                        </div>
                                        <div class="hidden">
                                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Your password</label>
                                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="password" required="">
                                        </div>
                                    </form>
                                    <button class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" onClick="checkEmail()">Sign in</button>
                                </div>
                            </div>
                        </div>                     
                    <!-- guest email login -->
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