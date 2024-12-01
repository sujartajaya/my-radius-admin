@extends('layout.weblogin')
    @section('content')
        <form name="sendin" action="" method="post">
          <input type="hidden" name="username" />
          <input type="hidden" name="password" />
          <input type="hidden" name="dst" value="" />
          <input type="hidden" name="popup" value="true" />
        </form>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script type="text/javascript" src="/tsi/md5.js"></script>
        <script type="text/javascript">
            function doLogin() {
                const sendinForm = document.getElemenById('sendin');
                sendinForm.addEventListener("submit", (e) => {
                    e.preventDefault();

                    axios
                        .post("http://localhost:8000/web/api/logmail",{
                            'email' : 'putu@velo.co.id'
                        },{
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then ((response) => {
                            //console.log(reponse);
                            const data = JSON.parse(response.data);
                            
                        })
                })
                 /** ini dikembalikan */
            }
            function test() {
                    let username = document.getElementById('username')
                    axios
                        .post("http://localhost:8000/web/api/logmail",{
                            'email' : username.value
                        },{
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then ((response) => {
                            console.log(response.data);
                            //const data = response.data;
                            //username.value = data[0].username                        
                        })
               
            }
        </script>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0 mt-10">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
                
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <img src="/logo_tsi.png" alt="Logo tsi"/>
                  
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl items-center">
                        Welcome to Bali Marine Park
                    </h1>
                    <form class="space-y-4 md:space-y-6" name="login" action="#" method="post" onSubmit="return doLogin()">
                        @csrf
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
                            <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="username" required="" autofocus >
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="password" required="">
                        </div>
                        
                    </form>
                    <button class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" onClick="test()">Sign in</button>
                </div>
            </div>
        </div>
    @endsection
    