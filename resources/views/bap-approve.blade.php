<x-layout>
    @section('title', 'On Going - BAP')
    <x-slot:title>{{$title}} </x-slot:title>

    <section class="bg-white dark:bg-gray-900 lg:w-3/4 sm:w-full px-4 py-6 sm:px-6 mx-auto shadow-lg rounded-lg">
        <!-- Approval Form -->
        <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md transition-colors duration-300 ease-in-out">
            <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4 sm:mb-6 text-center">Approval Berita Acara Pengakuan</h3>

            <!-- Info Section -->
            <div class="mb-4">
                <p class="text-md sm:text-lg font-semibold text-gray-800 dark:text-gray-300 mb-1">Nomor BAP:</p>
                <p class="text-md sm:text-lg text-gray-600 dark:text-gray-400">{{ $berita->nomor }}</p>
            </div>
            <div class="mb-4">
                <p class="text-md sm:text-lg font-semibold text-gray-800 dark:text-gray-300 mb-1">Diajukan oleh:</p>
                <p class="text-md sm:text-lg text-gray-600 dark:text-gray-400">{{ $berita->pembuat->name }}</p>
            </div>
            <div class="mb-4">
                <p class="text-md sm:text-lg font-semibold text-gray-800 dark:text-gray-300 mb-1">Diajukan pada:</p>
                <p class="text-md sm:text-lg text-gray-600 dark:text-gray-400">{{ $berita->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div class="mb-4">
                <p class="text-md sm:text-lg font-semibold text-gray-800 dark:text-gray-300 mb-1">Penerima:</p>
                <p class="text-md sm:text-lg text-gray-600 dark:text-gray-400">{{ $berita->penerima->name }}</p>
            </div>
            <div class="mb-4">
                <p class="text-md sm:text-lg font-semibold text-gray-800 dark:text-gray-300 mb-1">Department:</p>
                <p class="text-md sm:text-lg text-gray-600 dark:text-gray-400">{{ $berita->penerima->department->nama }}</p>
            </div>

            <div class="mb-4">
                <p class="text-md sm:text-lg font-semibold text-gray-800 dark:text-gray-300 mb-1">Barang:</p>
                <p class="text-md sm:text-lg text-gray-600 dark:text-gray-400">{{ $berita->detail_barang->type->name }} {{ $berita->detail_barang->brand->name }} ({{$berita->detail_barang->spesifikasi}})</p>
            </div>

            @if (Auth::user()->department->nama === 'PURCHASING')
            <div class="mb-6">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-300 mb-4">Data Pembelian</h2>

                <div class="mb-4">
                    <div class="flex justify-start gap-24">
                        <p class="text-md sm:text-lg font-semibold text-gray-800 dark:text-gray-300 mb-1">
                            Nomor PP: <span class="text-gray-600 dark:text-gray-400 font-normal"> {{ $berita->pembelian->pp }}</span>
                        </p>
                        <p class="text-md sm:text-lg font-semibold text-gray-800 dark:text-gray-300 mb-1">
                            Tanggal PP: <span class="text-gray-600 dark:text-gray-400 font-normal"> {{ $berita->pembelian->pp_date }}</span>
                        </p>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex justify-start gap-24">
                        <p class="text-md sm:text-lg font-semibold text-gray-800 dark:text-gray-300 mb-1">
                            Nomor PO: <span class="text-gray-600 dark:text-gray-400 font-normal"> {{ $berita->pembelian->po }}</span>
                        </p>
                        <p class="text-md sm:text-lg font-semibold text-gray-800 dark:text-gray-300 mb-1">
                            Tanggal PO: <span class="text-gray-600 dark:text-gray-400 font-normal"> {{ $berita->pembelian->po_date }}</span>
                        </p>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex justify-start gap-24">
                        <p class="text-md sm:text-lg font-semibold text-gray-800 dark:text-gray-300 mb-1">
                            Nomor Surat Jalan: <span class="text-gray-600 dark:text-gray-400 font-normal"> {{ $berita->pembelian->sj }}</span>
                        </p>
                        <p class="text-md sm:text-lg font-semibold text-gray-800 dark:text-gray-300 mb-1">
                            Tanggal Surat Jalan: <span class="text-gray-600 dark:text-gray-400 font-normal"> {{ $berita->pembelian->sj_date }}</span>
                        </p>
                    </div>
                </div>
            </div>          
            @endif

            <div class="mb-6">
                <p class="text-lg font-semibold text-gray-800 dark:text-gray-300">Gambar:</p>
                @if ($berita->pengecekan->foto1 && !$berita->pengecekan->foto2)
                <div class="flex justify-start">
                    <img src="{{ asset('public/storage/' . $berita->pengecekan->foto1) }}" alt="gambar1" class="w-64 h-32 object-contain border dark:border-gray-600">
                </div>
                @elseif ($berita->pengecekan->foto1 && $berita->pengecekan->foto2)
                <div class="flex justify-start space-x-4">
                    <img src="{{ asset('public/storage/' . $berita->pengecekan->foto1) }}" alt="gambar1" class="w-64 h-32 object-contain border dark:border-gray-600">
                    <img src="{{ asset('public/storage/' . $berita->pengecekan->foto2) }}" alt="gambar2" class="w-64 h-32 object-contain border dark:border-gray-600">
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                <button type="button" onclick="openModal2()" class="flex-1 px-6 py-3 font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800 transition-colors duration-300">
                    Approve
                </button>
                <a href="{{route('printbap',$berita->id)}}" target="_blank" rel="noopener noreferrer" class="flex-1 px-6 py-3 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition-colors duration-300 text-center">
                    Detail
                </a>
                <button type="button" onclick="openModal()" class="flex-1 px-6 py-3 font-semibold text-white bg-red-600 rounded-lg hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800 transition-colors duration-300">
                    Disapprove
                </button>
            </div>
        </div>

        <!-- Approval Modal -->
        <div id="approveModal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-lg dark:bg-gray-700 transition-transform transform duration-300 scale-100">
                    <button type="button" class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModal2()">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">Confirmation</h3>
                        <p class="mb-5 text-md text-gray-600 dark:text-gray-300">Are you sure you want to approve this?</p>
                        <form method="POST" action="{{route('bap.approve', $berita->id)}}" id="modalApproveForm" class="mt-4">
                            @csrf
                            @method('PUT')
                            <div class="flex justify-center space-x-4">
                                <button type="button" onclick="closeModal2()" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-900 dark:focus:ring-gray-600">Cancel</button>
                                <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 rounded-lg text-sm px-5 py-2.5 transition duration-200">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="revisimodal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModal()">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 id="modalMessage" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah data yang diisi sudah benar?</h3>
                        <form id="revisiForm" action="{{route('bap.reject',$berita->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <textarea id="revisi" rows="4" name="revisi" class="mb-4 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan revisi"></textarea>
                            <div class="flex justify-between">
                                <button type="button" onclick="closeModal()" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900">No, cancel</button>
                                <button id='complete' type="submit" class="ms-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Yes, I'm sure</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        function openModal() {
            document.getElementById('revisimodal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeModal() {
            document.getElementById('revisimodal').classList.add('hidden');
            document.body.style.overflow = ''; // Restore original overflow
        }

        function openModal2() {
            document.getElementById("approveModal").classList.remove("hidden");
            document.body.style.overflow = "hidden"; // Prevent scrolling
        }

        function closeModal2() {
            document.getElementById("approveModal").classList.add("hidden");
            document.body.style.overflow = "auto"; // Restore scrolling
        }
    </script>
</x-layout>