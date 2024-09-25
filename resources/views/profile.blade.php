<x-layout>
    @section('title', 'Profile')
    <x-slot:title>{{ $title }} </x-slot:title>

    <section class="bg-gray-100 w-full min-h-screen flex flex-col">
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


        @if (session('status'))
        <div id="success-alert" class="relative flex w-full items-center p-4 mb-4 text-green-800 border border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
            <!-- Progress line (border) at the top -->
            <div id="progress-bar" class="absolute top-0 left-0 h-1 bg-green-500" style="width: 100%; transition: width 5s linear;"></div>

            <!-- Icon -->
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>

            <!-- Alert message -->
            <div class="ms-3 text-sm font-medium">
                {{ session('status') }}
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


        @if(session('success'))
        <div id="success-alert" class="hidden relative flex w-full items-center p-4 mb-4 text-green-800 border border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
            <!-- Progress line (border) at the top -->
            <div id="progress-bar" class="absolute top-0 left-0 h-1 bg-green-500" style="width: 100%; transition: width 5s linear;"></div>

            <!-- Icon -->
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>

            <!-- Alert message -->
            <div class="ms-3 text-sm font-medium">
                Data berhasil diupdate.
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

        <div class="max-w-4xl mx-auto p-8 bg-gray-50 mt-10 shadow-lg rounded-lg sm:p-12">
            <h2 class="text-3xl font-semibold mb-8 text-gray-800">Profile Settings</h2>
            <!-- Profile View Section -->
            <div id="profile-view" class="p-6 border border-gray-300 bg-gray-100 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700">Name:</label>
                        <p id="view-name" class="text-gray-600">{{$user->name ?? '-'}}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700">Username:</label>
                        <p id="view-username" class="text-gray-600">{{$user->username ?? '-'}}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700">Email:</label>
                        <p id="view-email" class="text-gray-600">{{$user->email ?? '-'}}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700">Jabatan:</label>
                        <p id="view-jabatan" class="text-gray-600">{{$user->jabatan ?? '-'}}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700">Tahun Masuk:</label>
                        @php
                        $tahunMasuk = $user->tahun_masuk ?? null;
                        $formattedDate = $tahunMasuk ? (new DateTime($tahunMasuk))->format('F Y') : '-';
                        @endphp

                        <p id="view-tahun" class="text-gray-600">{{ $formattedDate }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700">Department:</label>
                        <p id="view-department" class="text-gray-600">{{$user->department->nama ?? '-'}}</p>
                    </div>
                </div>
                <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded shadow-md hover:bg-blue-600 focus:ring focus:ring-blue-300" id="edit-button">Edit Profile</button>
                <button class="mt-4 bg-red-500 text-white py-2 px-4 rounded shadow-md hover:bg-red-600 focus:ring focus:ring-red-300" id="cpw-button">Change Password</button>
            </div>

            <form action="{{ route('profile.update') }}" method="post">
                @csrf
                @method('PUT')
                <div id="profile-edit" class="hidden p-6 border border-gray-300 bg-gray-100 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label class="block font-semibold text-gray-700">Name:</label>
                            <input id="edit-name" class="border w-full p-2 rounded-md" name="name" type="text" value="{{$user->name}}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold text-gray-700">Username:</label>
                            <input id="edit-username" class="border w-full p-2 rounded-md" type="text" name="username" value="{{$user->username}}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold text-gray-700">Email:</label>
                            <input id="edit-email" class="border w-full p-2 rounded-md" type="email" value="{{$user->email}}" required name="email">
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold text-gray-700">Jabatan:</label>
                            <input id="edit-jabatan" class="border w-full p-2 rounded-md" type="text" value="{{$user->jabatan}}" required name="jabatan">
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold text-gray-700">Tahun Masuk:</label>
                            @php
                            $tahunMasuk = $user->tahun_masuk ?? null;
                            $monthValue = $tahunMasuk ? date('Y-m', strtotime($tahunMasuk)) : '';
                            @endphp

                            <input id="edit-tahun" class="border w-full p-2 rounded-md" type="month" value="{{ $monthValue }}" required name="tahun_masuk">
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold text-gray-700">Department:</label>
                            <select id="edit-department" name="department_id" class="border w-full p-2 rounded-md" required>
                                <option value="" disabled selected>Select Department</option>
                                @foreach ($departments as $department)

                                @if ($user->department_id == $department->id)
                                <option value="{{ $department->id }}" selected>{{ $department->nama }}</option>
                                @endif

                                <option value="{{ $department->id }}">{{ $department->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-6">
                        <button type='submit' class="bg-green-500 text-white py-2 px-4 rounded shadow-md hover:bg-green-600 focus:ring focus:ring-green-300" id="save-button">Save</button>
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded shadow-md hover:bg-gray-600 focus:ring focus:ring-gray-300" id="cancel-button">Cancel</button>
                    </div>
                </div>
            </form>

            <form action="{{route('password.update')}}" method="post">
                @csrf
                @method('PUT')
                <div id="cpw-edit" class="hidden p-6 border border-gray-300 bg-gray-100 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex flex-col gap-4">
                        <div class="mb-4">
                            <label class="block font-semibold text-gray-700">New Password:</label>
                            <input id="edit-newpassword" class="border w-full p-2 rounded-md" name="new_password" type="password" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold text-gray-700">Confirm Password:</label>
                            <input id="edit-confirmpassword" class="border w-full p-2 rounded-md" name="confirm_password" type="password" required>
                        </div>
                    </div>
                    <div id="alert" class="hidden mt-4 p-4 border border-red-300 bg-red-50 text-red-800" role="alert">
                        <div class="flex justify-between items-center">
                            <span>Passwords do not match!</span>
                            <button type="button" class="text-red-600" id="close-alert">✖</button>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-6">
                        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded shadow-md hover:bg-green-600 focus:ring focus:ring-green-300" id="savecpw-button">Save</button>
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded shadow-md hover:bg-gray-600 focus:ring focus:ring-gray-300" id="cancelcpw-button">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
    </section>
</x-layout>
<script>
    document.addEventListener('DOMContentLoaded', () => {
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


    const profileView = document.getElementById('profile-view');
    const profileEdit = document.getElementById('profile-edit');
    const cpwEdit = document.getElementById('cpw-edit');
    const editButton = document.getElementById('edit-button');
    const cpwButton = document.getElementById('cpw-button');
    const cancelButton = document.getElementById('cancel-button');
    const cancelCpw = document.getElementById('cancelcpw-button');

    editButton.addEventListener('click', function() {
        profileView.classList.add('hidden');
        profileEdit.classList.remove('hidden');
    });

    cancelButton.addEventListener('click', function() {
        profileEdit.classList.add('hidden');
        profileView.classList.remove('hidden');
    });

    cpwButton.addEventListener('click', function() {
        profileView.classList.add('hidden');
        cpwEdit.classList.remove('hidden');
    });

    cancelCpw.addEventListener('click', function() {
        cpwEdit.classList.add('hidden');
        profileView.classList.remove('hidden');
    });
</script>