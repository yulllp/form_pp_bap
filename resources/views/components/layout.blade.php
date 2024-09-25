<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<title>@yield('title', 'Default Title')</title>
</head>

<body>
	<section class="min-h-full flex overflow-x-hidden ">
		<x-sidebar></x-sidebar>

		<div class="flex flex-grow flex-col sm:ml-64 ">
			<x-header>{{ $title }}</x-header>
			<main class="w-full flex justify-center sm:justify-start items-center sm:items-start ">
				{{ $slot }}
			</main>
		</div>
		
	</section>
</body>

</html>