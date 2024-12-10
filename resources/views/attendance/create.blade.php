<x-app-layout> 

    <x-table-create
        title="Registro de Atendimento"
        :labelsVariablesTypes="[
            ['Nome do aluno', 'student_name', 'select'],
            ['Data do Relatório', 'date', 'date'],
            ['Eixo educacional trabalhado', 'educational_axis', 'text'],
            ['Avanços', 'advances', 'text'],
            ['Dificuldades', 'difficulties', 'text'],
            ['Assinatura', 'signature', 'select'],
        ]" 
        :selectsWithName="[$students, $users]"
        actionRoute="attendance"/>
 
</x-app-layout>