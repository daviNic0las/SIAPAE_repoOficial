<x-app-layout>

    <x-table-edit 
        title="Aluno" 
        :elementEdit="$student" 
        :labelsVariablesTypes="[
            ['Nome do Aluno', 'name', 'text'],
            ['Data de Nascimento', 'date_of_birth', 'date'],
            ['Turma', 'class', 'text'],
            ['ID do Estudante', 'student_id', 'number'],
            ['Escola', 'school', 'text'],
            ['Diagnóstico', 'diagnostic_id', 'select'],
            ['Imagem do Estudante', 'image', 'file']
        ]" 
        :selects="$diagnostics" 
        onlyHead="false"
        actionRoute="student">
    </x-table-edit>

</x-app-layout>
