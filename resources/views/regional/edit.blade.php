<x-app-layout>

    <x-table-edit 
        title="Relatório Regional" 
        :elementEdit="$regional" 
        :labelsVariablesTypes="[
            ['Título do Relatório', 'title', 'text'],
            ['Subtítulo', 'subtitle', 'text'],
            ['Texto do Relatório', 'text', 'textarea'],
            ['Data do Relatório', 'date', 'date'],
            ['Assinatura da Cordenadora Responsável', 'signature', 'select'],
        ]" 
        :selectsWithName="$coordinators"
        actionRoute="regional">
    </x-table-edit>

</x-app-layout>