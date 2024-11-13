<x-app-layout>

    <x-table 
        title="Gastos" 
        :headers="['Data de Emissão', 'Tipo', 'Número Nota', 'Empresa', 'Descrição', 'Valor']" 
        :rows="$expenses" 
        :variables_DB="['date_of_emission', 'type', 'fiscal_number', 'enterprise', 'description', 'price']"
        iteration="false"
        withShow
        actionRoute="expense">
    </x-table>

</x-app-layout>