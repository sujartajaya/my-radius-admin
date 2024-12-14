@extends('layout.app')
    @section('content')
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0 mt-10">
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
                            <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                        </td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="w-full text-sm text-left rtl:text-right text-gray-500">
            {{$users->links()}}
            </div>
        </div>
            
    </div>
    @endsection
    