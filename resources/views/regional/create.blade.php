<x-app-layout> 

    <x-table-create
        title="Relatório Regional"
        :labelsVariablesTypes="[
            ['Data do Relatório', 'date', 'date'],
            ['Título do Relatório', 'title', 'text'],
            ['Subtítulo', 'subtitle', 'text'],
            ['Texto do Relatório', 'text', 'textarea'],
            ['Assinatura', 'signature', 'select'],
        ]" 
        :selectsWithName="$users"
        actionRoute="regional"/>
 
</x-app-layout> 