@php
$user = Auth::user();
$isProfileIncomplete = empty($user->email) || empty($user->tahun_masuk) || empty($user->department_id);
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
         <!-- Show these options only if the profile is complete -->
         <li>
            <a href="{{ route('permintaan') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="fa-solid fa-pencil"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Create</span>
            </a>
         </li>
         <li>
            <a href="{{ route(name: 'ongoing') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="fa-solid fa-file-contract"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">On Going</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="fa-solid fa-clock-rotate-left"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">History</span>
            </a>
         </li>
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