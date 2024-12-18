<x-app-layout>

    <x-table-show 
        :title="'Relatório Regional ' . $regional->title" 
        :elementShow="$regional" 
        :labelsVariables="[
            ['Título', 'title'],
            ['Subtítulo', 'subtitle'],
            ['Texto do Relatório', 'text'],
            ['Data do Relatório', 'date'],
            ['Assinatura', 'signature'],
        ]" 
        actionRoute="regional">
    </x-table-show>

</x-app-layout>
