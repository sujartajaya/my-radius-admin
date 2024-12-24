@extends('layout.app')
    @section('content')
    <div class="max-w w-full">
        <div class="flex flex-col items-center justify-center px-3 py-8 mx-auto lg:py-0 mt-1">
            <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">User Management</h2>
                <div class="flex flex-col px-3 py-8 mx-auto lg:py-0 mt-1 items-center justify-center">
                        <div class="w-full max-w-sm min-w-[200px] relative">
                        <div class="relative">
                            <form action="/hotspot/users" method="GET">
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
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Department</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">1</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">John Doe</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">johndoe@example.com</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">john</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">Housekeeping</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">
                        <div class="flex space-x-2">
                            <button
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400"
                            >
                            Edit
                            </button>
                            <button
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400"
                            >
                            Delete
                            </button>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">2</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">Jane Smith</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">janesmith@example.com</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">Jane</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">IT</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">
                        <div class="flex space-x-2">
                            <button
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400"
                            >
                            Edit
                            </button>
                            <button
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400"
                            >
                            Delete
                            </button>
                        </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
  <div
    id="largeModal"
    class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden"
  >
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
                            <div class="flex flex-wrap -mx-3 mb-4">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                            Name
                                        </label>
                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" type="text" placeholder="Your name" autofocus>
                                        </div>
                                        <div class="w-full md:w-1/2 px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                                                Email
                                            </label>
                                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" placeholder="yorname@example.com">
                                        </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-4">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="username">
                                            Username
                                        </label>
                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="username" type="text" placeholder="Username">
                                        </div>
                                        <div class="w-full md:w-1/2 px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                                                Password
                                            </label>
                                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="password" type="password" placeholder="******************">
                                        </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-4">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="department">
                                            Department
                                        </label>
                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="department" type="text" placeholder="Department">
                                        </div>
                                        <div class="w-full md:w-1/2 px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                                Phone
                                            </label>
                                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="phone" type="phone">
                                        </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-4">
                                <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
                                    Adress
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="address" type="text" placeholder="Address">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-4">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="time_limit">
                                            Time Limit
                                        </label>
                                        <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="time_limit" type="checkbox">
                                            <option value="false">False</option>
                                            <option value="true" selected>True</option>
                                        </select>
                                        </div>
                                        <div class="w-full md:w-1/2 px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="time_over">
                                                Time Over (minutes)
                                            </label>
                                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="time_over" type="number" value="60">
                                        </div>
                            </div>
                            

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
  <script>
    // JavaScript to handle modal visibility
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const closeFooterBtn = document.getElementById('closeFooterBtn');
    const modal = document.getElementById('largeModal');
    const saveFooterBtn = document.getElementById('saveFooterBtn');

    openModalBtn.addEventListener('click', () => {
      modal.classList.remove('hidden');
    });

    saveFooterBtn.addEventListener('click', () => {

        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const username = document.getElementById('username');
        const password = document.getElementById('password');
        const department = document.getElementById('department');
        const phone = document.getElementById('phone');
        const address = document.getElementById('address');
        const time_limit = document.getElementById('time_limit');
        const time_over = document.getElementById('time_over');

        alert("Klikc "+name.value);

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
    @endsection

