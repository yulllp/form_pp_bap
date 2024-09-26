<x-layout>
  @section('title', 'On Going')
  <x-slot:title>{{$title}} </x-slot:title>
  <section class="bg-white dark:bg-gray-900 w-full relative px-4 py-4 sm:px-6">
    <div class="overflow-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">
              No
            </th>
            <th scope="col" class="px-6 py-3">
              No PPI
            </th>
            <th scope="col" class="px-6 py-3">
              Pembelian untuk PT
            </th>
            <th scope="col" class="px-6 py-3">
              Alasan permintaan
            </th>
            <th scope="col" class="px-6 py-3">
              Status
            </th>
          </tr>
        </thead>
        @foreach ($datas as $data)
        <tbody>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $loop->index + 1 }}
            </td>
            <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $data->nomor }}
            </th>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $data->pt_tujuan->name }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $data->alasan }}
            </td>
            <td class="px-6 py-4">
              <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Check Status</a>
            </td>
          </tr>
        </tbody>
        @endforeach
      </table>
    </div>
  </section>
</x-layout>