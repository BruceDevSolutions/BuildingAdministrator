<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">

	<title>{{ $title }}</title>

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('/assets/css/tailwind.output.css') }}" />

	<script src=" {{ asset('/assets/js/init-alpine.js') }}"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="">
	<div class="flex h-screen bg-zinc-100 dark:bg-zinc-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        
        <x-app.sidebar />
        
        <div class="flex flex-col flex-1 w-full">

            <x-app.header />

			<main class="h-full overflow-y-auto">
                <div class="container px-6 py-8 grid mx-auto ">
                    {{ $slot }}
                </div>
			</main>
		</div>
	</div>



{{-- 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="./assets/js/charts-lines.js" defer></script>
	<script src="./assets/js/charts-pie.js" defer></script>  --}}

    @stack('modals')

    @livewireScripts
    @stack('js') 

</body>

</html>
