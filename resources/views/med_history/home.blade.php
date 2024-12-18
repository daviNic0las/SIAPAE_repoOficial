<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-2xl font-bold leading-tight pt-2">
                {{ __('Lista de Anamneses') }}
            </h2>
        </div>
    </x-slot>

    <x-table title="Anamnese" 
        :headers="['Nome', 'ID do Aluno', 'Diagnóstico', 'Data Anamnese', 'Assinatura']"
        :rows="$medHistories" 
        :variablesDB="['student.name', 'student.student_id', 'student.diagnostic.name', 'date_of_anamnesis', 'signature']" 
        iteration="false" 
        withSearchInput
        :search="$search"
        withShow
        actionRoute="anamnesis">
    </x-table>

</x-app-layout>