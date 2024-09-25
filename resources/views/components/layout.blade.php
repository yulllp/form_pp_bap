<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<title>@yield('title', 'Default Title')</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="h-full flex overflow-x-hidden bg-white dark:bg-gray-900">
		<x-sidebar></x-sidebar>

		<div class="flex flex-grow flex-col sm:ml-64 bg-white dark:bg-gray-900">
			<x-header>{{ $title }}</x-header>
			<main class="w-full flex justify-center sm:justify-start items-center sm:items-start ">
				{{ $slot }}
			</main>
		</div>
</body>

</html>