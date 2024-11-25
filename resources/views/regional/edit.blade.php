<x-app-layout>

    <x-table-edit 
        title="Relatório Regional" 
        :elementEdit="$regional" 
        :labelsVariablesTypes="[
            ['Título do Relatório', 'title', 'text'],
            ['Subtítulo', 'subtitle', 'text'],
            ['Texto do Relatório', 'text', 'text'],
            ['Assinatura', 'signature', 'select'],
            ['Data do Relatório', 'date', 'date'],
        ]" 
        :selects="$users"
        selectWithName
        actionRoute="regional">
    </x-table-edit>

</x-app-layout>