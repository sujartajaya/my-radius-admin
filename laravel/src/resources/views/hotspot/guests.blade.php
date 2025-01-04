@extends('layout.app')
    @section('content')
        <script>
            let editdata = false;let iduser = 0;
            function edit(id) {
                editdata = true;iduser = id;const saveFooterBtn = document.getElementById('saveFooterBtn');const modal = document.getElementById('largeModal');saveFooterBtn.innerHTML = "Update";
                axios.get("<?php echo env('APP_URL'); ?>:8000/hotspot/guest/user/"+id).then((response) => {const name = document.getElementById('name');const email = document.getElementById('email');const username = document.getElementById('username');const password = document.getElementById('password');const phone = document.getElementById('phone');const address = document.getElementById('address');name.value = response.data.name;email.value = response.data.email;username.value = response.data.username;password.value = response.data.password;phone.value = response.data.phone;address.value = response.data.address;}).catch(err => {console.log('Oh noooo!!');console.log(err.response.data);});
                modal.classList.remove('hidden');
            }
        </script>        
        <!-- User table -->    
        <div class="max-w w-full">
            <div class="flex flex-col items-center justify-center px-3 py-8 mx-auto lg:py-0 mt-1">
                <div class="w-full max-w-6xl bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Guest User Management</h2>
                    <div class="flex flex-col px-3 py-8 mx-auto lg:py-0 mt-1 items-center justify-center">
                            <div class="w-full max-w-sm min-w-[200px] relative">
                            <div class="relative">
                                <form action="/hotspot/guests" method="GET">
                                <input name="search"
                                class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                                placeholder="Search ...."
                                />
                                <button
                                class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white rounded "
                                type="button"
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-slate-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                                </button>
                                </form>
                            </div>
                            </div>
                    </div>
                    <button
                        class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" id="openModalBtn"
                    >
                        Add User
                    </button>
                    </div>
                    <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">#</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Name</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Email</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Username</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">phone</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=$guestusers->firstItem(); $dt = 0; ?>
                        @foreach ($guestusers as $user)
                        <tr>
                            <?php $dt=$dt+1; ?>
                            <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $i++ }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{$user->email}}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $user->username }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $user->phone }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">
                            <div class="flex space-x-2">
                                <button
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400" onClick="edit({{ $user->id }})"
                                >
                                Edit
                                </button>
                                <button
                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400" onClick="openUserProfileModal({{$user->id}})"
                                >
                                Profile
                                </button>
                                <button
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                                >
                                Status
                                </button>
                                <button
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400"
                                >
                                Delete
                                </button>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="w-full text-sm text-left rtl:text-right text-gray-500 mt-2">
                        {{$guestusers->withQueryString()->links()}}
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Uset table -->
        <!-- Modal input/update user -->
        <div id="largeModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white w-full max-w-4xl rounded-lg shadow-lg">
                <!-- Modal Header -->
                <div class="flex justify-between items-center px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Add new user</h2>
                <button
                    id="closeModalBtn"
                    class="text-gray-600 hover:text-gray-800 focus:outline-none"
                >
                    ✖
                </button>
                </div>
                <!-- Modal Body -->
                <div class="relative p-6 flex-auto">
                                    <form>
                                    <div class="flex flex-wrap -mx-3 mb-4">
                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">Name</label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" type="text" placeholder="Your name" autofocus>
                                                </div>
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">Email</label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" placeholder="yorname@example.com">
                                                </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-4">
                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="username">username</label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="username" type="text" placeholder="Username">
                                                </div>
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">Password</label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="password" type="text" placeholder="******************">
                                                </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-4">
                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">Adress</label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="address" type="text" placeholder="Address">
                                                </div>
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">phone</label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="phone" type="phone">
                                                </div>
                                    </div>
                                    </form>

                </div>
                <!-- Modal Footer -->
                <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b space-x-2">
                <button
                    id="closeFooterBtn"
                    class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                >
                    Close
                </button>
                <button id="saveFooterBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                Save
                </button>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            const per_page = {{ $guestusers->perPage() }};let last_page = {{ $guestusers->lastPage() }};const url_base = "{{ env('APP_URL')}}:8000/hotspot/guest/users";const data_table = {{ $guestusers->total() }};
            const openModalBtn = document.getElementById('openModalBtn');const closeModalBtn = document.getElementById('closeModalBtn');const closeFooterBtn = document.getElementById('closeFooterBtn');const modal = document.getElementById('largeModal');const saveFooterBtn = document.getElementById('saveFooterBtn');
            openModalBtn.addEventListener('click', () => {
                editdata = false;saveFooterBtn.innerHTML = "Save";const name = document.getElementById('name');const email = document.getElementById('email');const username = document.getElementById('username');const password = document.getElementById('password');
                const phone = document.getElementById('phone');const address = document.getElementById('address');name.value = "";email.value = "";username.value = "";password.value = "";phone.value = "";address.value = "";modal.classList.remove('hidden');
            });

            saveFooterBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');const name = document.getElementById('name');const email = document.getElementById('email');const username = document.getElementById('username');const password = document.getElementById('password');const phone = document.getElementById('phone');const address = document.getElementById('address');
                if (editdata == false) {
                    axios.post("<?php echo env('APP_URL'); ?>:8000/hotspot/guest/user",{'name' : name.value,'email' : email.value,'username' : username.value,'password' : password.value,'phone' : phone.value,'address' : address.value,},{headers: {'Content-Type': 'multipart/form-data'}})
                    .then((response) => {const data = response.data;if (data['error']) {const pesan = data['msg'];let pesan_error;if ('name' in pesan) {pesan_error = pesan.name[0]+"\n";}if ('email' in pesan) {pesan_error = pesan_error+pesan.email[0]+"\n";} if ('username' in pesan) {pesan_error = pesan_error+pesan.username[0]+"\n";}if ('password' in pesan) {pesan_error = pesan_error+pesan.password[0]+"\n";} swal({title: 'Validation data',text: pesan_error,icon: 'error',button: true,});} else {modal.classList.add('hidden');let sisa = data_table % per_page;if (sisa == 0) {if (last_page >= 1){last_page = last_page + 1;}location.replace(url_base+"?page="+last_page);} else {location.replace(url_base+"?page="+last_page);}}})
                    .catch(err => {
                        console.log('Oh noooo!!');
                        console.log(err.response.data);
                    });
                } else {
                    axios.patch(`<?php echo env('APP_URL'); ?>:8000/hotspot/guest/user/${iduser}`,{'name' : name.value,'email' : email.value,'username' : username.value,'password' : password.value,'phone' : phone.value,'address' : address.value,})
                        .then((response) => {const data = response.data;if (data['error']) {const pesan = data['msg'];let pesan_error;if ('email' in pesan) {pesan_error = pesan_error+pesan.email.email[0]+"\n";}if ('username' in pesan) {pesan_error = pesan_error+pesan.username.username[0]+"\n";}swal({title: 'Validation data',text: pesan_error,icon: 'error',button: true,});} else {modal.classList.add('hidden');location.reload();}})
                        .catch(err => {console.log('Oh noooo!!');console.log(err.response.data);})
                }
            });

            closeModalBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            closeFooterBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            // Close modal when clicking outside of it
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                modal.classList.add('hidden');
                }
            });
        </script>
        <!-- end Modal input/update user -->
        <!-- Modal profile -->
        <div id="userProfileModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white w-full max-w-4xl rounded-lg shadow-lg">
                <!-- Modal Header -->
                <div class="flex justify-between items-center px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800" id="userProfileInfo"></h2>
                <button
                    id="userProfilecloseModalBtn"
                    class="text-gray-600 hover:text-gray-800 focus:outline-none"
                >
                    ✖
                </button>
                </div>
                <!-- Modal Body -->
                <div class="relative p-6 flex-auto">
                                    <form>
                                    <div class="flex flex-wrap -mx-3 mb-4">
                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="userProfileGroup">
                                                        User Profile
                                                    </label>
                                                    <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="userProfileGroup" type="checkbox">
                                                    @if (!$data['error'])
                                                    @foreach($data['userprofile'] as $userprof)
                                                    <option value="{{$userprof['name']}}">{{$userprof['name']}}</option>
                                                    @endforeach
                                                    @endif
                                                    </select>
                                                </div>
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="userProfileLimitRate">
                                                        Limit Rate (1024K/1024K)
                                                    </label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="userProfileLimitRate" type="text" placeholder="1024K/1024K 2M/2M 1024K/1024K 40/40">
                                                </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-4">
                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="userProfileTimeLimit">
                                                    Time Limit (Minutes)
                                                </label>
                                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="userProfileTimeLimit" type="number" placeholder="60">
                                                </div>
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="userProfileExpire">
                                                        Expire User
                                                    </label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="userProfileExpire" type="datetime-local">
                                                </div>
                                    </div>
                                    </form>

                </div>
                <!-- Modal Footer -->
                <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b space-x-2">
                <button
                    id="userProfilecloseFooterBtn"
                    class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                >
                    Close
                </button>
                <button id="userProfilesaveFooterBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                Save
                </button>
                </div>
            </div>
        </div>
        <script>
            const userprofilemodal = document.getElementById('userProfileModal');
            const userprofilesavefooterbtn = document.getElementById('userProfilesaveFooterBtn');
            const userprofileclosefooterbtn = document.getElementById('userProfilecloseFooterBtn');
            const userProfileInfo = document.getElementById('userProfileInfo');
            const userProfileGroup = document.getElementById('userProfileGroup');
            const userProfileLimitRate = document.getElementById('userProfileLimitRate');
            const userProfileTimeLimit = document.getElementById('userProfileTimeLimit');
            const userProfileExpire = document.getElementById('userProfileExpire');
            function openUserProfileModal(id) {
                axios
                .get(
                    "<?php echo env('APP_URL'); ?>:8000/hotspot/user/"+id
                )
                .then((response) => {
                    userProfileInfo.innerHTML = `User Profile ${response.data.name}`;
                    userProfileGroup.value = response.data.user_profile;
                    userProfileLimitRate.value = response.data.rate_limit;
                    userProfileTimeLimit.value = response.data.time_limit;
                    userProfileExpire.value = response.data.expire;
                })
                
                userprofilemodal.classList.remove('hidden');
            }

            userprofileclosefooterbtn.addEventListener('click', () => {
                userprofilemodal.classList.add('hidden');
            });

            userProfilesaveFooterBtn.addEventListener('click',() =>{
            axios
                .patch("<?php echo env('APP_URL'); ?>:8000/hotspot/user/profile/"+id,{
                    'user_profile' : userProfileGroup.value,
                    'rate_limit'   : userProfileLimitRate.value,
                    'time_limit'   : userProfileTimeLimit.value,
                    'expire'       : userProfileExpire.value
                })
                .then(

                )
            })
        </script>

        <!-- End Modal profile -->

    @endsection
