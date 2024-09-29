<x-layout>
  @section('title', 'Permintaan Pembelian')
  <x-slot:title>{{$title}} </x-slot:title>

  @php
  $startDate = $data->user->tahun_masuk;
  $now = new DateTime();

  $interval = $startDate->diff($now);
  $years = $interval->y;
  $months = $interval->m;
  $lamaBekerja = "{$years} tahun dan {$months} bulan";
  @endphp

  <section class="bg-white dark:bg-gray-900 w-full px-4 py-4 sm:px-6">
    <div class="xl:px-20">
      @if (session('success'))
      <div id="alert" class="relative flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 transition-opacity duration-500 ease-in-out opacity-100" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">{{ session('success') }}</span>
        </div>
      </div>
      @endif
      <div class="grid gap-6 mb-6 md:grid-cols-2 lg:grid-cols-3">
        <input type="hidden" id="barangData" value="{{json_encode($barangData)}}">
        <div>
          <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " disabled>Nama Pengguna</label>
          <input type="text" id="name" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed" disabled value="{{ $data->user->name }}" />
        </div>
        <div>
          <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
          <input type="text" id="jabatan" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed" disabled value="{{ $data->user->jabatan }}" />
        </div>
        <div>
          <label for="lama_bekerja" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lama bekerja</label>
          <input type="text" id="lama_bekerja" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed" disabled value="{{ $lamaBekerja }}" />
        </div>
        <div>
          <label for="pt_tujuan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pembelian untuk PT</label>
          <select id="pt_tujuan_id" name="pt_tujuan_id" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed" disabled required>
            @foreach($pts as $pt)
            <option value="{{ $pt->id }}" {{ $pt->name == $data->pt_tujuan->name ? 'selected' : '' }}>
              {{ $pt->name }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="md:col-span-2">
          <label for="alasan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alasan permintaan</label>
          <textarea id="alasan" rows="4" name="alasan" class="cursor-not-allowed block p-2.5 w-full text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan alasan" disabled required>{{ $data->alasan }}</textarea>
        </div>
      </div>

      <div>
        <h1 class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Keterangan Barang</h1>
      </div>

      <div class="grid gap-6 mb-10 md:grid-cols-2 lg:grid-cols-9">
        <div class="col-span-2">
          <label for="spec" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama spesifikasi</label>
          <input type="text" id="spec" name="spec" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama" />
        </div>
        <div>
          <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " disabled>Jumlah</label>
          <input type="number" id="jumlah" name="jumlah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jumlah" />
        </div>
        <div>
          <label for="satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " disabled>Satuan</label>
          <input type="text" id="satuan" name="satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Satuan" />
        </div>
        <div class="col-span-2">
          <label for="datepicker-autohide" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " disabled>Tanggal diperlukan</label>
          <div class="relative sm:w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
              </svg>
            </div>
            <input id="datepicker-autohide" name="tanggal" datepicker-format="dd-mm-yyyy" datepicker datepicker-orientation="top" datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
          </div>
        </div>
        <div class="col-span-2">
          <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " disabled>Keterangan IT</label>
          <input type="text" id="keterangan" name="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Keterangan" />
        </div>
        <div class="flex items-end">
          <button id="add" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button>
        </div>
      </div>

      <div class="overflow-auto shadow-md sm:rounded-lg mb-10">
        <table class="table w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
                No
              </th>
              <th scope="col" class="px-6 py-3">
                Nama spesifikasi
              </th>
              <th scope="col" class="px-6 py-3">
                Jumlah
              </th>
              <th scope="col" class="px-6 py-3">
                Satuan
              </th>
              <th scope="col" class="px-6 py-3">
                Tanggal diperlukan
              </th>
              <th scope="col" class="px-6 py-3">
                Keterangan IT
              </th>
              <th scope="col" class="px-6 py-3">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="flex items-end justify-end space-x-6 xl:px-20">
      <form action="{{ route('permintaan.update', $data->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="disapprove">
        <input type="hidden" name="dataArray" class="dataArray" value="">
        <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Disapprove</button>
      </form>
      <form action="{{ route('permintaan.update', $data->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="dataArray" class="dataArray" value="">
        <input type="hidden" name="status" value="simpan">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
      </form>
      <form action="{{ route('permintaan.update', $data->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="approve">
        <input type="hidden" name="dataArray" class="dataArray" value="">
        <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Simpan & approve</button>
      </form>
    </div>

    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
              Edit Keterangan
            </h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <form class="p-4 md:p-5">
            <div class="grid gap-4 mb-4 grid-cols-2">
              <div class="col-span-2">
                <label for="spec2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama spesifikasi</label>
                <input type="text" id="spec2" name="spec2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama" />
              </div>
              <div>
                <label for="jumlah2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " disabled>Jumlah</label>
                <input type="number" id="jumlah2" name="jumlah2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jumlah" />
              </div>
              <div>
                <label for="satuan2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " disabled>Satuan</label>
                <input type="text" id="satuan2" name="satuan2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Satuan" />
              </div>
              <div class="col-span-2">
                <label for="datepicker-autohide2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " disabled>Tanggal diperlukan</label>
                <div class="relative sm:w-full">
                  <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                  </div>
                  <input id="datepicker-autohide2" name="tanggal2" datepicker-format="dd-mm-yyyy" datepicker datepicker-orientation="top" datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                </div>
              </div>
              <div class="col-span-2">
                <label for="keterangan2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " disabled>Keterangan IT</label>
                <input type="text" id="keterangan2" name="keterangan2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Keterangan" />
              </div>
            </div>
            <div class="flex justify-end">
              <button id="save-edit" type="button" data-modal-hide="crud-modal" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Edit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</x-layout>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modalElement = document.getElementById('crud-modal');
    const modal = new Modal(modalElement); // Initialize the Flowbite modal
    const addButton = document.getElementById('add');
    const tableBody = document.querySelector('tbody');
    const rawData = JSON.parse(document.getElementById('barangData').value);

    let dataArray = rawData.map(item => ({
      nama: item.nama,
      jumlah: item.jumlah,
      satuan: item.satuan,
      tanggal_diperlukan: formatDate(item.tanggal_diperlukan), // Convert the date
      keterangan_it: item.keterangan_it
    }));
    console.log(dataArray);

    updateHiddenInput();

    let currentEditIndex = -1; // Track the row being edited

    function formatDate(dateString) {
      const [year, month, day] = dateString.split('-');
      return `${day}-${month}-${year}`; // Change date format to dd-mm-yyyy
    }

    function updateHiddenInput() {
      let hiddenInputs = document.querySelectorAll('.dataArray');
      hiddenInputs.forEach(hiddenInput => {
        hiddenInput.value = JSON.stringify(dataArray);
      });
    }

    // Function to render the table
    function renderTable() {
      tableBody.innerHTML = '';

      dataArray.forEach((rowData, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
        <td class="px-6 py-4">${index + 1}</td>
        <td class="px-6 py-4">${rowData.nama}</td>
        <td class="px-6 py-4">${rowData.jumlah}</td>
        <td class="px-6 py-4">${rowData.satuan}</td>
        <td class="px-6 py-4">${rowData.tanggal_diperlukan}</td>
        <td class="px-6 py-4">${rowData.keterangan_it}</td>
        <td class="px-6 py-4">
          <button type="button" class="edit-button text-blue-600 hover:underline mr-5" data-index="${index}">Edit</button>
          <button type="button" class="delete-button text-red-600 hover:underline">Delete</button>
        </td>
      `;
        tableBody.appendChild(row);

        const deleteButton = row.querySelector('.delete-button');
        deleteButton.addEventListener('click', function() {
          deleteRow(index);
        });

        const editButton = row.querySelector('.edit-button');
        editButton.addEventListener('click', function() {
          currentEditIndex = index; // Save the index of the row being edited
          openModalWithData(rowData);
          modal.show(); // Show the modal when edit is clicked
        });
      });
    }

    // Open the modal and populate the input fields with data
    function openModalWithData(data) {
      document.getElementById('spec2').value = data.nama;
      document.getElementById('jumlah2').value = data.jumlah;
      document.getElementById('satuan2').value = data.satuan;
      document.getElementById('datepicker-autohide2').value = data.tanggal_diperlukan;
      document.getElementById('keterangan2').value = data.keterangan_it;
    }

    // Function to save the edited data
    function saveEdit() {
      const spec = document.getElementById('spec2').value;
      const jumlah = document.getElementById('jumlah2').value;
      const satuan = document.getElementById('satuan2').value;
      const tanggal = document.getElementById('datepicker-autohide2').value;
      const keterangan = document.getElementById('keterangan2').value;

      // Update the data array at the current edit index
      dataArray[currentEditIndex] = {
        nama: spec,
        jumlah: jumlah,
        satuan: satuan,
        tanggal_diperlukan: tanggal,
        keterangan_it: keterangan
      };

      renderTable();
      modal.hide(); // Hide the modal after saving the data
      updateHiddenInput();
    }

    // Function to delete a row
    function deleteRow(index) {
      dataArray.splice(index, 1);
      renderTable();
      updateHiddenInput();
    }

    // Add click event to the "Add" button
    addButton.addEventListener('click', function() {
      addRow();
    });

    // Add click event to the "Save" button in the modal
    const saveButton = document.getElementById('save-edit');
    if (saveButton) {
      saveButton.addEventListener('click', saveEdit);
    } else {
      console.error('Save button not found in the modal.');
    }

    // Function to add a row to the dataArray
    function addRow() {
      const spec = document.getElementById('spec').value;
      const jumlah = document.getElementById('jumlah').value;
      const satuan = document.getElementById('satuan').value;
      const tanggal = document.getElementById('datepicker-autohide').value;
      const keterangan = document.getElementById('keterangan').value;

      const rowData = {
        id: '',
        nama: spec,
        jumlah: jumlah,
        satuan: satuan,
        tanggal_diperlukan: tanggal,
        keterangan_it: keterangan
      };

      dataArray.push(rowData);
      renderTable();
      updateHiddenInput();

      // Clear form fields after adding a row
      document.getElementById('spec').value = '';
      document.getElementById('jumlah').value = '';
      document.getElementById('satuan').value = '';
      document.getElementById('datepicker-autohide').value = '';
      document.getElementById('keterangan').value = '';
    }

    setTimeout(() => {
      const alertElement = document.getElementById('alert');
      if (alertElement) {
        alertElement.classList.add('opacity-0');

        // Remove the alert after the transition (500ms)
        setTimeout(() => {
          alertElement.remove();
        }, 500); // Duration matches the CSS transition
      }
    }, 5000);

    renderTable();
  });
</script>