<x-app-layout>

    <x-table-edit 
        title="Registro de Atendimento" 
        :elementEdit="$attendance" 
        :labelsVariablesTypes="[
            ['Nome do aluno', 'student_id', 'select'],
            ['Data do Relatório', 'date', 'date'],
            ['Eixo educacional trabalhado', 'educational_axis', 'text'],
            ['Avanços', 'advances', 'textarea'],
            ['Dificuldades', 'difficulties', 'textarea'],
            ['Assinatura', 'signature', 'select'],
        ]" 
        :selects="$students"
        :selectsWithName="$users"
        actionRoute="attendance">
    </x-table-edit>

</x-app-layout>