<x-app-layout>

    <x-table 
        title="Alunos" 
        :headers="['Nome', 'Data Nasc.', 'Turma', 'ID do Aluno', 'Escola', 'Diagnóstico', 'Foto']" 
        :rows="$students" 
        :variablesDB="['name', 'date_of_birth', 'class', 'student_id', 'school', 'diagnostic->name', 'image']"
        iteration="false"
        actionRoute="student">
    </x-table>
    
</x-app-layout> 