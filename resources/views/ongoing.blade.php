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
            @if (Auth::user()->department->nama == 'IT' || Auth::user()->name == Auth::user()->department->leader->name)
            <th scope="col" class="px-6 py-3">
              Nama
            </th>
            <th scope="col" class="px-6 py-3">
              Jabatan
            </th>
            @endif
            <th scope="col" class="px-6 py-3">
              Pembelian untuk PT
            </th>
            <th scope="col" class="px-6 py-3">
              Alasan permintaan
            </th>
            @if (Auth::user()->department->nama == 'IT' || (Auth::user()->department->nama != 'IT' && Auth::user()->name != Auth::user()->department->leader->name))
            <th scope="col" class="px-6 py-3">
              Revisi
            </th>
            @endif
            <th scope="col" class="px-6 py-3">
              Aksi
            </th>
          </tr>
        </thead>
        @foreach ($datas as $data)
        <tbody>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ ($datas->currentPage() - 1) * $datas->perPage() + $loop->iteration }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $data->nomor }}
            </td>
            @if (Auth::user()->department->nama == 'IT' || Auth::user()->name == Auth::user()->department->leader->name)
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $data->user->name }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $data->user->jabatan }}
            </td>
            @endif
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $data->pt_tujuan->name }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ \Illuminate\Support\Str::limit($data->alasan, 50, '...') }}
            </td>
            @if (Auth::user()->department->nama == 'IT')
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $data->revision_it ? 'ada, silahkan lakukan pengeditan' : '-' }}
            </td>
            @elseif (Auth::user()->department->nama != 'IT' && Auth::user()->name != Auth::user()->department->leader->name)
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $data->revision_user ? 'ada, silahkan lakukan pengeditan' : '-' }}
            </td>
            @endif
            <td class="px-6 py-4 flex space-x-3">
              <button data-modal-target="timeline-modal" data-modal-toggle="timeline-modal" data-original-icon data-status="{{ $data->status }}" data-create="{{ $data->created_at }}" data-confirm-it="{{ $data->it_confirm_date }}" data-confirm-manager="{{ $data->manager_confirm_date }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Status
              </button>
              @if ((Auth::user()->department->nama != 'IT' && Auth::user()->name != Auth::user()->department->leader->name) && ($data->status == 'acc0' || $data->status == 'acc-1'))
              <a href="{{ route('permintaan.edit', $data->id) }}">
                <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                  Edit
                </button>
              </a>
              @endif
              @if ((Auth::user()->department->nama == 'IT' && ($data->status == 'acc0' || $data->status == 'acc1' || $data->status == 'acc-1' || $data->status == 'acc-2')) || (Auth::user()->name == Auth::user()->department->leader->name && ($data->status == 'acc1' || $data->status == 'acc-2')))
              <a href="{{ route('permintaan.approval', $data->id) }}">
                <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                  Approval
                </button>
              </a>
              @endif
              <a href="{{route('printpp',['id' => $data->id])}}" target="_blank" rel="noopener noreferrer">
                <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                  Details
                </button>
              </a>
            </td>
          </tr>
        </tbody>
        @endforeach
      </table>
    </div>

    <div id="timeline-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
              Status
            </h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="timeline-modal">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-7 md:p-10">
            <ol class="relative text-gray-500 border-s border-gray-200 dark:border-gray-900 dark:text-gray-400">
              <li class="mb-10 ms-7 step">
                <span class="absolute flex items-center justify-center w-8 h-8 bg-green-200 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-green-900">
                  <svg class="w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                  </svg>
                </span>
                <h3 class="font-medium leading-tight">Data berhasil di upload</h3>
                <p class="text-sm">Data telah di upload pada tanggal</p>
              </li>
              <li class="mb-10 ms-7 step">
                <span class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                  <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                    <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
                  </svg>
                </span>
                <h3 class="font-medium leading-tight">Menunggu konfirmasi dari Pihak IT</h3>
                <p class="text-sm">Data sedang diproses</p>
              </li>
              <li class="ms-7 step">
                <span class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                  <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                  </svg>
                </span>
                <h3 class="font-medium leading-tight">Menunggu konfirmasi dari Manager</h3>
                <p class="text-sm">Data masih diproses IT</p>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="p-4">
      {{ $datas->links() }}
    </div>
  </section>
</x-layout>

<script>
  document.querySelectorAll('button[data-modal-target="timeline-modal"]').forEach(button => {
    button.addEventListener('click', function() {
      const status = this.getAttribute('data-status');
      let created_at = formatDate(this.getAttribute('data-create'));
      let it_confirm_date = formatDate(this.getAttribute('data-confirm-it'));
      let manager_confirm_date = formatDate(this.getAttribute('data-confirm-manager'));

      document.querySelectorAll('.step').forEach(step => {
        step.querySelector('span').className = 'absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700';
        step.querySelector('svg').className = 'w-3.5 h-3.5 text-gray-500 dark:text-gray-400';
      });

      if (status === 'acc0') {
        setStepComplete(0, 'Data berhasil di upload', `Data dibuat pada ${created_at}`);
        setStepInProgress1(1, 'Menunggu konfirmasi dari Pihak IT', 'Konfirmasi akan dikirimi ke email anda');
        setDefault(2, 'Menunggu konfirmasi dari Manager', 'Data masih diproses IT');
      } else if (status === 'acc1') {
        setStepComplete(0, 'Data berhasil di upload', `Data dibuat pada ${created_at}`);
        setStepComplete(1, 'Konfirmasi dari Pihak IT selesai', `Data dikonfirm pada ${it_confirm_date}`);
        setStepInProgress2(2, 'Menunggu konfirmasi dari Manager', 'Data sedang diproses manager');
      } else if (status === 'acc2') {
        setStepComplete(0, 'Data berhasil di upload', `Data dibuat pada ${created_at}`);
        setStepComplete(1, 'Konfirmasi dari Pihak IT selesai', `Data dikonfirm pada ${it_confirm_date}`);
        setStepComplete(2, 'Konfirmasi dari Manager selesai', `Data dikonfirm pada ${manager_confirm_date}`);
      } else if (status === 'acc-1') {
        setStepInProgress1(0, 'Terdapat kesalahan pada data user', 'Menunggu revisi data user');
        displayRedCross(1, 'Permintaan ditolak oleh IT', `Data ditolak pada ${it_confirm_date}. Silahkan menghubungi pihak IT`)
        setDefault(2, 'Menunggu konfirmasi dari Manager', 'Data masih diproses IT');
      } else if (status === 'acc-2') {
        setStepComplete(0, 'Data berhasil di upload', `Data dibuat pada ${created_at}`);
        setStepInProgress1(1, 'Revisi dari Pihak IT', 'Silahkan menunggu pemberitahuan pihak IT');
        displayRedCross(2, 'Permintaan ditolak oleh Manager', `Data dikonfirm pada ${manager_confirm_date}`);
      }
    });
  });

  function formatDate(dateString) {
    const date = new Date(dateString);
    const options = {
      day: 'numeric',
      month: 'short',
      year: 'numeric'
    };
    return date.toLocaleDateString('en-GB', options); // '26 Sept 2024'
  }

  function setStepComplete(stepIndex, title, sub) {
    const step = document.querySelectorAll('.step')[stepIndex];
    step.querySelector('span').className = 'absolute flex items-center justify-center w-8 h-8 bg-green-200 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-green-900';
    step.querySelector('svg').className = 'w-3.5 h-3.5 text-green-500 dark:text-green-400';
    step.querySelector('span').innerHTML = `<svg class="w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                  </svg>`
    step.querySelector('h3').textContent = title;
    step.querySelector('p').innerHTML = sub;
  }

  function setStepInProgress1(stepIndex, title, sub) {
    const step = document.querySelectorAll('.step')[stepIndex];
    step.querySelector('span').className = 'absolute flex items-center justify-center w-8 h-8 bg-yellow-200 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-yellow-600';
    step.querySelector('svg').className = 'w-3.5 h-3.5 text-yellow-500 dark:text-yellow-400';
    step.querySelector('span').innerHTML = `<svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                    <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
                  </svg>`
    step.querySelector('h3').textContent = title;
    step.querySelector('p').innerHTML = sub;
  }

  function setStepInProgress2(stepIndex, title, sub) {
    const step = document.querySelectorAll('.step')[stepIndex];
    step.querySelector('span').className = 'absolute flex items-center justify-center w-8 h-8 bg-yellow-200 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-yellow-600';
    step.querySelector('svg').className = 'w-3.5 h-3.5 text-yellow-500 dark:text-yellow-400';
    step.querySelector('span').innerHTML = `<svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                  </svg>`
    step.querySelector('h3').textContent = title;
    step.querySelector('p').innerHTML = sub;
  }

  function displayRedCross(stepIndex, title, sub) {
    const step = document.querySelectorAll('.step')[stepIndex];
    step.querySelector('span').className = 'absolute flex items-center justify-center w-8 h-8 bg-red-200 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-red-900';
    step.querySelector('svg').className = 'w-3.5 h-3.5 text-red-500 dark:text-red-400';
    step.querySelector('svg').innerHTML = `<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l14 14m0-14L1 15" />
              </svg>`;
    step.querySelector('h3').textContent = title;
    step.querySelector('p').innerHTML = sub;
  }

  function setDefault(stepIndex, title, sub) {
    const step = document.querySelectorAll('.step')[stepIndex];
    step.querySelector('span').className = 'absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700';
    step.querySelector('svg').className = 'w-3.5 h-3.5 text-yellow-500 dark:text-yellow-400';
    step.querySelector('span').innerHTML = `<svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                  </svg>`
    step.querySelector('h3').textContent = title;
    step.querySelector('p').innerHTML = sub;
  }
</script>