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
                    {{-- <h1 class="text-xl font-bold leading-tight">Lista de {{ $title }} </h1> --}}

                    @php
                        $ultimaPalavra = last(explode(' ', $title)); // Pega a última palavra da frase
                        // Se a última palavra terminar com "ões", substitui por "ão"
                        if (preg_match('/ões$/', $ultimaPalavra)) {
                            $frase = preg_replace('/ões$/', 'ão', $title);
                        }
                        // Se a última palavra terminar com "s", remove o "s"
                        elseif (preg_match('/s$/', $ultimaPalavra)) {
                            $frase = rtrim($title, 's');
                        }

                        if (isset($search)) {
                            $search = 'Resultados para: ' . '"' . $search . '"';
                        } else {
                            $search = $frase == 'Anamnese' ? 'Nome do Aluno' : 'Nome do ' . $frase;
                        }
                    @endphp

                    @if (isset($withSearchInput))
                        <div id="search-container" class="flex items-center border border-gray-400 rounded-lg focus:border-gray-400 dark:border-gray-600 dark:bg-dark-eval-1
                                    dark:focus:ring-offset-dark-eval-1 overflow-hidden">
                            <form action="{{ route($actionRoute . '.index') }}" method="GET">
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
                            action="{{ route(isset($actionRoute) == 1 ? $actionRoute . '.index' : 'donation.index') }}">
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

                    @if(isset($actionRoute))
                        <x-button href="{{route($actionRoute . '.create')}}" variant="blue">
                            <div class="dark:text-gray-100">
                                Adicionar {{$frase}}
                            </div>
                        </x-button>
                    @endif
                </div>

                <hr class="border-gray-300 dark:border-gray-500" />

                <table class="min-w-full mt-4 border-collapse border border-gray-300 dark:border-gray-800">
                    <thead class="bg-blue-100 dark:bg-gray-700 dark:text-gray-200">
                        <tr>
                            @if($iteration == "true")
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center font-semibold">
                                    # </th>
                            @endif

                            @foreach($headers as $header)
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center font-semibold">
                                    {{ __($header) }}
                                </th>
                            @endforeach

                            @if(isset($actionRoute))
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center font-semibold">
                                    Ações </th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>

                        @if (!isset($onlyHead))
                            @forelse ($rows as $row)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-900 {{ isset($withShow) ? 'cursor-pointer' : ''}} transition duration-300"
                                    @if(isset($withShow))
                                    onclick="show('{{route($actionRoute . '.show', [$actionRoute => $row->id])}}')" @endif>

                                    @if($iteration == "true")
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                            {{ ($rows->currentPage() - 1) * $rows->perPage() + $loop->iteration }}
                                        </td>
                                    @endif

                                    @foreach ($variablesDB as $variable)
                                        <td
                                            class="border border-gray-300 dark:border-gray-600 px-2 py-3 text-center text-gray-800 dark:text-gray-300">
                                            @if ($variable == "date_of_birth" || $variable == "date_of_emission" || $variable == "date")
                                                {{ \Carbon\Carbon::parse($row->{$variable})->format('d/m/Y') }}

                                            @elseif ($variable == "image")
                                                <div class="flex justify-center items-center">
                                                    <img class="rounded-full w-12 h-12"
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

                                            @elseif ($variable == "diagnostic->name")
                                                {{ \Illuminate\Support\Str::limit($row->diagnostic->name == '' ? 'Sem Diagnóstico' : $row->diagnostic->name, 15) }}

                                            @elseif ($variable == "student->diagnostic->name")
                                                {{ \Illuminate\Support\Str::limit($row->student->diagnostic->name == '' ? 'Sem Diagnóstico' : $row->student->diagnostic->name, 15) }}
                                            @else
                                                {{ \Illuminate\Support\Str::limit($row->$variable ?? '------', 12) }}
                                                <!-- Exibe o valor com limitação de tamanho e caso não exista coloque '-----' -->
                                            @endif
                                        </td>

                                    @endforeach

                                    @if(isset($actionRoute))
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center"
                                            onclick="event.stopPropagation();">
                                            <x-button href="{{route($actionRoute . '.edit', [$actionRoute => $row->id])}}"
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

                                                <x-button variant="danger" title="Deletar diagnóstico"
                                                    onclick="deleteConfirm(event)">
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

                @if ($rows->count() > 10)
                    <hr class="border-gray-300 dark:border-gray-500 mt-4" />
                @endif
                <div class="pagination mt-4">
                    {{ $rows->links() }}
                </div>

            </div>
        </div>
    </div>
</div>