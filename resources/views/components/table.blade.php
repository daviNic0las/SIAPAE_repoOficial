{{--
$title: string que define o título da tabela.

$headers: Um array que contém os cabeçalhos das colunas da tabela. Exemplo: ['ID', 'Nome', 'Descrição', 'Data de
Criação'].

$rows: Um array que recebe os dados do Banco de dados, onde cada sub-array representa uma linha da tabela.

$variablesDB: Um array com o nomes da colunas que existem no banco de dados

$actionRoute (opcional): Contém a URL ou rota para onde o botão "Adicionar" deve redirecionar. ex:
route('dashboard')
--}}


<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden rounded-lg shadow-md dark:bg-dark-eval-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-xl font-bold leading-tight">Lista de {{ $title }}</h1>
                    @if($actionRoute)
                        <x-button onclick="goToUrl( '{{route($actionRoute . '.create')}}' )" variant="blue">
                            <div class="dark:text-gray-100">
                                Adicionar {{ rtrim($title, 's') }}
                            </div>
                        </x-button>
                    @endif
                </div>
                <hr class="border-gray-300 dark:border-gray-500" />

                <table class="min-w-full mt-4 border-collapse border border-gray-300 dark:border-gray-600">
                    <thead class="bg-blue-100 dark:bg-gray-700 dark:text-gray-200">
                        <tr>
                            @if($iteration == "true")
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center font-semibold">
                                    # </th>
                            @endif

                            @foreach($headers as $header)
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center font-semibold">
                                    {{ $header }}
                                </th>
                            @endforeach

                            @if($actionRoute)
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center font-semibold">
                                    Ações </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rows as $row)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-900 transition duration-300">

                                @if($iteration == "true")
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                @endif

                                @foreach ($variablesDB as $variable)

                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-2 py-3 text-center text-gray-800 dark:text-gray-300">
                                        @if ($variable == "date_of_birth")
                                            {{ \Carbon\Carbon::parse($row->date_of_birth)->format('d/m/Y') }}

                                        @elseif ($variable == "image")
                                            <div class="flex justify-center items-center">
                                                <img class="rounded-full w-12 h-12"
                                                    src="{{ asset('img/' . $actionRoute . '/' . $row->image) }}"
                                                    alt="Image not loaded">

                                            </div>

                                        @elseif ($variable == "diagnostic->name")
                                            {{ $row->diagnostic->name }}

                                        @else
                                            {{ $row->$variable }} <!-- Exibe o valor de forma normal (string) -->
                                        @endif
                                    </td>

                                @endforeach

                                @if($actionRoute)
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                        <x-button onclick="goToUrl( '{{route($actionRoute . '.edit', [$actionRoute => $row->id])}}' )"
                                            variant="warning">
                                            <p class="text-gray-900">
                                                {{ __('Editar') }}
                                            </p>
                                        </x-button>

                                        <form method="POST"
                                            action="{{ route($actionRoute . '.destroy', [$actionRoute => $row->id]) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}

                                            <x-button type="submit" variant="danger" title="Deletar diagnóstico">
                                                <div class="text-gray-100 dark:text-gray-200">
                                                    {{ __('Deletar') }}
                                                </div>
                                            </x-button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr class="text-center ">
                                <td class="p-3 font-bold" colspan="{{ count($headers) + ($actionRoute ? 2 : 0) }}">
                                    Nenhum registro encontrado.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>