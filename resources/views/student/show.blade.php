<x-app-layout>

    <x-table-show 
        :title="$student->name" 
        :elementShow="$student" 
        :labelsVariables="[
        ['Nome do Aluno', 'name'],
        ['Data de Nascimento', 'date_of_birth'],
        ['ID do Aluno', 'student_id'],
        ['Escola', 'school'],
        ['Turma na Escola', 'class_school'],
        ['Turno na Escola', 'turn_school'],
        ['Série na Escola', 'grade_school'],
        ['Turma na Apae', 'class_apae'],
        ['Turno na Apae', 'turn_apae'],
        ['Diagnóstico', 'diagnostic_id']
        ]" additional 
        divisionLateral
        quantLateral="5"
        actionRoute="student">
        
        <p class="mt-4">Em Andamento</p>
         
    </x-table-show>

</x-app-layout>