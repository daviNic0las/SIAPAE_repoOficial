<x-app-layout>

    <x-table-edit 
        title="atendimento do Aluno - {{$pedagogical->student->name}}" 
        :elementEdit="$pedagogical" 
        onlyHead 
        actionRoute="educational">
    
        <div class="my-3 grid grid-cols-2 gap-x-4">
            <div>
                <x-form.label for="student_id"> Nome do Estudante para o Relatório </x-form.label>
                <x-form.select idSelect="student_id" valueName="student_id" full>
                    <option value="">Nome:</option>
    
                    @foreach ($students as $student)
                        <option value="{{$student->id}}" {{old('student_id', $pedagogical->student_id) == $student->id ? 'selected' : ''}}>
                            {{$student->name}}
                        </option>
                    @endforeach
                </x-form.select>
            </div> 
            <div>
                <x-form.label for="date_pedagogical">Data da Produção do Relatório</x-form.label>
                <x-form.input id="date_pedagogical" name="date_pedagogical" class="date dateInput" required x-init="initFlatpickr"
                value="{{old('date_pedagogical', $pedagogical->date_pedagogical)}}" placeholder="Ex: 01/01/2001"/>
                @error("date_pedagogical")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
                <span id="errorMessage" style="color: red; display: none;">
                    Data inválida. Insira uma data entre 1960 e 2200.
                </span>
            </div>
        </div>

        <div class="mb-3 grid grid-cols-4 gap-x-4">
            <div class="col-span-2">
                <x-form.label for="school"> Escola que estuda </x-form.label>
                <x-form.input id="school" name="school" value="{{old('school', $pedagogical->school)}}" class="w-full"
                placeholder="Ex: E.M Tia Benilce" required/>
                @error("school")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div>
                <x-form.label for="date_of_birth"> Data de Nascimento </x-form.label>
                <x-form.input id="date_of_birth" name="date_of_birth" value="{{old('date_of_birth', \Carbon\Carbon::createFromFormat('Y-m-d', $pedagogical->student->date_of_birth)->format('d/m/Y'))}}" readonly
                placeholder="Data fixa"/>
            </div>
            <div class="pl-4">
                <x-form.label for="age"> Idade </x-form.label>
                <x-form.input id="age" name="age" value="{{old('age', $pedagogical->age)}}" required placeholder="Ex: 15 anos" class="w-48"/>
                @error("age")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 grid grid-cols-4 gap-x-4 gap-y-3">
            <div>
                <x-form.label for="turn_school"> Turno </x-form.label>
                <x-form.input id="turn_school" name="turn_school" value="{{old('turn_school', $pedagogical->turn_school)}}" 
                    required placeholder="Ex: Manhã" class="w-full"/>
                @error("age")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div>
                <x-form.label for="grade_school"> Série/Ano </x-form.label>
                <x-form.input id="grade_school" name="grade_school" value="{{old('grade_school', $pedagogical->grade_school)}}"
                    required placeholder="Ex: 1°" class="w-full"/>
                @error("grade_school")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div>
                <x-form.label for="school_year"> Ano Letivo </x-form.label>
                <x-form.input id="school_year" name="school_year" value="{{old('school_year', $pedagogical->school_year)}}" 
                    required placeholder="Ex: 2024" class="w-full"/>
                @error("school_year")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div class="col-span-2">
                <x-form.label for="professor_signature"> Professor do CAEE </x-form.label>
                <x-form.select idSelect="professor_signature" valueName="professor_signature" full>
                    <option value="">Nome:</option>
    
                    @foreach ($professors as $professor)
                        <option value="{{$professor->name}}" {{old('professor_signature', $pedagogical->professor_signature) == $professor->name ? 'selected' : ''}}>
                            {{$professor->name}}
                        </option>
                    @endforeach
                </x-form.select>
                @error("professor_signature")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div>
            <x-form.label for="text"> Texto Principal do Relatório </x-form.label>
            <x-form.textarea id="text" name="text" height="text" placeholder="Texto ........." required>
                {{old('text', $pedagogical->text)}}
            </x-form.textarea>
            @error("text")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="grid grid-cols-2 mb-3">
            <div>
                <x-form.label for="signature"> Assinatura do Professor Responsável </x-form.label>
                <x-form.select idSelect="signature" valueName="signature" full>
                    <option value="">Nome:</option>
                        
                    @foreach ($professors as $professor)
                        <option value="{{$professor->name}}" {{old('signature', $pedagogical->signature) == $professor->name ? 'selected' : ''}}>
                            {{$professor->name}}
                        </option>
                    @endforeach
                </x-form.select>
            </div>
        </div>
    
    </x-table-edit>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#student_id').change(function () {
            var studentId = $(this).val();
            if (studentId) {
                $.ajax({
                    url: '/studentapi/' + studentId,
                    type: 'GET',
                    success: function (data) {
                        $('#date_of_birth').val(data.date_of_birth || '------'); 
                        $('#school').val(data.school || '------'); 
                        $('#grade_school').val(data.grade_school || '------'); 
                        $('#turn_school').val(data.turn_school || '------');
                    }
                });
            } else {
                // Limpa os campos se nenhum estudante estiver selecionado 
                $('#date_of_birth').val('');
                $('#school').val('');
                $('#grade_school').val('');
                $('#turn_school').val('');
            }
        });
</script>
