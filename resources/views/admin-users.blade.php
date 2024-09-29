<x-layout>
    @section('title', 'Admin-Users')
    <x-slot:title>{{$title}} </x-slot:title>
    <section class="bg-white dark:bg-gray-900 w-full relative px-4 py-4 sm:px-6">
        @if ($errors->any())
        <div id="error-alert" class="relative flex w-full items-center p-4 mb-4 text-red-800 border border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
            <!-- Progress line (border) at the top -->
            <div id="error-progress-bar" class="absolute top-0 left-0 h-1 bg-red-500" style="width: 100%; transition: width 5s linear;"></div>

            <!-- Icon -->
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>

            <!-- Alert message -->
            <div class="ms-3 text-sm font-medium">
                Please fix the following errors:
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Close button in the top-right corner -->
            <button type="button" id="close-error-alert" class="absolute top-2 right-2 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        @endif

        @if(session('success'))
        <div id="success-alert" class="hidden relative flex w-full items-center p-4 mb-4 text-green-800 border border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
            <!-- Progress line (border) at the top -->
            <div id="progress-bar" class="absolute top-0 left-0 h-1 bg-green-500" style="width: 100%; transition: width 5s linear;"></div>

            <!-- Icon -->
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>

            <!-- Alert message -->
            <div class="ms-3 text-sm font-medium">
                Data berhasil ditambahkan.
            </div>

            <!-- Close button in the top-right corner -->
            <button type="button" id="close-alert" class="absolute top-2 right-2 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        @endif

        @if(session('successdel'))
        <div id="success-alert" class="hidden relative flex w-full items-center p-4 mb-4 text-green-800 border border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
            <!-- Progress line (border) at the top -->
            <div id="progress-bar" class="absolute top-0 left-0 h-1 bg-green-500" style="width: 100%; transition: width 5s linear;"></div>

            <!-- Icon -->
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>

            <!-- Alert message -->
            <div class="ms-3 text-sm font-medium">
                Data berhasil dihapus.
            </div>

            <!-- Close button in the top-right corner -->
            <button type="button" id="close-alert" class="absolute top-2 right-2 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        @endif

        @if(session('status'))
        <div id="success-alert" class="hidden relative flex w-full items-center p-4 mb-4 text-green-800 border border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
            <!-- Progress line (border) at the top -->
            <div id="progress-bar" class="absolute top-0 left-0 h-1 bg-green-500" style="width: 100%; transition: width 5s linear;"></div>

            <!-- Icon -->
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>

            <!-- Alert message -->
            <div class="ms-3 text-sm font-medium">
                Data berhasil diupdate.
            </div>

            <!-- Close button in the top-right corner -->
            <button type="button" id="close-alert" class="absolute top-2 right-2 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        @endif
        <div class="flex justify-end mb-4">
            <button type="button" data-modal-target="add-user-modal" data-modal-toggle="add-user-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Add User
            </button>
        </div>
        <div class="overflow-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jabatan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Department
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tahun Masuk
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanda Tangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                @foreach ($users as $user)
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                        </td>
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->username }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->email ?? '-'}}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->jabatan ?? '-'}}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->department->nama ?? '-' }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @php
                            $tahunMasuk = $user->tahun_masuk ?? null;
                            $formattedDate = $tahunMasuk ? (new DateTime($tahunMasuk))->format('F Y') : '-';
                            @endphp
                            {{ $formattedDate ?? '-'}}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($user->ttd)
                            <span class="text-green-500"><i class="fa-solid fa-check"></i></span>
                            @else
                            <span class="text-red-500"><i class="fa-solid fa-times"></i></span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($user->status == 'active')
                            <p class="text-green-500"> {{$user->status}} </p>
                            @else
                            <p class="text-red-500"> {{$user->status}} </p>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($user->role == 'admin')
                            <p> {{$user->role}} </p>
                            @else
                            <p> {{$user->role}} </p>
                            @endif
                        </td>
                        <td class="px-6 py-4 flex space-x-3">
                            <button id="edit-button" data-modal-target="edit-user-modal" data-modal-toggle="edit-user-modal" data-original-icon class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-username="{{ $user->username }}" data-user-email="{{ $user->email }}" data-user-jabatan="{{ $user->jabatan }}" data-user-department="{{ $user->department ? $user->department->id : '' }}" data-user-tahun-masuk="{{ $user->tahun_masuk }}" data-user-status="{{ $user->status }}" data-user-role="{{$user->role}}">
                                Edit
                            </button>
                            <button
                                data-modal-target="deleteModal" data-modal-toggle="deleteModal"
                                data-delete-id="{{ $user->id }}"
                                data-original-icon class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        <!-- Add Modal Structure -->
        <div id="add-user-modal" tabindex="-1" class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full mx-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700"> <!-- Using dark:bg-gray-700 -->
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Add User
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-user-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-7 md:p-10">
                        <form action="{{route('store.user')}}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="username" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Username</label>
                                <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="role" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Role</label>
                                <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                    <option value="user" selected>User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div id="edit-user-modal" tabindex="-1" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 overflow-y-auto">
            <div class="relative w-full max-w-3xl max-h-[90vh] bg-white rounded-lg shadow dark:bg-gray-700 overflow-y-auto">
                <!-- Modal Content -->
                <div class="relative h-full flex flex-col">
                    <!-- Modal Header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Edit User
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white" data-modal-toggle="edit-user-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-content p-6 space-y-6 border-s border-gray-200 dark:border-gray-900 flex-1 overflow-y-auto">
                        <!-- Edit User Form -->
                        <form id="editUserForm" action="{{ route('update.user', ':id') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="edit-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="username" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Username</label>
                                <input type="text" name="username" id="edit-username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <input type="email" name="email" id="edit-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div class="mb-4">
                                <label for="jabatan" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Jabatan</label>
                                <input type="text" name="jabatan" id="edit-jabatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                                <input type="password" name="password" id="edit-password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div class="mb-4">
                                <label for="department" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Department</label>
                                <select name="department_id" id="edit-department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option value="">
                                        Select Department
                                    </option>
                                    @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="tahun_masuk" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Tahun Masuk</label>
                                <input type="month" name="tahun_masuk" id="edit-tahun_masuk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div class="mb-4">
                                <label for="ttd" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Tanda Tangan</label>
                                <input type="file" name="ttd" id="edit-ttd" accept=".png" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Status</label>
                                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option id="status-active" value="active">Active</option>
                                    <option id="status-inactive" value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="role" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Role</label>
                                <select name="role" id="edit-role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option id="role-user" value="user">User</option>
                                    <option id="role-admin" value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete User Modal -->
        <div id="deleteModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Close button -->
                    <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>

                    <!-- Warning icon -->
                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>

                    <!-- Modal text -->
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this user?</p>

                    <!-- Buttons -->
                    <div class="flex justify-center items-center space-x-4">
                        <button data-modal-toggle="deleteModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, cancel
                        </button>
                        <form id="delete-form" action="#" method="POST" class="m-0 p-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900 m-0 p-0">
                                Yes, I'm sure
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="p-4">
            {{ $users->links() }}
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // handle edit modal
            document.querySelectorAll('[data-user-id]').forEach(button => {
                button.addEventListener('click', function() {
                    console.log(this.getAttribute('data-user-id'));
                    const id = this.getAttribute('data-user-id');
                    const name = this.getAttribute('data-user-name');
                    const username = this.getAttribute('data-user-username');
                    const role = this.getAttribute('data-user-role');
                    const status = this.getAttribute('data-user-status');
                    const jabatan = this.getAttribute('data-user-jabatan');
                    const department = this.getAttribute('data-user-department');
                    const tahun_masuk = this.getAttribute('data-user-tahun-masuk');
                    const email = this.getAttribute('data-user-email');

                    console.log('User ID:', id);
                    console.log('Name:', name);
                    console.log('Username:', username);
                    console.log('Email:', email);
                    console.log('Role:', role);
                    console.log('Tahun Masuk:', tahun_masuk);


                    // Populate the update modal with user data
                    const updateForm = document.getElementById('editUserForm');
                    if (updateForm) {
                        // Set the action URL for form submission
                        const url = "{{ route('update.user', ':id') }}".replace(':id', id);
                        updateForm.action = url;

                        // Populate form fields
                        document.getElementById('edit-name').value = name;
                        document.getElementById('edit-username').value = username;
                        document.getElementById('edit-jabatan').value = jabatan;
                        document.getElementById('edit-email').value = email


                        // Fill department select
                        const departmentSelect = document.getElementById('edit-department');
                        if (departmentSelect) {
                            Array.from(departmentSelect.options).forEach(option => {
                                option.selected = option.value === department;
                            });
                        }

                        // Fill tahun_masuk
                        document.getElementById('edit-tahun_masuk').value = null;

                        document.getElementById('edit-ttd').value = "";

                        // Fill status select
                        const statusSelect = document.getElementById('status');
                        if (statusSelect) {
                            Array.from(statusSelect.options).forEach(option => {
                                option.selected = option.value === status;
                            });
                        }

                        // Fill role select (if applicable)
                        const roleSelect = document.getElementById('edit-role');
                        if (roleSelect) {
                            Array.from(roleSelect.options).forEach(option => {
                                option.selected = option.value === role;
                            });
                        }
                    }

                    // Show the modal
                    const updateModal = document.getElementById('edit-user-modal');
                    if (updateModal) {
                        updateModal.classList.remove('hidden'); // Remove hidden class to show modal
                    }
                });
            });

            document.querySelectorAll('[data-delete-id]').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-delete-id');
                    console.log(id);
                    const deleteForm = document.getElementById('delete-form');
                    if (deleteForm) {
                        deleteForm.action = "{{ route('destroy.user', ':id') }}".replace(':id', id);
                    }
                });
            });

            // For the error alert
            const errorAlertBox = document.getElementById('error-alert');
            const errorCloseButton = document.getElementById('close-error-alert');
            const errorProgressBar = document.getElementById('error-progress-bar');

            if (errorAlertBox) {
                errorProgressBar.style.transition = 'none';
                errorProgressBar.style.width = '100%'; // Start full

                setTimeout(() => {
                    errorProgressBar.style.transition = 'width 5s linear';
                    errorProgressBar.style.width = '0'; // Shrink to 0 over 5 seconds

                    // Hide the alert after the progress bar animation completes
                    setTimeout(() => {
                        errorAlertBox.classList.add('hidden');
                    }, 5000); // Matches the duration of the animation (5s)
                }, 100); // Small delay to make sure DOM is ready for transition
            }

            // Close the error alert manually when the close button is clicked
            if (errorCloseButton) {
                errorCloseButton.addEventListener('click', function() {
                    errorAlertBox.classList.add('hidden');
                });
            }

            const alertBox = document.getElementById('success-alert');
            const closeButton = document.getElementById('close-alert');
            const progressBar = document.getElementById('progress-bar');

            function showAlert() {
                alertBox.classList.remove('hidden');
                progressBar.style.transition = 'none'; // Disable transition to reset
                progressBar.style.width = '100%'; // Start full

                // Delay to let the browser process width change, then start animation
                setTimeout(() => {
                    progressBar.style.transition = 'width 5s linear'; // Enable transition
                    progressBar.style.width = '0'; // Shrink to 0 over 5 seconds
                }, 100); // Short delay to allow DOM update

                // Automatically hide the alert after 5 seconds
                setTimeout(() => {
                    alertBox.classList.add('hidden');
                }, 5100); // Delay slightly longer than the transition
            }

            // Close the alert when the close button is clicked
            closeButton.addEventListener('click', () => {
                alertBox.classList.add('hidden');
            });

            showAlert();



        });
    </script>
</x-layout>