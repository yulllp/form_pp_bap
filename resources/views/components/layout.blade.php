<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title', 'Default Title')</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	<link rel="icon" href="{{ asset('/public/logo_ipg.png') }}" type="image/png">
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
	<script src="{{ asset('build/assets/app-BJxLEllr.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('build/assets/app-m5mUF54f.css') }}">
</head>

<body class="h-full flex overflow-x-hidden bg-white dark:bg-gray-900">
		<x-sidebar></x-sidebar>

		<div class="flex flex-grow flex-col sm:ml-64 bg-white overflow-hidden dark:bg-gray-900">
			<x-header>{{ $title }}</x-header>
			<main class="w-full flex justify-center sm:justify-start items-center sm:items-start">
				{{ $slot }}
			</main>
		</div>
</body>

</html>