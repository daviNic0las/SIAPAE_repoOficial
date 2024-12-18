<x-app-layout>

    <x-table-edit 
        title="Aluno - {{$student->name}}" 
        :elementEdit="$student" 
        onlyHead 
        actionRoute="student">

        <div class="mb-3">
            <label for="name" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Nome do Aluno:
            </label>
            <x-form.input id="name" type="text" name="name" value="{{ old('name', $student->name) }}"
                class="w-full dark:text-gray-400" placeholder="Ex: João" required />

            @error("name")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="grid grid-cols-3 mb-3">
            <div class="flex-1 pr-2">
                <label for="class_apae" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Selecione a Turma realizada na Apae:
                </label>
                <x-form.select full valueName="class_apae">
                    <option value=""> Turma: </option>

                    <option value="Segunda e Quarta" {{ old('class_apae', $student->class_apae) == 'Segunda e Quarta' ? 'selected' : '' }}>
                        Segunda e Quarta
                    </option>
                    <option value="Terça e Quinta" {{ old('class_apae', $student->class_apae) == 'Terça e Quinta' ? 'selected' : '' }}>
                        Terça e Quinta
                    </option>
                    <option value="Sexta" {{ old('class_apae', $student->class_apae) == 'Sexta' ? 'selected' : '' }}>
                        Sexta
                    </option>
                </x-form.select>
                @error("class_apae")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="pl-2">
                <label for="class_apae" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Selecione o Turno realizado na Apae:
                </label>
                <x-form.select valueName="turn_apae" full>
                    <option value=""> Turno: </option>

                    <option value="Manhã" {{ old('turn_apae', $student->turn_apae) == 'Manhã' ? 'selected' : '' }}>
                        Manhã
                    </option>
                    <option value="Tarde" {{ old('turn_apae', $student->turn_apae) == 'Tarde' ? 'selected' : '' }}>
                        Tarde
                    </option>
                </x-form.select>
                @error("turn_apae")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="date" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Data de Nascimento:
            </label>
            <x-form.input id="date" type="text" name="date_of_birth"
                value="{{ old('date_of_birth', $student->date_of_birth) }}"
                class="w-full dark:text-gray-400 date dateInput" placeholder="Ex: 01/01/2021" required />

            <span id="errorMessage" style="color: red; display: none;">Data inválida. Insira uma data entre
                1960 e 2200.</span>
            @error("date_of_birth")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="student_id" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                ID do Estudante:
            </label>
            <x-form.input id="student_id" type="text" name="student_id"
                value="{{ old('student_id', $student->student_id) }}" class="w-full dark:text-gray-400"
                placeholder="Ex: 2137981" required />

            @error("student_id")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="school" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Escola do Aluno:
            </label>
            <x-form.input id="school" type="text" name="school" value="{{ old('school', $student->school) }}"
                class="w-full dark:text-gray-400" placeholder="Ex: Benilce.." />

            @error("school")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="grid grid-cols-3 mb-3">
            <div class="pr-2">
                <label for="class_school" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Turma do Aluno na Escola:
                </label>
                <x-form.input id="class_school" type="text" name="class_school"
                    value="{{ old('class_school', $student->class_school) }}" class="w-full dark:text-gray-400"
                    placeholder="Ex: 21372" />

                @error("class_school")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div class="px-2">
                <label for="grade_school" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Série:
                </label>
                <x-form.input id="grade_school" type="text" name="grade_school"
                    value="{{ old('grade_school', $student->grade_school) }}" class="w-full dark:text-gray-400"
                    placeholder="Ex: 2º ano Fundamental" />

                @error("grade_school")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div class="pl-2">
                <label for="turn_school" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Turno do Aluno na Escola:
                </label>
                <x-form.select valueName="turn_school" full notRequired>
                    <option value=""> Turno: </option>

                    <option value="Manhã" {{ old('turn_school', $student->turn_school) == 'Manhã' ? 'selected' : '' }}>
                        Manhã
                    </option>
                    <option value="Tarde" {{ old('turn_school', $student->turn_school) == 'Tarde' ? 'selected' : '' }}>
                        Tarde
                    </option>
                </x-form.select>
                @error("turn_school")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="school" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Selecione um Diagnóstico:
            </label>
            <x-form.select valueName="diagnostic_id">
                <option value=""> Selecione o Diagnóstico: </option>

                @foreach ($diagnostics as $diagnostic)
                    <option value="{{ $diagnostic->id }}" {{ old('diagnostic_id', $student->diagnostic_id) == $diagnostic->id ? 'selected' : '' }}>
                        {{ $diagnostic->name }}
                    </option>
                @endforeach
            </x-form.select>

            @error("diagnostic_id")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3 mt-4">
            <div class="flex items-center">
                <x-form.button-image />

                <input id="file-upload" type="file" name="image" value="{{ old("image", $student->image) }}"
                    class="hidden" onchange="updateImageLabel(event) updateImagePreview(event)">

                <p id="label-image" class="ml-2 text-gray-700 dark:text-gray-500">
                    Nenhuma Nova Imagem Selecionada (*opcional)
                </p>
            </div>

            <img id="image-preview" class="rounded-full w-32 h-32 imagemfulera"
                src="{{ asset('img/student/' . $student->image) }}" alt=".">

            @error("image")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>


    </x-table-edit>

</x-app-layout>