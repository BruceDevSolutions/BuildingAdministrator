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

</x-app-layout>