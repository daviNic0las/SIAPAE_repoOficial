<x-app-layout>
    <x-table-show 
        :title="$attendance->student->name" 
        :elementShow="$attendance" 
        :labelsVariables="[
            ['Nome do aluno', 'student.name', 'select'],
            ['Data do Relatório', 'date', 'date'],
            ['Assinatura', 'signature', 'select'],
            ['Eixo educacional trabalhado', 'educational_axis', 'text'],
            ['Avanços', 'advances', 'text'],
            ['Dificuldades', 'difficulties', 'text'],
        ]" 
        divisionLateral
        quantLateral="3"
        actionRoute="attendance">
    </x-table-show>
</x-app-layout>
