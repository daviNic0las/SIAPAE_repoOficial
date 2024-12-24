<x-app-layout>

    <x-table-show 
        :title="'Atendimento do ' . $attendance->student->name . ' - ' . $attendance->date" 
        :elementShow="$attendance" 
        :labelsVariables="[
            ['Nome do aluno', 'student.name'],
            ['Data do Relatório', 'date'],
            ['Assinatura do Professor Responsável', 'signature'],
            ['Eixo educacional trabalhado', 'educational_axis'],
            ['Avanços', 'advances'],
            ['Dificuldades', 'difficulties'],
        ]" 
        actionRoute="attendance"
        additional
        notEditDelete>

        <div class="flex items-center justify-between mt-5">
            <div>
                <x-button href="{{route('student.show', $attendance->student->id)}}" variant="blue">
                    <p class="dark:text-gray-200 px-2">
                        Ir para Aluno {{ \Illuminate\Support\Str::limit($attendance->student->name, 12)}}
                    </p>
                </x-button>
            </div>

            <div>
                <x-button href="{{route('attendance.edit', $attendance->id)}}" variant="warning"
                    title="Editar {{$attendance->student->name}}">
                    <p class="text-gray-900 px-2">
                        {{ __('Editar') }}
                    </p>
                </x-button>
    
                <form method="POST" action="{{ route('attendance.destroy', $attendance->id) }}" accept-charset="UTF-8"
                    style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
    
                    <x-button type="submit" variant="danger" title="Deletar {{$attendance->student->name}}" 
                        onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')">
                        <div class="text-gray-100 dark:text-gray-200 px-2">
                            {{ __('Deletar') }}
                        </div>
                    </x-button>
                </form>
            </div>
        </div>

    </x-table-show>

</x-app-layout>
