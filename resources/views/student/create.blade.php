<x-app-layout>

    <x-table-create
        title="Aluno"
        :labelsVariablesTypes="[
            ['Nome do Aluno', 'name', 'text', 'Ex: João'],
            ['Data de Nascimento', 'date_of_birth', 'date', 'Ex: 01/01/2001'],
            ['Turma', 'class', 'text'],
            ['ID do Estudante', 'student_id', 'number'],
            ['Escola', 'school', 'text'],
            ['Diagnóstico', 'diagnostic_id', 'select'],
            ['Imagem do Estudante', 'image', 'file']
        ]"
        :selects="$diagnostics"
        onlyHead="false"
        actionRoute="student">
    </x-table-create>
    
</x-app-layout> 