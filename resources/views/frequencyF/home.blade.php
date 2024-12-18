<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-2xl font-bold leading-tight pt-2">
                {{ __('Lista de Frequência') }}
            </h2>
        </div>
    </x-slot>

    @if ($errors->any())
        <script>
            let errors = '';
            @foreach ($errors->all() as $error)
                errors += '{{ $error }}\n';
            @endforeach
            alert(errors); 
        </script>
    @endif

    @php
        $variablesSearchFrequency = $class_apae . '-' . $turn_apae . '-' . $monthYear;
    @endphp

    <x-table 
        title="Frequência"  
        :headers="array_merge(['Nome'], $days)" 
        headersSmall 
        :rows="$frequencies" 
        onlyHead
        withSearchFrequency 
        :variablesSearchFrequency="$variablesSearchFrequency" 
        iteration="true">

        @forelse ($frequencies as $frequency)
            <tr data-id="{{$frequency->id}}">

                <td
                    class="border border-gray-300 dark:border-gray-600 px-2 py-3 text-center text-gray-800 dark:text-gray-300">
                    {{ $loop->iteration }}
                </td>

                <td
                    class="border border-gray-300 dark:border-gray-600 px-2 py-3 text-center text-gray-800 dark:text-gray-300">
                    {{$frequency->student->name ? \Illuminate\Support\Str::limit($frequency->student->name, 12, ' ...') : 'Não encontrado'}}
                </td>

                @for ($day = 1; $day <= $numberDaysInMonth; $day++)
                    <td class="border border-gray-300 dark:border-gray-600 text-center">
                        <x-button
                            class="btn-toggle {{ $frequency->$day == 1 ? 'success bg-green-500 hover:bg-green-600 focus:ring-green-500' : 'danger bg-red-600 hover:bg-red-700 dark:bg-red-700 focus:ring-red-700' }}"
                            variant="{{ $frequency->$day == 1 ? 'success' : 'danger' }}" size="hyper-sm"
                            data-frequency="{{ $frequency->id }}" data-day="{{ $day }}">
                            <i class="fas {{ $frequency->$day == 1 ? 'fa-check -mx-0.5' : 'fa-times' }}"></i>
                        </x-button>
                    </td>
                @endfor

            </tr>

        @empty
            <tr class="text-center">
                <td class="border border-gray-300 dark:border-gray-600 p-3 font-normal dark:text-gray-300"
                    colspan="{{ (int) $numberDaysInMonth + 2 }}">
                    Nenhum registro encontrado.
                </td>
            </tr>
        @endforelse

    </x-table>
    
    <div class="py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden rounded-lg shadow-md dark:bg-dark-eval-1">
                <form action="{{route('frequency_details.update')}}" class="p-6" method="POST">
                    @csrf
                    <input type="hidden" name="frequencies" value="{{ json_encode($frequencies) }}">
                    <div>
                        <label for="observation" class="text-gray-800 dark:text-gray-200"> Observações: (*opcional)
                        </label>
                        <x-form.textarea name="observation" id="observation" class="h-32 mt-2" sizeFont="base"
                            placeholder="Ex: O Aluno *** faltou dia ** pois estava doente ....." 
                            data-observation="">
                            {{old('observation', $observation)}}
                        </x-form.textarea>
                    </div>

                    <div class="flex relative">
                        <div>
                            <label for="signature" class="text-gray-800 dark:text-gray-200"> Assinatura do Professor:
                            </label>
                            <br>
                            <x-form.select valueName="signature" idSelect="signature">
                                <option value="">Selecione o Nome:</option>

                                @foreach ($users as $user)
                                    <option value="{{$user->name}}" {{old('signature', $signature) == $user->name ? 'selected' : ''}}>
                                        {{$user->name}}
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>
                        <div class="ml-auto self-end">
                            <x-button>
                                Atualizar
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-toggle').click(function () {
            let frequencyId = $(this).data('frequency');
            let day = $(this).data('day');
            let statusAtual = $(this).hasClass('success') ? 1 : 0;

            // Alterna o status
            let novoStatus = statusAtual === 1 ? 0 : 1;
            // console.log(frequencyId +'  '+ statusAtual+ '  ' + novoStatus);

            // Realiza a requisição AJAX
            $.ajax({
                url: '/frequency/' + frequencyId,  // A URL que irá tratar a requisição
                method: 'PUT',
                data: {
                    frequencyId: frequencyId,
                    day: day,
                    status: novoStatus,
                    _token: '{{ csrf_token() }}',  // Protege contra CSRF
                },
                success: function (response) {
                    if (response.success) {
                        // Altera a classe e o ícone do botão com base no novo status
                        if (novoStatus === 1) {
                            $(`[data-frequency="${frequencyId}"][data-day="${day}"]`)
                                .removeClass('danger bg-red-600 hover:bg-red-700 dark:bg-red-700 focus:ring-red-700')
                                .addClass('success bg-green-500 hover:bg-green-600 focus:ring-green-500')
                                .find('i')
                                .removeClass('fa-times')
                                .addClass('fa-check -mx-0.5');
                        } else {
                            $(`[data-frequency="${frequencyId}"][data-day="${day}"]`)
                                .removeClass('success bg-green-500 hover:bg-green-600 focus:ring-green-500')
                                .addClass('danger bg-red-600 hover:bg-red-700 dark:bg-red-700 focus:ring-red-700')
                                .find('i')
                                .removeClass('fa-check -mx-0.5')
                                .addClass('fa-times');
                        }
                    } else {
                        alert('Erro ao atualizar a frequência.');
                    }
                }
            });
        });
    });
</script>
