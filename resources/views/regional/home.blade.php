<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-2xl font-bold leading-tight pt-2">
                {{ __('Lista dos Relatórios Regionais') }}
            </h2>
        </div>
    </x-slot>

    <x-table 
        title="Relatório Regional" 
        :headers="['Date', 'Title', 'Subtitle', 'Text', 'Signature']" 
        :rows="$regionals" 
        :variables_DB="['date', 'title', 'subtitle', 'text', 'signature']"
        iteration="false"
        withSearchSelect
        :years="$years"
        :year="$year"
        withShow
        actionRoute="regional">
    </x-table>
 
</x-app-layout>