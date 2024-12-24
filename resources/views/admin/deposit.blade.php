<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">
            <h2 class="text-2xl font-bold leading-tight pt-2">
                {{ __('Lista dos Usuários Arquivados') }}
            </h2>
            <x-button href="{{route('admin.index')}}" class="justify-center gap-2" variant="edit" bg="bg-gray-100 dark:bg-dark-eval-0">
                <x-icons.person class="w-6 h-6 dark:text-gray-300 -ml-1" aria-hidden="true" />

                <span>{{ __('Voltar') }}</span>
            </x-button>
        </div>
    </x-slot>

    <x-table 
        title="Aluno Arquivado" 
        :headers="['Nome', 'Email', 'Profissão', 'Acesso']" 
        :rows="$users" 
        :variablesDB="['name', 'email', 'position', 'access_level']"
        iteration="false"
        withSearchInput
        searchArchive
        :search="$search"
        withShow
        actionRoute="admin"
        actionsDeposit>
    </x-table>
    
</x-app-layout> 