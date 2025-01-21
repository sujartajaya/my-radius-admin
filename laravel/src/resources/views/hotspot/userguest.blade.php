@extends('layout.app')
    @section('content')
    <div class="max-w w-full">
            <div class="flex flex-col items-center justify-center px-3 py-8 mx-auto lg:py-0 mt-1">
                <div class="w-full max-w-6xl bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Email User Lists</h2>
                    <div class="flex flex-col px-3 py-8 mx-auto lg:py-0 mt-1 items-center justify-center">
                            <div class="w-full max-w-sm min-w-[200px] relative">
                            <div class="relative">
                                <form action="/hotspot/email/users" method="GET">
                                <input name="search" id="searchBox"
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
                    </div>
                    <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200" id="data-table">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">#</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Email</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i=$emailusers->firstItem(); $dt = 0; ?>
                            @foreach ($emailusers as $email)
                                <tr>
                                    <?php $dt=$dt+1; ?>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $i++ }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $email->username }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">
                                        <div class="flex space-x-2">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="w-full text-sm text-left rtl:text-right text-gray-500 mt-2">
                        {{$emailusers->withQueryString()->links('pagination::tailwind')}}
                    </div>
                    </div>
                </div>
            </div>
    </div>
    @endsection
