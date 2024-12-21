@extends('layout.app')
    @section('content')
    <div class="max-w-[720px] mx-auto">
    <div class="ml-3">
            <div class="w-full max-w-sm min-w-[200px] relative">
            <div class="relative">
                <form action="/hotspot/users" method="GET">
                <input name="search"
                class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                placeholder="Search for username..."
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
    <div class="flex flex-col items-center justify-center px-3 py-8 mx-auto lg:py-0 mt-1">
        <div class="relative overflow-x-auto  sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Groupname
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Attribute
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Value
                        </th><th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=$users->firstItem(); ?>
                    @foreach ($users as $user)
                       <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{$i++}}
                        </th>
                        <td class="px-6 py-4">
                            {{$user->username}}
                        </td>
                        <td class="px-6 py-4">
                            <?php if ($user->groupname) { echo $user->groupname; } else echo "N/A"; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php if ($user->attribute) { echo $user->attribute; } else echo "N/A"; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php if ($user->value) { echo $user->value; } else echo "N/A"; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
                            <a href="#" class="font-medium text-blue-600 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                </svg>
                            </a>
                            <a href="#" class="font-medium text-blue-600 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            </div>
                        </td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="w-full text-sm text-left rtl:text-right text-gray-500">
            {{$users->withQueryString()->links()}}
            </div>
        </div>
    </div>
    </div>
    @endsection
    