<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-2xl font-bold leading-tight">
                {{ __('Lista dos Relatórios Regionais') }}
            </h2>
        </div>
    </x-slot>

    <x-table 
        title="Relatório Regional" 
        :headers="['Title', 'Subtitle', 'Text', 'Signature', 'Date']" 
        :rows="$regionals" 
        :variables_DB="['title', 'subtitle', 'text', 'signature', 'date']"
        iteration="false"
        withSearchSelect
        :years="$years"
        :year="$year"
        actionRoute="regional">
    </x-table>
 
</x-app-layout>