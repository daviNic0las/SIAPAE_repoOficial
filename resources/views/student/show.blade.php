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
        ['Diagnóstico', 'diagnostic.name']
        ]" additional 
        divisionLateral
        quantLateral="5"
        actionRoute="student">
        
        <div class="my-4">
            <h1 class="text-xl font-bold">
                Anamnese do Estudante:
            </h1>
        </div>

        
         
    </x-table-show>

</x-app-layout>