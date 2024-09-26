<x-layout>
  @section('title', 'Permintaan Pembelian')
  <x-slot:title>{{$title}} </x-slot:title>

  @php
  $startDate = Auth::user()->tahun_masuk;
  $now = new DateTime();

  $interval = $startDate->diff($now);
  $years = $interval->y;
  $months = $interval->m;
  $lamaBekerja = "{$years} tahun dan {$months} bulan";
  @endphp

  <section class="bg-white dark:bg-gray-900 w-full px-4 py-4 sm:px-6 lg:px-32">
    @if (session('success'))
    <div id="alert" class="relative flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 transition-opacity duration-500 ease-in-out opacity-100" role="alert">
      <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
      </svg>
      <span class="sr-only">Info</span>
      <div>
        <span class="font-medium">Permintaan pembelian berhasi dibuat!</span> Silahkan cek pada menu On Going.
      </div>
    </div>
    @endif

    <form action="{{ route("permintaan.store")}}" method="post">
      @csrf
      <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
          <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " disabled>Nama Pengguna</label>
          <input type="text" id="name" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed" disabled value="{{ Auth::user()->name }}" />
        </div>
        <div>
          <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
          <input type="text" id="jabatan" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed" disabled value="{{ Auth::user()->jabatan }}" />
        </div>
        <div>
          <label for="lama_bekerja" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lama bekerja</label>
          <input type="text" id="lama_bekerja" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed" disabled value="{{ $lamaBekerja }}" />
        </div>
        <div>
          <label for="pt_tujuan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pembelian untuk PT</label>
          <select id="pt_tujuan_id" name="pt_tujuan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <option value="" selected disabled>Pilih PT</option>
            @foreach ($pts as $pt)
            <option value="{{ $pt->id }}">{{ $pt->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="mb-6">
        <label for="alasan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alasan permintaan</label>
        <textarea id="alasan" rows="4" name="alasan" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan alasan" required></textarea>
      </div>
      <div class="flex justify-end">
        <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      </div>

      <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
              <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah data yang diisi sudah benar?</h3>
              <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
              <button data-modal-hide="popup-modal" type="submit" class="ms-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                Yes, I'm sure
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
</x-layout>

<script>
  // Set timeout for 5 seconds to fade out the alert
  setTimeout(() => {
    const alertElement = document.getElementById('alert');
    if (alertElement) {
      alertElement.classList.add('opacity-0');
      
      // Remove the alert after the transition (500ms)
      setTimeout(() => {
        alertElement.remove();
      }, 500); // Duration matches the CSS transition
    }
  }, 5000); // 5 seconds delay
</script>