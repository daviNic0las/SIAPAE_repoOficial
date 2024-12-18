<x-app-layout>

    <x-table-show 
        :title="'Relatório Pedagógico do ' . $pedagogical->student->name" 
        :elementShow="$pedagogical" 
        :labelsVariables="[
            ['Nome do aluno', 'student.name'],
            ['Data do Relatório', 'date_pedagogical'],
            ['Escola', 'school'],
            ['Turno na Escola', 'turn_school'],
            ['Série/Ano', 'grade_school'],
            ['Ano Letivo', 'school_year'],
            ['Assinatura do Professor da CAEE', 'professor_signature'],
            ['Texto do Relatório', 'text'],
            ['Assinatura', 'signature'],
        ]" 
        actionRoute="educational">
    </x-table-show>

</x-app-layout>
