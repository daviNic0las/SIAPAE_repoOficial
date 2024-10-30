<x-app-layout>

    <x-table 
        title="Diagnósticos" 
        :headers="['Nome']" 
        :rows="$diagnostics" 
        :variables_DB="['name']"
        iteration="true"
        actionRoute="diagnostic">
    </x-table>

</x-app-layout>