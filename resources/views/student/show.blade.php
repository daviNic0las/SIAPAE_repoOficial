<x-app-layout>

    @php
        $state_student = '';
        if(isset($isArchived)) {
            $state_student = ' (Arquivado)';
        }
    @endphp

    <x-table-show 
        :title="'Informações do Aluno(a) ' . $student->name . $state_student" 
        :elementShow="$student" 
        :labelsVariables="[
        ['Nome do Aluno', 'name'],
        ['Data de Nascimento', 'date_of_birth'],
        ['ID do Aluno', 'student_id'],
        ['Escola', 'school'],
        ['Turma na Escola', 'class_school'],
        ['Turno na Escola', 'turn_school'],
        ['Série na Escola', 'grade_school'],
        ['Turma na Apae', 'class_apae'],
        ['Turno na Apae', 'turn_apae'],
        ['Diagnóstico', 'diagnostic.name']
        ]" additional 
        divisionLateral
        quantLateral="5"
        notEditDelete
        actionRoute="student"
        :isArchived="$isArchived">

        <hr class="my-4 border-gray-300 dark:border-gray-500" />

        <h1 class="text-xl font-bold leading-tight -mb-5">
            Registros de Atendimento do(a) {{$student->name}}
        </h1>

        <x-table
        title="Atendimento" 
        :headers="['Aluno', 'Date', 'Advances', 'Difficulties']" 
        :rows="$attendances" 
        :variables_DB="['student.name', 'date', 'advances', 'difficulties']"
        iteration="false"
        withSearchDateRange
        :element="$student"
        searchRoute="student.show"
        notButtonAdd
        :range="$date_range"
        withShow
        actionRoute="attendance">
        </x-table>

        @if (isset($scrollBack))
            <!-- Alvo para rolagem --> <div class="scroll-target"></div>
        @endif
        
        <div class="flex items-center justify-between">
            <div>
                @if (isset($medHistory))
                    <x-button href="{{route('anamnesis.show', $medHistory->id)}}" variant="blue">
                        <p class="dark:text-gray-200 px-2">
                            Ir para Anamnese do Aluno
                        </p>
                    </x-button>
                @else
                    <p class="text-gray-800 dark:text-gray-200"> 
                        Aluno não possui uma Anamnese
                    </p>
                @endif
            </div>

            <div>
                <x-button href="{{route('student.edit', $student->id)}}" variant="warning"
                    title="Editar {{$student->name}}">
                    <p class="text-gray-900 px-2">
                        {{ __('Editar') }}
                    </p>
                </x-button>
    
                @if (!isset($isArchived))
                <form method="POST" action="{{ route('student.archive', $student->id) }}" accept-charset="UTF-8"
                    style="display:inline">
                    {{ csrf_field() }}
    
                    <x-button type="submit" variant="primary" title="Arquivar {{$student->name}}" 
                        onclick="warningConfirm(event, 'Essa ação irá arquivar o item selecionado!', 'warning', 'Arquivar')">
                        <div class="text-gray-100 px-2">
                            {{ __('Arquivar') }}
                        </div>
                    </x-button>
                </form>
                @endif
            </div>
        </div>

        
         
    </x-table-show>

</x-app-layout>

<script>
    function scrollToSelector() { 
        const element = document.querySelector(".scroll-target"); 
        element.scrollIntoView({ behavior: 'smooth', }); 
    } 
    // Verificar a variável do Blade e rolar para o seletor se necessário 
    @if(isset($scrollBack)) 
        document.addEventListener('DOMContentLoaded', function () { 
            scrollToSelector(); 
        });
    @endif
</script>