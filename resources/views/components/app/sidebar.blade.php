		<!-- Desktop sidebar -->
		<aside class="z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-white dark:bg-black md:block">
			<div class="py-4 text-gray-500 dark:text-gray-400">

				<livewire:application-logo />

				<ul class="mt-6">
					<li class="relative px-3 py-3">
						<span class="{{request()->routeIs('home') ? 'absolute' : 'hidden'}}  inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-primary-600" aria-hidden="true"></span>
						<a href="{{ route('home') }}" class="inline-flex items-center w-full text-sm font-semibold {{request()->routeIs('home') ? 'text-gray-800 dark:text-gray-100' : ''}}  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
							<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
								<path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
							</svg>
							<span class="ml-4">Inicio</span>
						</a>
					</li>
{{-- 					<li class="relative px-3 py-3">
						<span class="{{request()->routeIs('announcements.*') ? 'absolute' : 'hidden'}}  inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-primary-600" aria-hidden="true"></span>
						<a href="{{ route('announcements.index') }}" class="inline-flex items-center w-full text-sm font-semibold {{request()->routeIs('announcements.*') ? 'text-gray-800 dark:text-gray-100' : ''}}  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
							<svg class="w-5 h-5"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
							</svg>
							<span class="ml-4">Anuncios</span>
						</a>
					</li> --}}
					
					{{-- Dropdown anuncios --}}
					<li class="relative px-3 py-3">
						<span class="{{request()->routeIs('announcements.*') ? 'absolute' : 'hidden'}}  inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-primary-600" aria-hidden="true"></span>
						<button class="inline-flex items-center justify-between w-full text-sm font-semibold {{request()->routeIs('announcements.*') ? 'text-gray-800 dark:text-gray-100' : ''}} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="togglePagesMenu" aria-haspopup="true">
							<span class="inline-flex items-center">
								<svg class="w-5 h-5"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
								</svg>
								<span class="ml-4">Anuncios</span>
							</span>
							<svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
							</svg>
						</button>
						<template x-if="isPagesMenuOpen">
							<ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
								<li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
									<a href="{{ route('announcements.index') }}" class="w-full">
										Ver anuncios
									</a>
								</li>
								<li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
									<a  href="{{ route('announcements.create') }}" class="w-full">
										Crear anuncio
									</a>
								</li>
							</ul>
						</template>
					</li>

					{{-- Dropdown de administración --}}
					<li class="relative px-3 py-3">
						<span class="{{request()->routeIs('admin.*') ? 'absolute' : 'hidden'}}  inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-primary-600" aria-hidden="true"></span>
						<button class="inline-flex items-center justify-between w-full text-sm font-semibold {{request()->routeIs('admin.*') ? 'text-gray-800 dark:text-gray-100' : ''}} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="toggleAdministrationMenu" aria-haspopup="true">
							<span class="inline-flex items-center">
								<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
								</svg>
								<span class="ml-4">Administración</span>
							</span>
							<svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
							</svg>
						</button>
						<template x-if="isAdministrationMenuOpen">
							<ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
								<li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
									<a href="{{ route('admin.users.index') }}" class="w-full">
										Usuarios
									</a>
								</li>
								<li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
									<a  href="{{ route('announcements.create') }}" class="w-full">
										Registrar Usuario
									</a>
								</li>
							</ul>
						</template>
					</li>

					{{-- Dropdown inmuebles --}}
					<li class="relative px-3 py-3">
						<span class="{{request()->routeIs('properties.*') ? 'absolute' : 'hidden'}}  inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-primary-600" aria-hidden="true"></span>
						<button class="inline-flex items-center justify-between w-full text-sm font-semibold {{request()->routeIs('properties.*') ? 'text-gray-800 dark:text-gray-100' : ''}} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="togglePropertiesMenu" aria-haspopup="true">
							<span class="inline-flex items-center">
								<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
								</svg>
								<span class="ml-4">Inmuebles</span>
							</span>
							<svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
							</svg>
						</button>
						<template x-if="isPropertiesMenuOpen">
							<ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
								<li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
									<a href="{{ route('properties.index') }}" class="w-full">
										Ver inmuebles
									</a>
								</li>
								<li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
									<a  href="{{ route('announcements.create') }}" class="w-full">
										Crear anuncio
									</a>
								</li>
							</ul>
						</template>
					</li>

					{{-- Ajustes --}}
					<li class="relative px-3 py-3">
						<span class="{{request()->routeIs('settings') ? 'absolute' : 'hidden'}}  inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-primary-600" aria-hidden="true"></span>
						<a href="{{ route('settings') }}" class="inline-flex items-center w-full text-sm font-semibold {{request()->routeIs('settings') ? 'text-gray-800 dark:text-gray-100' : ''}}  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
							<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5" />
							</svg>
							<span class="ml-4">Ajustes</span>
						</a>
					</li>

				


				
				</ul>
			</div>
		</aside>
		<!-- Mobile sidebar -->
		<!-- Backdrop -->
		<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
		<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-black md:hidden" x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu" @keydown.escape="closeSideMenu">
			<div class="py-4 text-gray-500 dark:text-gray-400">

				<livewire:application-logo />

				<ul class="mt-6">
					<li class="relative px-3 py-3">
						<span class="{{request()->routeIs('home') ? 'absolute' : 'hidden'}}  inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-primary-600" aria-hidden="true"></span>
						<a href="{{ route('home') }}" class="inline-flex items-center w-full text-sm font-semibold {{request()->routeIs('home') ? 'text-gray-800 dark:text-gray-100' : ''}}  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
							<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
								<path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
							</svg>
							<span class="ml-4">Inicio</span>
						</a>
					</li>

					{{-- Dropdown anuncios --}}
					<li class="relative px-3 py-3">
						<span class="{{request()->routeIs('announcements.*') ? 'absolute' : 'hidden'}}  inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-primary-600" aria-hidden="true"></span>
						<button class="inline-flex items-center justify-between w-full text-sm font-semibold {{request()->routeIs('announcements.*') ? 'text-gray-800 dark:text-gray-100' : ''}} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="togglePagesMenu" aria-haspopup="true">
							<span class="inline-flex items-center">
								<svg class="w-5 h-5"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
								</svg>
								<span class="ml-4">Anuncios</span>
							</span>
							<svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
							</svg>
						</button>
						<template x-if="isPagesMenuOpen">
							<ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
								<li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
									<a href="{{ route('announcements.index') }}" class="w-full">
										Ver anuncios
									</a>
								</li>
								<li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
									<a  href="{{ route('announcements.create') }}" class="w-full">
										Crear anuncio
									</a>
								</li>
							</ul>
						</template>
					</li>

					{{-- Ajustes --}}
					<li class="relative px-3 py-3">
						<span class="{{request()->routeIs('settings') ? 'absolute' : 'hidden'}}  inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-primary-600" aria-hidden="true"></span>
						<a href="{{ route('settings') }}" class="inline-flex items-center w-full text-sm font-semibold {{request()->routeIs('settings') ? 'text-gray-800 dark:text-gray-100' : ''}}  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
							<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5" />
							</svg>
							<span class="ml-4">Ajustes</span>
						</a>
					</li>
				</ul>
			</div>
		</aside>