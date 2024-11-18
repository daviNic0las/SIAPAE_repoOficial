<x-app-layout>

    @if ($errors->any())
        <script>
            let errors = '';
            @foreach ($errors->all() as $error)
                errors += '{{ $error }}\n';
            @endforeach
            alert(errors); 
        </script>
    @endif

    <x-table title="Doações" :headers="['Nome', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']" :rows="$donations"
        :variables_DB="['name', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']"
        onlyHead iteration="true">

        @forelse ($donations as $donation)
            <tr data-id="{{$donation->id}}" id="tabela-gastos">

                <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                    {{ $loop->iteration }}
                </td>

                <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                    {{$donation->student ? $donation->student->name : 'Estudante não encontrado'}}
                </td>

                <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                        editable" data-field="Jan">
                    {{ $donation->Jan == '' ? '---' : number_format($donation->Jan, 2, ',', '.')}}

                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                        editable" data-field="Fev">
                    <div class="flex justify-center items-center" class="editable" data-field="Fev">
                        {{ $donation->Fev == '' ? '---' : number_format($donation->Fev, 2, ',', '.')}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                        editable" data-field="Mar">
                    <div class="flex justify-center items-center" class="editable" data-field="Mar">
                        {{ $donation->Mar == '' ? '---' : number_format($donation->Mar, 2, ',', '.')}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                        editable" data-field="Abr">
                    <div class="flex justify-center items-center" class="editable" data-field="Abr">
                        {{ $donation->Abr == '' ? '---' : number_format($donation->Abr, 2, ',', '.')}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                        editable" data-field="Mai">
                    <div class="flex justify-center items-center" class="editable" data-field="Mai">
                        {{ $donation->Mai == '' ? '---' : number_format($donation->Mai, 2, ',', '.')}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                        editable" data-field="Jun">
                    <div class="flex justify-center items-center" class="editable" data-field="Jun">
                        {{ $donation->Jun == '' ? '---' : number_format($donation->Jun, 2, ',', '.')}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                        editable" data-field="Jul">
                    <div class="flex justify-center items-center" class="editable" data-field="Jul">
                        {{ $donation->Jul == '' ? '---' : number_format($donation->Jul, 2, ',', '.')}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                        editable" data-field="Ago">
                    <div class="flex justify-center items-center" class="editable" data-field="Ago">
                        {{ $donation->Ago == '' ? '---' : number_format($donation->Ago, 2, ',', '.')}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                        editable" data-field="Set">
                    <div class="flex justify-center items-center" class="editable" data-field="Set">
                        {{ $donation->Set == '' ? '---' : number_format($donation->Set, 2, ',', '.')}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                        editable" data-field="Out">
                    <div class="flex justify-center items-center" class="editable" data-field="Out">
                        {{ $donation->Out == '' ? '---' : number_format($donation->Out, 2, ',', '.')}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                        editable" data-field="Nov">
                    <div class="flex justify-center items-center" class="editable" data-field="Nov">
                        {{ $donation->Nov == '' ? '---' : number_format($donation->Nov, 2, ',', '.')}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-2 py-1 text-center text-gray-800 dark:text-gray-300
                        editable" data-field="Dez">
                    <div class="flex justify-center items-center" class="editable" data-field="Dez">
                        {{ $donation->Dez == '' ? '---' : number_format($donation->Dez, 2, ',', '.')}}
                    </div>
                </td>
            </tr>

        @empty
            <tr class="text-center">
                <td class="p-3 font-normal dark:text-gray-300" colspan="{{ 14 }}">
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
                class: 'form-control m-0 w-16 border-gray-400 rounded-md dark:border-gray-600 dark:bg-dark-eval-1',
                type: 'text'
            });

            $(this).html(inputField);

            inputField.focus();

            // Quando o usuário sair da célula (blur)
            inputField.on('blur', function () {
                var newValue = $(this).val();
                if (newValue === '') { newValue = '---'; }
                var field = $(this).closest('td').data('field');
                var rowId = $(this).closest('tr').data('id');

                // Atualizando a célula para o novo valor
                
                $(this).closest('td').html(newValue);

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