<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-2xl font-bold leading-tight">
                {{ __('Registro de Diagnósticos') }}
            </h2>
        </div>
    </x-slot>

    <x-table 
        title="Diagnósticos" 
        :headers="['Nome']" 
        :rows="$diagnostics" 
        :variables_DB="['name']"
        iteration="true"
        withSearchInput
        :search="$search"
        actionRoute="diagnostic">
    </x-table>

</x-app-layout>
