<x-app-layout>

    <x-table-edit 
        title="Aluno" 
        :elementEdit="$student" 
        :labelsVariablesTypes="[
            ['Nome do Aluno', 'name', 'text'],
            ['Data de Nascimento', 'date_of_birth', 'date'],
            ['Turma', 'class', 'text'],
            ['ID do Estudante', 'student_id', 'number'],
            ['Escola', 'school', 'text'],
            ['Diagnóstico', 'diagnostic_id', 'select'],
            ['Imagem do Estudante', 'image', 'file']
        ]" 
        :selects="$diagnostics" 
        actionRoute="student">
    </x-table-edit>

</x-app-layout>

<!-- 
<script>
    const mascaraMoeda = (event) => {
        const onlyDigits = event.target.value
            .split("")
            .filter(s => /\d/.test(s))
            .join("")
            .padStart(3, "0")
        const digitsFloat = onlyDigits.slice(0, -2) + "." + onlyDigits.slice(-2)
        event.target.value = maskCurrency(digitsFloat)
    }

    const maskCurrency = (valor, locale = 'pt-BR', currency = 'BRL') => {
        return new Intl.NumberFormat(locale, {
            style: 'currency',
            currency
        }).format(valor)
    }
</script> -->