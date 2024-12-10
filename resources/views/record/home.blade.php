<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-2xl font-bold leading-tight">
                {{ __('Ata de Reuniões') }}
            </h2>
        </div>
    </x-slot>

    <x-table 
        title="Ata de Reunião" 
        :headers="['Nome', 'Data', 'Arquivo']" 
        :rows="$records" 
        :variables_DB="['name', 'date', 'file']"
        iteration="false"
        withSearchSelect
        :years="$years"
        :year="$year"
        actionRoute="record">
    </x-table>
 
</x-app-layout>