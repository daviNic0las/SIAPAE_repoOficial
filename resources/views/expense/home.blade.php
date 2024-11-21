<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold leading-tight">
                {{ __('Controle de Gastos') }}
            </h2>
        </div>
    </x-slot>

    <x-table 
        title="Gastos" 
        :headers="['Data de Emissão', 'Tipo', 'Número Nota', 'Empresa', 'Descrição', 'Valor']" 
        :rows="$expenses" 
        :variables_DB="['date_of_emission', 'type', 'fiscal_number', 'enterprise', 'description', 'price']"
        iteration="false"
        withShow
        withSearchSelect
        :years="$years"
        :year="$year"
        actionRoute="expense">
    </x-table>

</x-app-layout>