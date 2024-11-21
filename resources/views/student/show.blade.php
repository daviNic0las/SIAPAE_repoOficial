<x-app-layout>

    <x-table-show 
        :title="$student->name" 
        :elementShow="$student" 
        :labelsVariables="[
        ['Nome do Aluno', 'name'],
        ['Data de Nascimento', 'date_of_birth'],
        ['Turma', 'class'],
        ['ID do Aluno', 'student_id'],
        ['Escola', 'school'],
        ['Diagnóstico', 'diagnostic_id']
    ]" additional 
    divisionLateral
    quantLateral="3"
    actionRoute="student">


    </x-table-show>

</x-app-layout>