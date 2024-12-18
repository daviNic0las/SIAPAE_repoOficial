<x-app-layout>

    <x-table-show 
        :title="'Ata de Reunião - ' . $record->name" 
        :elementShow="$record" 
        :labelsVariables="[
            ['Nome da Ata', 'name'],
            ['Data', 'date'],
            ['Arquivo da Reunião', 'file'],
        ]" 
        filePath="file/record/"
        actionRoute="record">
    </x-table-show>

</x-app-layout>
