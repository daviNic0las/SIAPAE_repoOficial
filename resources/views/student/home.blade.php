<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-2xl font-bold leading-tight">
                {{ __('Lista de Estudantes') }}
            </h2>
        </div>
    </x-slot>

    <x-table 
        title="Aluno" 
        :headers="['Nome', 'Data Nasc.', 'ID do Aluno', 'Escola', 'Diagnóstico', 'Foto']" 
        :rows="$students" 
        :variablesDB="['name', 'date_of_birth', 'student_id', 'school', 'diagnostic.name', 'image']"
        iteration="false"
        withSearchInput
        :search="$search"
        withShow
        actionRoute="student">
    </x-table>
    
</x-app-layout> 