{{--
$title: string que define o título da tabela.

$headers: Um array que contém os cabeçalhos das colunas da tabela. Exemplo: ['ID', 'Nome', 'Descrição', 'Data de
Criação'].

$rows: Um array que recebe os dados do Banco de dados, onde cada sub-array representa uma linha da tabela.

$variablesDB: Um array com o nomes da colunas que existem no banco de dados

$actionRoute (opcional): Contém a URL ou rota para onde o botão "Adicionar" deve redirecionar. ex:
route('dashboard')

Tutorial de como resetar as senhas dos usuários:
passo 1: execute o comando "php artisan db:seed --class=TruncateUsersTableSeeder",
passo 2: execute o comando "php artisan db:seed",
passo 3: faça login em sua conta ,
passo 4: vá no perfil e no campo de redefinir senha, troque para uma senha pessoal.
--}}

<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden rounded-lg shadow-md dark:bg-dark-eval-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    @php
                        if (isset($search)) {
                            $search = 'Resultados para: ' . '"' . $search . '"';
                        } else {
                            $search = $title == 'Anamnese' ? 'Nome do Aluno p/ Anamnese' : 'Nome do ' . $title;
                        }
                    @endphp

                    @if (isset($withSearchInput))
                        <div id="search-container" class="flex items-center border border-gray-400 rounded-lg focus:border-gray-400 dark:border-gray-600 dark:bg-dark-eval-1
                            dark:focus:ring-offset-dark-eval-1 overflow-hidden">
                            @php
                                $route = $actionRoute . '.index';
                                if(isset($searchArchive)) {
                                    $route = $actionRoute . '.deposit';
                                }
                                if(isset($adminSearch)) {
                                    $route = 'admin.index';
                                }
                            @endphp
                            <form action="{{ route($route) }}" method="GET">
                                <x-form.input type="text" id="search" name="search"
                                    class="form-control w-64 dark:text-gray-300" placeholder="{{$search}}" />

                                <button id="icone-search"
                                    class="px-2 bg-gray-500 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none -ml-3 transition duration-300">
                                    <x-icons.search />
                                </button>
                            </form>
                        </div>
                    @endif

                    @if (isset($withSearchSelect))
                        <form method="GET"
                            action="{{ route(isset($actionRoute) ? $actionRoute . '.index' : 'donation.index') }}">
                            <div class="form-group">
                                <x-form.select valueName="year" function="this.form.submit()">
                                    <option value="">Selecione o ano:</option>
                                    @foreach ($years as $yearItem)
                                        <option value="{{ $yearItem }}" {{ $year == $yearItem ? 'selected' : '' }}>{{ $yearItem }}
                                        </option>
                                    @endforeach
                                </x-form.select>
                            </div>
                        </form>
                    @endif

                    @if (isset($withSearchFrequency))
                        @php    
                            list($class_apae, $turn_apae, $monthYear) = explode('-', $variablesSearchFrequency);
                        @endphp

                        <form method="GET" action="{{route('frequency.index')}}" class="flex gap-x-2">
                            <div> 
                                <x-form.select valueName="class_apae" notRequired>
                                    <option value="">Classe do aluno</option>

                                    <option value="Segunda e Quarta" {{old('class_apae', $class_apae ?? '') == 'Segunda e Quarta' ? 'selected' : ''}}>Segunda e Quarta</option>
                                    <option value="Terça e Quinta" {{old('class_apae', $class_apae ?? '') == 'Terça e Quinta' ? 'selected' : ''}}>Terça e Quinta</option>
                                    <option value="Sexta" {{old('class_apae', $class_apae ?? '') == 'Sexta' ? 'selected' : ''}}>Sexta</option>
                                </x-form.select>
                                <x-form.select valueName="turn_apae" notRequired>
                                    <option value="">Turno do aluno</option>

                                    <option value="Manhã" {{old('turn_apae', $turn_apae ?? '') == 'Manhã' ? 'selected' : ''}}>Manhã</option>
                                    <option value="Tarde" {{old('turn_apae', $turn_apae ?? '') == 'Tarde' ? 'selected' : ''}}>Tarde</option>
                                </x-form.select> 

                                <x-form.input name="monthYear" placeholder="Mês/Ano" value="{{old('monthYear', $monthYear)}}"
                                    class="period-input form-control w-32 monthYear" /> 
                            </div>
                            <div> 
                                <x-button>
                                    <div class="text-gray-100 dark:text-gray-100 text-md"> Filtrar </div>
                                </x-button> 
                            </div>
                        </form>         
                    @endif

                    @if (isset($withSearchDateRange))
                        <div id="search-container" class="flex items-center border border-gray-400 rounded-lg focus:border-gray-400 dark:border-gray-600 dark:bg-dark-eval-1
                                        dark:focus:ring-offset-dark-eval-1 overflow-hidden">
                        <form method="GET" action="{{isset($searchRoute) ? route($searchRoute, $element->id) : route($actionRoute . '.index')}}" class="flex gap-x-2">
                            @php
                                if ($range) {
                                    $placeholderValue = 'Intervalo: ' . $range;
                                } else {
                                    $placeholderValue = 'Filtro para intervalo de Datas';
                                }
                            @endphp

                            <x-form.input class="date-range w-80 form-control text-gra-800 dark:text-gray-300" x-init="initFlatpickr" name="date_range" placeholder="{{$placeholderValue}}" />     
                            
                            <button id="icone-search"
                                class="px-2 bg-gray-500 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none -ml-3 transition duration-300">
                                <x-icons.search />
                            </button>
                        </form>
                        </div>
                    @endif

                    <div class="flex gap-x-2">
                        @if (isset($withExport))
                            <x-button href="{{route($actionRoute . '.export')}}" variant="success" class="gap-x-2">
                                <x-icons.excel-icon />
                            
                                <div class="dark:text-gray-100">
                                    Exportar
                                </div>
                            </x-button>
                        @endif

                        @if(isset($actionRoute) && !isset($notButtonAdd) && !isset($actionsDeposit))
                            <x-button href="{{route($actionRoute . '.create')}}" variant="blue">
                                <div class="dark:text-gray-100">
                                    Adicionar {{$title}}
                                </div>
                            </x-button>
                        @endif
                    </div>
                </div>

                <hr class="border-gray-300 dark:border-gray-500" />

                <table class="min-w-full mt-4 border-collapse border border-gray-300 dark:border-gray-800">
                    <thead class="bg-blue-100 dark:bg-gray-700 dark:text-gray-200">
                        <tr>
                            @if($iteration == "true")
                                <th
                                    class="border border-gray-300 dark:border-gray-600 {{isset($headersSmall) ? 'px-1 py-1' : 'px-4 py-2'}} text-center font-semibold">
                                    # 
                                </th>
                            @endif

                            @foreach($headers as $header)
                                <th
                                    class="border border-gray-300 dark:border-gray-600 {{isset($headersSmall) ? 'px-1 py-1' : 'px-4 py-2'}} text-center font-semibold">
                                    {{ __($header) }}
                                </th>
                            @endforeach

                            @if(isset($actionRoute) && !isset($notActions))
                                <th
                                    class="border border-gray-300 dark:border-gray-600 {{isset($headersSmall) ? 'px-1 py-1' : 'px-4 py-2'}} text-center font-semibold">
                                    Ações 
                                </th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>

                        @if (!isset($onlyHead))
                            @forelse ($rows as $row)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-900 {{ isset($withShow) ? 'cursor-pointer' : ''}} transition duration-300"
                                    @if(isset($withShow)) onclick="show('{{route($actionRoute . '.show', $row->id)}}')" @endif>

                                    @if($iteration == "true")
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                            {{ ($rows->currentPage() - 1) * $rows->perPage() + $loop->iteration }}
                                        </td>
                                    @endif

                                    @foreach ($variablesDB as $variable)
                                        <td
                                            class="border border-gray-300 dark:border-gray-600 px-2 py-3 text-center text-gray-800 dark:text-gray-300">
                                            @if ($variable == "date_of_birth" || $variable == "date_of_emission" || $variable == "date" || $variable == "date_of_anamnesis" || $variable == "date_pedagogical")
                                                {{ \Carbon\Carbon::parse($row->{$variable})->format('d/m/Y') }}

                                            @elseif ($variable == "image")
                                                <div class="flex justify-center items-center">
                                                    <img class="rounded-full w-10 h-10"
                                                        src="{{ asset('img/' . $actionRoute . '/' . $row->image) }}"
                                                        alt="Image not loaded">

                                                </div>

                                            @elseif ($variable == "price")
                                                <div class="flex justify-center items-center">
                                                    {{ 'R$ ' . number_format($row->{$variable}, 2, ',', '.') }}
                                                </div>

                                            @elseif ($variable == "file")
                                                @if ($actionRoute == 'record')
                                                    <a href="{{ asset('file/record/' . $row->file) }}" target="_blank"
                                                        class="text-blue-500 underline">{{$row->file}}</a>
                                                @else
                                                    {{ $row->file }}
                                                @endif
                                            @else
                                                {{ \Illuminate\Support\Str::limit(data_get($row, $variable) ?? '------', $strLimit ?? 15) }}
                                                <!-- Exibe o valor com limitação de tamanho e caso não exista coloque '-----' -->
                                            @endif
                                        </td>

                                    @endforeach

                                    @if(isset($actionRoute))
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center"
                                            onclick="event.stopPropagation();">

                                            @if (isset($actionsDeposit))
                                            <form action="{{route($actionRoute . '.restore', $row->id)}}" method="POST"
                                                onclick="warningConfirm(event, 'Quer restaurar esse Registro?', 'question', 'Restaurar')">
                                                @csrf
                                                <x-button title="Restaurar esse {{$title}}" variant="restore" size="sm">
                                                    <x-icons.restore />
                                                </x-button>
                                            </form>

                                            @else
                                            <x-button href="{{route($actionRoute . '.edit', $row->id)}}" title="Editar {{$title}}" variant="edit" size="sm">
                                                <x-icons.edit />
                                            </x-button>

                                            @if (!isset($archiveInsteadDestroy))
                                            <form method="POST" action="{{ route($actionRoute . '.destroy', $row->id) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}

                                                <x-button variant="trash" title="Deletar {{$title}}" size="sm"
                                                    onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')">
                                                    <x-icons.trash />
                                                </x-button>
                                            </form>
                                            @else
                                            <form method="POST" action="{{ route($actionRoute . '.archive', $row->id) }}"
                                                accept-charset="UTF-8" style="display:inline" >
                                                {{ csrf_field() }}
                                                @php
                                                    if(isset($notArchiveAdmin)) {
                                                        $hidden = null;
                                                        if($row['access_level'] == 'admin') {
                                                            $hidden = "hidden";
                                                        } 
                                                    }
                                                @endphp

                                                <x-button variant="edit" title="Arquivar {{$title}}" size="sm" class="{{isset($notArchiveAdmin) ? $hidden : ''}}"
                                                    onclick="warningConfirm(event, 'Essa ação irá arquivar o item selecionado!', 'warning', 'Arquivar')">
                                                    <x-icons.archive />
                                                </x-button>
                                            </form>
                                            @endif
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr class="text-center ">
                                    <td class="p-3 font-normal dark:text-gray-300 border border-gray-300 dark:border-gray-600"
                                        colspan="{{ count($headers) + (isset($actionRoute) ? 2 : 0) }}">
                                        Nenhum registro encontrado.
                                    </td>
                                </tr>
                            @endforelse

                        @else
                            {{ $slot }}
                        @endif

                    </tbody>
                </table>

                @if ($rows->count() > 15)
                    <hr class="border-gray-300 dark:border-gray-500 mt-4" />
                @endif
                <div class="pagination mt-4">
                    {{ $rows->links() }}
                </div>

            </div>
        </div>
    </div>
</div>