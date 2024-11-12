<x-app-layout>

    <x-table-edit 
        title="Ata" 
        :elementEdit="$record" 
        :labelsVariablesTypes="[
            ['Nome da Ata', 'name', 'text'],
            ['Data de Criação', 'date', 'date'],
            ['Arquivo da Ata', 'file', 'file']
        ]" 
        :selects="$record" 
        onlyHead="false"
        actionRoute="record">
    </x-table-edit>

</x-app-layout>