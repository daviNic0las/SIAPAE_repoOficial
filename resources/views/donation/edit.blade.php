<x-app-layout> 
    
    <x-table-edit 
        title="Diagnóstico"
        :elementEdit="$diagnostic" 
        :labelsVariablesTypes="[
            ['Nome do Diagnóstico', 'name', 'text', 'Ex: Autismo']
        ]" 
        onlyHead="false"
        actionRoute="diagnostic"
    />

</x-app-layout> 
