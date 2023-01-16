<x-app-layout>
    @if($general_settings->welcome_message)
        <x-card>
            <x-title>
                Bienvenido a {{ $general_settings->building_name }}
            </x-title>
            <x-paragraph class="mt-4">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla tempora similique quisquam magnam fugiat sint ullam voluptatum, laudantium tenetur asperiores necessitatibus, deserunt maiores. Similique nemo saepe modi fugiat libero iste!
            </x-paragraph>
        </x-card>
    @endif

    <x-title title="Anuncios" size="text-2xl text-center" class="mb-4" />

    @if($pinned_announcements)
        @foreach ($pinned_announcements as $announcement)
            <x-card>
                <div class="flex justify-between">
                    <x-title>
                        {{ $announcement->title }}
                    </x-title>
                    <i title="Anuncio anclado">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fill-purple-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </i>
                </div>

                <x-paragraph class="mt-4">
                    {{ $announcement->announcement }}
                </x-paragraph>

                <x-paragraph class="mt-4 flex justify-end">
                    Fecha: {{ $announcement->created_at }}
                </x-paragraph>
            </x-card> 
        @endforeach
    @endif
  


    @foreach ($announcements as $announcement)
        <x-card class="">
            <x-title>
                {{ $announcement->title }}
            </x-title>
            <x-paragraph class="mt-4">
                {{ $announcement->announcement }}
            </x-paragraph>

            <x-paragraph class="mt-4 flex justify-end">
                Fecha: {{ $announcement->created_at }}
            </x-paragraph>
        </x-card> 
    @endforeach

    @if(!$announcements->count() && !$pinned_announcements->count())
        <x-paragraph class="text-center">No hay anuncios activos en este momento</x-paragraph>
    @endif


</x-app-layout>