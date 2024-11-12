<x-app-layout>

    <x-table 
        title="Ata de Reuniões" 
        :headers="['Nome', 'Data', 'Arquivo']" 
        :rows="$records" 
        :variables_DB="['name', 'date', 'file']"
        iteration="false"
        onlyHead="false"
        actionRoute="record">
    </x-table>
 
</x-app-layout>