<x-layout>
    @section('title', 'Berita Acara Pengakuan')
    <x-slot:title>{{$title}}</x-slot:title>

    <section class="bg-white dark:bg-gray-900 w-full px-4 py-4 sm:px-6">
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


        @if (session('success'))
        <div id="success-alert" class="relative flex w-full items-center p-4 mb-4 text-green-800 border border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
            <!-- Progress line (border) at the top -->
            <div id="progress-bar" class="absolute top-0 left-0 h-1 bg-green-500" style="width: 100%; transition: width 5s linear;"></div>

            <!-- Icon -->
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>

            <!-- Alert message -->
            <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
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

        <form id="multiStepForm" method="POST" action="{{route('store.bap')}}" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md" enctype="multipart/form-data">
        @csrf
            <!-- Penerima Section -->
            <div class="form-section" id="section1">
                <h3 class="text-xl font-bold dark:text-white mb-4">Penerima</h3>
                <div class="mb-4">
                    <label for="recipient_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Penerima</label>
                    <select id="user_category" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        <option value="">Pilih Penerima</option>
                        @foreach ($users as $user)
                        <option value="{{$user->id}}" data-department="{{$user->department ? $user->department->nama : 'Belum isi department'}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="department-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department</label>
                    <input type="text" name="department" id="department-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white cursor-not-allowed" placeholder="Input otomatis dari nama penerima"  readonly>
                </div>
                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Penyerahan</label>
                    <input type="date" name="tanggal" id="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white cursor-not-allowed"  readonly>
                </div>
                <div class="justify-end text-right">
                    <button type="button" class="next-btn bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Next</button>
                </div>
            </div>

            <!-- Detail Barang Section -->
            <div class="form-section hidden" id="section2">
                <h3 class="text-xl font-bold dark:text-white mb-4">Detail Barang</h3>
                <div class="mb-4">
                    <label for="brand" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Brand</label>
                    <select id="brand" name="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        <option value="">Pilih Brand</option>
                        @foreach ($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                    <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        <option value="">Pilih Tipe Barang</option>
                        @foreach ($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="spek" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Spesifikasi</label>
                    <input type="text" name="spek" id="spek" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="serial" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Serial Number</label>
                    <input type="text" name="serial" id="serial" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="pc_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">PC Name</label>
                    <input type="text" name="pc_name" id="pc_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input type="text" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="os" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                    <select id="os" name="os" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        <option value="">Pilih Operating System</option>
                        @foreach ($oss as $os)
                        <option value="{{$os->id}}">{{$os->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="os_pk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">OS Product Key</label>
                    <input type="text" name="os_pk" id="os_pk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="office" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Office</label>
                    <select id="office" name="office" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        <option value="">Pilih Office</option>
                        @foreach ($offices as $office)
                        <option value="{{$office->id}}">{{$office->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="office_pk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Office Product Key</label>
                    <input type="text" name="office_pk" id="office_pk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="other" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Other</label>
                    <input type="text" name="other" id="other" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="flex justify-between">
                    <button type="button" class="prev-btn bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Previous</button>
                    <button type="button" class="next-btn bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Next</button>
                </div>
            </div>

            <!-- Pembelian Section -->
            <div class="form-section hidden" id="section3">
                <h3 class="text-xl font-bold dark:text-white mb-4">Pembelian</h3>
                <div class="mb-4">
                    <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company</label>
                    <select id="company" name="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        <option value="">Pilih PT Tujuan</option>
                        @foreach ($companies as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="pp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Request Number (PP) </label>
                    <input type="text" name="pp" id="pp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="tanggal_pp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal PP</label>
                    <input type="date" name="tanggal_pp" id="tanggal_pp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="po" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purchase Number (PO) </label>
                    <input type="text" name="po" id="po" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="tanggal_po" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal PO</label>
                    <input type="date" name="tanggal_po" id="tanggal_po" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="SJ" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Receipt Note Number (SJ) </label>
                    <input type="text" name="sj" id="sj" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="tanggal_sj" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal SJ</label>
                    <input type="date" name="tanggal_sj" id="tanggal_sj" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="tanggal_rd" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Receipt</label>
                    <input type="date" name="tanggal_rd" id="tanggal_rd" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="flex justify-between">
                    <button type="button" class="prev-btn bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Previous</button>
                    <button type="button" class="next-btn bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Next</button>
                </div>
            </div>

            <!-- Pengecekan Section -->
            <div class="form-section hidden" id="section4">
                <h3 class="text-xl font-bold dark:text-white mb-4">Pengecekan</h3>
                <div class="mb-4">
                    <label for="checker" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Checker</label>
                    <input type="text" name="checker" id="checker" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="tanggal_check" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pengecekan</label>
                    <input type="date" name="tanggal_check" id="tanggal_check" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                </div>
                <div class="mb-4">
                    <label for="gambar1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar 1</label>
                    <input id="gambar1" class="border w-full p-2 rounded-md dark:bg-gray-700 dark:text-gray-300" type="file" name="gambar1" accept="image/*">
                </div>
                <div class="mb-4">
                    <label for="gambar2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar 2</label>
                    <input id="gambar2" class="border w-full p-2 rounded-md dark:bg-gray-700 dark:text-gray-300" type="file" name="gambar2" accept="image/*">
                </div>
                <div class="flex justify-between">
                    <button type="button" class="prev-btn bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Previous</button>
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Submit</button>
                </div>
            </div>
        </form>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const today = new Date();

            // Format the date to YYYY-MM-DD
            const formattedDate = today.toISOString().split('T')[0];

            // Set the value of the date input
            const dateInput = document.getElementById('tanggal');
            dateInput.value = formattedDate;
            const userCategorySelect = document.getElementById('user_category');
            const departmentField = document.getElementById('department-name');

            userCategorySelect.addEventListener('change', function() {
                const selectedOption = userCategorySelect.options[userCategorySelect.selectedIndex];
                const departmentName = selectedOption.getAttribute('data-department');

                // Autofill department field
                departmentField.value = departmentName ? departmentName : '';
            });
            let currentSection = 0;
            const sections = document.querySelectorAll('.form-section');
            const nextBtns = document.querySelectorAll('.next-btn');
            const prevBtns = document.querySelectorAll('.prev-btn');

            function showSection(index) {
                sections.forEach((section, i) => {
                    section.classList.toggle('hidden', i !== index);
                });
            }

            nextBtns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    currentSection++;
                    showSection(currentSection);
                });
            });

            prevBtns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    currentSection--;
                    showSection(currentSection);
                });
            });

            // Show the first section on load
            showSection(0);

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