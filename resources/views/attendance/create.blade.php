<x-app-layout> 

    <x-table-create
        title="Registro de Atendimento"
        :labelsVariablesTypes="[
            ['Nome do aluno', 'student_id', 'select'],
            ['Data do Relatório', 'date', 'date'],
            ['Eixo educacional trabalhado', 'educational_axis', 'text'],
            ['Avanços', 'advances', 'text'],
            ['Dificuldades', 'difficulties', 'text'],
            ['Assinatura', 'signature', 'select'],
        ]" 
        :selects="$students"
        :selectsWithName="$users"
        actionRoute="attendance"/>
 
</x-app-layout>