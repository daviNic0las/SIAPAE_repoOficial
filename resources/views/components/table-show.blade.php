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
                    <h1 class="text-xl font-bold leading-tight">Informações do(a) {{ $title }} </h1>

                    @if(isset($actionRoute))
                        <x-button href="{{route($actionRoute . '.index')}}" variant="primary">
                            <p class="text-white">
                                Voltar
                            </p>
                        </x-button>
                    @endif
                </div>
                <hr class="border-gray-300 dark:border-gray-500" />

                <div class="min-w-full mt-4">
                    <div id="body">
                        @if (isset($onlyHead) == 0)

                            @if (isset($divisionLateral))
                                @php        
                                    $chunkedItems = array_chunk($labelsVariables, $quantLateral); // Divide a coleção em pedaços de 3 itens cada 
                                @endphp

                                <div class="flex">
                                    <!-- Div esquerda -->
                                    <div class="flex-1 pr-4">
                                        @foreach ($chunkedItems[0] as $item)
                                            <p class="py-2 dark:text-gray-400 text-gray-700">
                                                {{ $item[0] }}:
                                            </p>

                                            <p class="border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 
                                                font-normal dark:text-gray-300 py-2 px-3 rounded-lg">
                                                @if ($item[1] == "price")
                                                    {{ 'R$ ' . number_format($elementShow->{$item[1]}, 2, ',', '.') }}
                                                @elseif ($item[1] == "date_of_birth")
                                                    {{ \Carbon\Carbon::parse($elementShow->{$item[1]})->format('d/m/Y') }}
                                                @elseif ($item[1] == "diagnostic_id")    
                                                    {{$elementShow->diagnostic->name ?? 'Sem Diagnóstico'}}
                                                @else
                                                    {{ data_get($elementShow, $item[1]) ?? 'Campo não Registrado'}}
                                                @endif
                                            </p>
                                        @endforeach
                                    </div>

                                    <!-- Linha divisória -->
                                    <div class="self-stretch border-l border-gray-300 dark:border-gray-600 border-1"></div>

                                    <!-- Div direita -->
                                    <div class="flex-1 pl-4">
                                        @foreach ($chunkedItems[1] as $item)
                                            <p class="py-2 dark:text-gray-400 text-gray-700">
                                                {{ $item[0] }}:
                                            </p>

                                            <p class="border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 
                                                font-normal dark:text-gray-300 py-2 px-3 rounded-lg">
                                                @if ($item[1] == "price")
                                                    {{ 'R$ ' . number_format($elementShow->{$item[1]}, 2, ',', '.') }}
                                                @elseif ($item[1] == "date_of_birth")
                                                    {{ \Carbon\Carbon::parse($elementShow->{$item[1]})->format('d/m/Y') }}
                                                @else
                                                    {{ data_get($elementShow, $item[1]) ?? 'Campo não Registrado'}}
                                                @endif
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            @else

                                @foreach ($labelsVariables as $item)
                                    <p class="py-2 dark:text-gray-400 text-gray-700">
                                        {{ $item[0] }}:
                                    </p>

                                    <p class="border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 
                                            font-normal dark:text-gray-300 py-2 px-3 rounded-lg">
                                        @if ($item[1] == "price")
                                            {{ 'R$ ' . number_format($elementShow->{$item[1]}, 2, ',', '.') }}
                                        @else
                                            {{ data_get($elementShow, $item[1]) ?? 'Campo não Registrado'}}
                                        @endif
                                    </p>
                                @endforeach

                            @endif

                        @else
                            {{$slot}}
                        @endif

                        @if(isset($additional))
                            {{$slot}}
                        @endif

                    </div>

                    <div>
                        @if(isset($actionRoute))
                            <div class="py-2 flex items-center justify-between mt-4">
                                <x-button
                                    href="{{route($actionRoute . '.edit', [$actionRoute => $elementShow->id])}}"
                                    variant="warning">
                                    <p class="text-gray-900 px-2">
                                        {{ __('Editar') }}
                                    </p>
                                </x-button>

                                <form method="POST"
                                    action="{{ route($actionRoute . '.destroy', [$actionRoute => $elementShow->id]) }}"
                                    accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}

                                    <x-button type="submit" variant="danger" title="Deletar diagnóstico"
                                        onclick="deleteConfirm(event)">
                                        <div class="text-gray-100 dark:text-gray-200 px-2">
                                            {{ __('Deletar') }}
                                        </div>
                                    </x-button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
