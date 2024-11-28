<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-2xl font-bold leading-tight">
                {{ __('Lista de Anamneses') }}
            </h2>
        </div>
    </x-slot>

    <x-table title="Anamneses" 
        :headers="['Nome', 'Data Anamnese', 'ID do Aluno', 'Nome da Mãe', 'Diagnóstico']"
        :rows="$medHistories" 
        :variablesDB="['student.name', 'date_of_anamnesis', 'student.student_id', 'name_mother', 'student.diagnostic.name']" 
        iteration="false" 
        withSearchInput
        :search="$search"
        withShow
        actionRoute="anamnesis">
    </x-table>

</x-app-layout>