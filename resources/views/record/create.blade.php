<x-app-layout> 

    <x-table-create
        title="Ata"
        :labelsVariablesTypes="[
            ['Nome da Ata', 'name', 'text'],
            ['Data de Criação', 'date', 'date'],
            ['Arquivo da Ata', 'file', 'file'],
        ]" 
        onlyHead="false"
        actionRoute="record"/>
 
</x-app-layout> 