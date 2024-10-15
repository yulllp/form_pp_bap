<x-layout>
  @section('title', 'Dashboard')
  <x-slot:title>{{ $title }}</x-slot:title>
  <section class="bg-white dark:bg-gray-900 w-full relative px-4 py-4 sm:px-6">
    @if($isProfileIncomplete)
    <div id="alert-border-2" class="flex w-full items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
      <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
      </svg>
      <div class="ms-3 text-sm font-medium">
        Mohon lengkapi data diri anda terlebih dahulu di halaman profile.
      </div>
    </div>
    @endif

    <div class="container mx-auto mt-4 p-6">
      <div class="flex justify-between items-center mb-4">
        <div id="welcome-message" class="text-2xl font-bold dark:text-white">Welcome, </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 animate-fade-in">
        <div class="card bg-blue-100 dark:bg-blue-900 shadow-md rounded-lg overflow-hidden transition duration-300 h-64 flex flex-col">
          <div class="card-header bg-blue-200 dark:bg-blue-800 p-4">
            <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Permintaan Pembelian Yang Sudah Terbuat</h5>
          </div>
          <div class="card-body p-4 flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-2xl text-gray-800 dark:text-gray-200">{{ $pp }}</h3>
              <p class="text-gray-600 dark:text-gray-400 mt-2">Klik dibawah untuk membuat Permintaan Pembelian:</p>
            </div>
            <a href="{{ route('permintaan') }}" class="mt-4 inline-block bg-blue-500 text-white w-full text-center px-4 py-2 rounded hover:bg-blue-600 transition">Get Started</a>
          </div>
        </div>

        <div class="card bg-green-100 dark:bg-green-900 shadow-md rounded-lg overflow-hidden transition duration-300 h-64 flex flex-col">
          <div class="card-header bg-green-200 dark:bg-green-800 p-4">
            <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Berita Acara Pengakuan Yang Sudah Terbuat</h5>
          </div>
          <div class="card-body p-4 flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-2xl text-gray-800 dark:text-gray-200">{{ $bap }}</h3>
              <p class="text-gray-600 dark:text-gray-400 mt-2">Klik dibawah untuk membuat Berita Acara Pengakuan:</p>
            </div>
            <a href="{{ route('form.bap') }}" class="mt-4 inline-block bg-green-500 text-white w-full text-center px-4 py-2 rounded hover:bg-green-600 transition">Get Started</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const name = "{{ Auth::user()->name }}";
      const welcomeElement = document.getElementById("welcome-message");
      let index = 0;

      function displayNextCharacter() {
        if (index < name.length) {
          welcomeElement.innerHTML += name[index];
          index++;
          setTimeout(displayNextCharacter, 300); // Adjust the timing as needed
        } else {
          welcomeElement.innerHTML = "Welcome, " + name;
        }
      }

      displayNextCharacter();
    });
  </script>

  <style>
    .card {
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .animate-fade-in {
      animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</x-layout>