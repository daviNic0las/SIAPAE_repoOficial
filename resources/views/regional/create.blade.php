<x-app-layout> 

    <x-table-create
        title="Relatório Regional"
        :labelsVariablesTypes="[
            ['Título do Relatório', 'title', 'text'],
            ['Subtítulo', 'subtitle', 'text'],
            ['Texto do Relatório', 'text', 'text'],
            ['Assinatura', 'signature', 'select'],
            ['Data do Relatório', 'date', 'date'],
        ]" 
        :selects="$users"
        selectWithName
        actionRoute="regional"/>
 
</x-app-layout> 