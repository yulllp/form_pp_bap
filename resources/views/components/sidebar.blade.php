@php
use App\Models\Department;

$user = Auth::user();
$isProfileIncomplete = empty($user->email) || empty($user->tahun_masuk) || empty($user->department_id) || empty($user->ttd);
$leaders = Department::all()->pluck('pemimpin_id')->toArray();
if (!$leaders) {
$leaders = [];
}
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
            <button type="button" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700" aria-controls="dropdown-pp" data-collapse-toggle="dropdown-pp">
               <i class="fa-solid fa-file-lines"></i>
               <span class="flex-1 ml-3 text-left whitespace-nowrap">PP Internal</span>
               <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
               </svg>
            </button>
            <ul id="dropdown-pp" class="hidden py-2 space-y-2">
               @if(Auth::user()->department->nama == 'IT' || (Auth::user()->department->nama == 'IT' && in_array(Auth::id(), $leaders)) || (Auth::user()->department->nama != 'IT' && !(in_array(Auth::id(), $leaders))))
               <li>
                  <a href="{{ route('permintaan') }}" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                     <i class="fa-solid fa-pencil"></i>
                     <span class="flex-1 ms-3 whitespace-nowrap">Create</span>
                  </a>
               </li>
               @endif
               <li>
                  <a href="{{ route('ongoing') }}" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                     <i class="fa-solid fa-file-contract"></i>
                     <span class="flex-1 ms-3 whitespace-nowrap">On Going</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('history') }}" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                     <i class="fa-solid fa-clock-rotate-left"></i>
                     <span class="flex-1 ms-3 whitespace-nowrap">History</span>
                  </a>
               </li>
            </ul>
         </li>
         <li>
            <button type="button" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700" aria-controls="dropdown-bap" data-collapse-toggle="dropdown-bap">
               <i class="fa-solid fa-file"></i>
               <span class="flex-1 ml-3 text-left whitespace-nowrap">B. A. Serah Terima</span>
               <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
               </svg>
            </button>
            <!-- Dropdown Menu -->
            <ul id="dropdown-bap" class="hidden py-2 space-y-2">
               <li>
                  @if (Auth::user()->department->nama === 'IT')
                  <a href="{{route('form.bap')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                     <i class="fa-solid fa-pencil"></i>
                     <span class="ml-3">Create</span>
                  </a>
                  @endif
               </li>
               <li>
                  <a href="{{route('ongoing.bap')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                     <i class="fa-solid fa-file-contract"></i>
                     <span class="ml-3">Ongoing</span>
                  </a>
               </li>
               <li>
                  <a href="{{route('history.bap')}}" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
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
         @endif
         <li>
            <button type="button" class="flex items-center p-2 w-full text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group" data-modal-target="log-out-modal" data-modal-toggle="log-out-modal">
               <i class="fa-solid fa-sign-out-alt"></i>
               <span class="flex-1 text-left ms-3 whitespace-nowrap">Log Out</span>
            </button>
         </li>
      </ul>
      
   </div>
</aside>

<div id="log-out-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
   <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
         <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
         </button>
         <div class="p-4 md:p-5 text-center">
            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <h3 id="modalMessage" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin untuk Log Out?</h3>
            <div class="flex space-x-2 justify-center">
               <button data-modal-hide="log-out-modal" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
               <form action="{{route('logout')}}" method="post" class="m-0 p-0">
                  @csrf
                  <button data-modal-hide="log-out-modal" type="submit" class="ms-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                     Yes, I'm sure
                  </button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>