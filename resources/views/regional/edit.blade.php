<x-app-layout>

    <x-table-edit 
        title="Relatório Regional" 
        :elementEdit="$regional" 
        :labelsVariablesTypes="[
            ['Data do Relatório', 'date', 'date'],
            ['Título do Relatório', 'title', 'text'],
            ['Subtítulo', 'subtitle', 'text'],
            ['Texto do Relatório', 'text', 'textarea'],
            ['Assinatura', 'signature', 'select'],
        ]" 
        :selectsWithName="$users"
        actionRoute="regional">
    </x-table-edit>

</x-app-layout>