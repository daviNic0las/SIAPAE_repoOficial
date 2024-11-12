<x-app-layout>

    <x-table 
        title="Doações" 
        :headers="['Nome', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']" 
        :rows="$donations" 
        :variables_DB="['name']"
        iteration="true"
        actionRoute="donation">
    </x-table>

</x-app-layout>