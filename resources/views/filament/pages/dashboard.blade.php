<x-filament::page>
    <x-filament::card>
        <h2 class="text-2xl font-bold">Welcome to the Custom Dashboard</h2>
        <p class="mt-4 text-gray-600">Here you can see various metrics and widgets.</p>
    </x-filament::card>

    <!-- Include the widgets defined in the page class -->
    @foreach ($this->getHeaderWidgets() as $widget)
        {{ $this->mount($widget) }}
    @endforeach

    <!-- Custom content or components can go here -->
</x-filament::page>
