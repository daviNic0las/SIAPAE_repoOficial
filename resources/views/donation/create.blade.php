<x-app-layout> 

    <x-table-create
        title="Diagnóstico"
        :labelsVariablesTypes="[
            ['Diagnóstico do Aluno', 'name', 'text', 'Ex: Autismo']
        ]" 
        onlyHead="false"
        actionRoute="diagnostic"/>

</x-app-layout> 
