@php
$user = Auth::user();
$isProfileIncomplete = empty($user->email) || empty($user->tahun_masuk) || empty($user->department_id) || empty($user->ttd);
@endphp

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full flex-shrink-0 sm:translate-x-0 bg-gray-50" aria-label="Sidebar">
   <div class="h-full flex flex-col justify-between px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="fa-solid fa-home"></i>
               <span class="ms-3">Dashboard</span>
            </a>
         </li>
         <li>
            <a href="{{route('profile')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="fa-solid fa-user"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Profile</span>
            </a>
         </li>
         @if (!$isProfileIncomplete)
         <li>
            <a href="{{ route('permintaan') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="fa-solid fa-pencil"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Create</span>
            </a>
         </li>
         <li>
            <a href="{{ route('ongoing') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="fa-solid fa-file-contract"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">On Going</span>
            </a>
         </li>
         <li>
            <a href="{{ route('history') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="fa-solid fa-clock-rotate-left"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">History</span>
            </a>
         </li>
         <li>
            <button type="button" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700" aria-controls="dropdown-bap" data-collapse-toggle="dropdown-bap">
               <i class="fa-solid fa-file"></i>
               <span class="flex-1 ml-3 text-left whitespace-nowrap">Berita Acara Pengakuan</span>
               <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
               </svg>
            </button>
            <!-- Dropdown Menu -->
            <ul id="dropdown-bap" class="hidden py-2 space-y-2">
               <li>
                  <a href="{{route('form.bap')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                     <i class="fa-solid fa-pencil"></i>
                     <span class="ml-3">Create</span>
                  </a>
               </li>
               <li>
                  <a href="{{route('ongoing.bap')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                     <i class="fa-solid fa-file-contract"></i>
                     <span class="ml-3">Ongoing</span>
                  </a>
               </li>
               <li>
                  <a href="{{route('admin.companies')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                     <i class="fa-solid fa-clock-rotate-left"></i>
                     <span class="ml-3">History</span>
                  </a>
               </li>
            </ul>
         </li>
         <li>
            @if (Auth::user()->role == 'admin')
            <button type="button" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700" aria-controls="dropdown-admin" data-collapse-toggle="dropdown-admin">
               <i class="fa-solid fa-user-secret"></i>
               <span class="flex-1 ml-3 text-left whitespace-nowrap">Admin</span>
               <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
               </svg>
            </button>
            <!-- Dropdown Menu -->
            <ul id="dropdown-admin" class="hidden py-2 space-y-2">
               <li>
                  <a href="{{route('admin.users')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                     <i class="fa-solid fa-users"></i> <!-- Icon for Users -->
                     <span class="ml-3">Users</span>
                  </a>
               </li>
               <li>
                  <a href="{{route('admin.departments')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                     <i class="fa-solid fa-building"></i> <!-- Icon for Department -->
                     <span class="ml-3">Departments</span>
                  </a>
               </li>
               <li>
                  <a href="{{route('admin.companies')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                     <i class="fa-solid fa-city"></i> <!-- Icon for Company -->
                     <span class="ml-3">Companies</span>
                  </a>
               </li>
               <li>
                  <a href="{{route('admin.brands')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                     <i class="fa-solid fa-copyright"></i>
                     <span class="ml-3">Brand</span>
                  </a>
               </li>
               <li>
                  <a href="{{route('admin.types')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                     <i class="fa-solid fa-bars"></i>
                     <span class="ml-3">Type</span>
                  </a>
               </li>
               <li>
                  <a href="{{route('admin.os')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                     <i class="fa-brands fa-windows"></i>
                     <span class="ml-3">Operating System</span>
                  </a>
               </li>
               <li>
                  <a href="{{route('admin.office')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                     <i class="fa-brands fa-microsoft"></i>
                     <span class="ml-3">Microsoft Office</span>
                  </a>
               </li>
            </ul>
            @endif
         </li>
      </ul>
      @endif
      </ul>
      <ul class="font-medium space-y-2">
         <li>
            <form action="{{route('logout')}}" method="post">
               @csrf
               <button type="submit" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <i class="fa-solid fa-sign-out-alt"></i>
                  <span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
               </button>
            </form>
         </li>
      </ul>
   </div>
</aside>