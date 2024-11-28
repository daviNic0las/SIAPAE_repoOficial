<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-2xl font-bold leading-tight">
                {{ __('Lista dos Registros de Atendimento') }}
            </h2>
        </div>
    </x-slot>

    <x-table 
        title="Atendimentos" 
        :headers="['Aluno', 'Date', 'Educational axis', 'Advances', 'Difficulties', 'Signature']" 
        :rows="$attendances" 
        :variables_DB="['student->name', 'date', 'educational_axis', 'advances', 'difficulties', 'signature']"
        iteration="false"
        withSearchSelect
        :years="$years"
        :year="$year"
        withShow
        actionRoute="attendance">
    </x-table>
    
</x-app-layout>
