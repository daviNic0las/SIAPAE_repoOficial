{{--
$title: string que define o título da tabela.

$elementEdit: "Entidade" que vai ser editada no banco de dados
Ex: $student = Student:findOrFail($id); (<- no controller)

$labelsVariablesTypes: Um array de arrays que contém respectivamente o label, nome na tabela e o tipo do input de um determinado item
ex: [['Nome do Aluno', 'name', 'text'], ['..','..','....'], ..]
$itens[0] -> Label para o campo
$itens[1] -> Nome do campo na Database
$itens[2] -> Type do input

$actionRoute: Contém a URL ou rota para onde o botão "Adicionar" deve redirecionar. ex:
route('dashboard')
--}}

<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden rounded-lg shadow-md dark:bg-dark-eval-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold leading-tight">Editar {{ $title }}</h1>

                    <x-button href="{{ route($actionRoute . '.index') }}" variant="warning">
                        <p class="text-gray-900">
                            Voltar
                        </p>
                    </x-button>
                </div>
                <hr class="border-gray-300 dark:border-gray-500" />

                @if (session()->has('error'))
                    <div class="text-red-600 dark:text-red-400">
                        {{ session('error') }}
                    </div>
                @endif

                <form id="dateForm" action="{{ route($actionRoute . '.update', $elementEdit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if (isset($onlyHead) == 0)

                    @foreach ($labelsVariablesTypes as $itens)
                        <div class="mb-3">
                            <label for="{{ $itens[1] }}"
                                class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                                {{ $itens[0] }}:
                            </label>

                            @if($itens[2] != "select" && $itens[2] != "file")

                                <x-form.input id="{{ $itens[1] }}" type="{{ $itens[2] != 'date' ? $itens[2] : 'text' }}" name="{{ $itens[1] }}"
                                    value="{{ old($itens[1], $elementEdit->{$itens[1]}) }}" class="w-full dark:text-gray-400                                    
                                    {{ ($itens[2] ?? '') === 'date' ? 'date dateInput' : '' }}" 
                                    placeholder="{{ isset($itens[3]) ? $itens[3] : $itens[0] }}" required />

                                @if($itens[2] == 'date')
                                    <span id="errorEditMessage" style="color: red; display: none;">Data inválida. Insira uma data entre 1960 e 2200.</span>
                                @endif

                            @elseif($itens[2] == "select")
                                
                            @if($itens[0] == "Assinatura")
                                    <x-form.select valueName="{{ $itens[1] }}">
                                        <option value=""> Selecione um {{ $itens[0] }} </option>
                                        @foreach ($selectsWithName as $select)
                                            <option value="{{ $select->name }}" {{ (old($itens[1], $elementEdit->{$itens[1]}) == $select->name) ? 'selected' : '' }}>
                                                {{ $select->name }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                            @else
                                    <x-form.select valueName="{{ $itens[1] }}">
                                        <option value=""> Selecione um {{ $itens[0] }} </option>
                                        @foreach ($selects as $select)
                                            <option value="{{ $select->id }}" {{ (old($itens[1], $elementEdit->{$itens[1]}) == $select->id) ? 'selected' : '' }}>
                                                {{ $select->name }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                            @endif

                            @elseif($itens[2] == "file")
                                <div class="flex items-center">
                                    <x-form.button-image />

                                    <input id="file-upload" type="file" name="{{ $itens[1] }}" value="{{ old($itens[1], $elementEdit->{$itens[1]}) }}" 
                                    class="hidden" onchange="updateImagePreview(event); updateImageLabel(event)">

                                    <p id="label-image" class="ml-2 text-gray-700 dark:text-gray-500">
                                        {{ old($itens[1], $elementEdit->{$itens[1]}) }}
                                    </p>
                                </div>

                                <img id="image-preview" class="rounded-full w-32 h-32 imagemfulera" src="{{ asset('img/' . $actionRoute . '/' . $elementEdit->{$itens[1]}) }}" alt=".">
                            @else
                                <p> O campo escolhido não existe no componente </p>
                            @endif

                            @error($itens[1])
                                <span class="text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach

                    @else
                        {{ $slot }}
                    @endif   

                    <div>
                        <x-button type="submit" variant="blue" class="w-full mt-2">
                            <p class="text-center w-full"> Atualizar </p>
                        </x-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    if (document.getElementById('dateInput')) {
        document.getElementById('dateForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const dateInput = document.getElementById('dateInput');
            const dateFormated = \Carbon\Carbon::createFromFormat('d/m/Y', dateInput)->format('Y-m-d');
            const errorMessage = document.getElementById('errorMessage');
            const dateValue = new Date(dateFormated.value);
            const minDate = new Date('1960-01-01');
            const maxDate = new Date('2200-12-31');

            if (dateValue < minDate || dateValue > maxDate || isNaN(dateValue)) {
                errorMessage.style.display = 'inline';
                return; // Previne o envio do formulário se a data for inválida
            } else {
                errorMessage.style.display = 'none';
                this.submit();
            }
            // Se não houver campo de data ou a data for válida, envie o formulário
            this.submit();
        })
    };
</script>


{{-- ATENÇÃO:   
A máscara que eu coloquei para um input do tipo data só funciona se o type do input for text
então no controller vc vai precisar converter esse dado no controller, sendo necessário ajeitar o edit() e o update() 
public function edit($id) {
        $student = Student::findOrFail($id);
        //Formatando a data que está em Y-m-d para d/m/Y, pois estou usando um input type text pra data
        $student['date_of_birth'] = \Carbon\Carbon::createFromFormat('Y-m-d', $student['date_of_birth'])->format('d/m/Y');
}
public function update(....) {
        $data = $request->validated();

        // Convert string to data
        $data['date_of_birth'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_of_birth'])->format('Y-m-d');
    }
--}}