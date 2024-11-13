<x-app-layout> 
    
    <x-table-edit 
        title="Diagnóstico"
        :elementEdit="$diagnostic" 
        :labelsVariablesTypes="[
            ['Nome do Diagnóstico', 'name', 'text', 'Ex: Autismo']
        ]" 
        actionRoute="diagnostic"
    />

</x-app-layout> 
