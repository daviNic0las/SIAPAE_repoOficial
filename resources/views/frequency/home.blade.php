<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <h2 class="text-2xl font-bold leading-tight">
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
    
    <x-table 
    title="Frequência"
    :headers="array_merge(['Nome'], $days)"
    headersSmall
    :rows="$frequencies"
    onlyHead
    withSearchFrequency
    :class_apae="$class_apae_input"
    :turn_apae="$turn_apae_input"
    :monthYear="$monthYear"
    iteration="true">

        @forelse ($frequencies as $frequency)
        <tr data-id="{{$frequency->id}}" id="tabela-gastos">

            <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-800 dark:text-gray-300">
                {{ $loop->iteration }}
            </td>
            
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-800 dark:text-gray-300">
                {{$frequency->student_name ? \Illuminate\Support\Str::words($frequency->student_name, 1, ' ...') : 'Estudante não encontrado'}}
            </td>
        
            <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                editable" data-field="Jan">
                .....
            </td>
        </tr>

        @empty
        <tr class="text-center">
            <td class="border border-gray-300 dark:border-gray-600 p-3 font-normal dark:text-gray-300" colspan="{{ (int) $numberDaysInMonth + 2 }}">
                Nenhum registro encontrado.
            </td>
        </tr>
        @endforelse

    </x-table>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Quando o usuário clicar em uma célula para editar
        $('#tabela-gastos .editable').on('click', function () {
            var currentText = $(this).text();
            var inputField = $('<input>', {
                value: '',
                class: 'form-control m-0 w-20 border-gray-400 rounded-md dark:border-gray-600 dark:bg-dark-eval-1',
                type: 'text',
                oninput: 'maskMoedaSemRS(event)'
            });

            $(this).html(inputField);

            inputField.focus();

            // Quando o usuário sair da célula (blur)
            inputField.on('blur', function () {
                var newValue = $(this).val();
                if (newValue === '') { newValue = '---' }
                var field = $(this).closest('td').data('field');
                var rowId = $(this).closest('tr').data('id');

                // Atualizando a célula para o novo valor

                $(this).closest('td').html(newValue);

                if (newValue === '---') { newValue = '0.00' }
                if (newValue.includes(',')) { newValue = newValue.replace(',', '.'); }

                // Enviar a atualização via AJAX
                $.ajax({
                    url: '/donation/' + rowId,  // Rota para atualizar o gasto
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        field: field,
                        value: newValue
                    },
                    // success: function (response) {
                    //     alert('Gasto atualizado com sucesso!');
                    // },
                    // error: function () {
                    //     alert('Erro ao atualizar o gasto.');
                    // }
                });
            });
        });
    });
</script>