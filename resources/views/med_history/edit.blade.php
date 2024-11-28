<x-app-layout>

    <x-table-edit 
        title="Anamnese" 
        :elementEdit="$medHistory"
        onlyHead 
        actionRoute="anamnesis">

        <!-- Validation Errors -->
        <div class="mt-2 mb-4">
            <x-auth-validation-errors :errors="$errors" />
            <ul id="errorMessage" style="display: none;"
                class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                Data(s) Inválida(s), Insira datas que respeitem o campo
            </ul>
        </div>


        <!-- I - Identificação -->

        <div class="my-4">
            <h1 class="text-xl font-bold">
                I - Identificação
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 my-2">
            <div class="col-span-2">
                <x-anamnesis.label for="student_id">Nome da Criança</x-anamnesis.label>
                <x-anamnesis.select full idSelect="student_id" valueName="student_id"
                    title="Selecione um Aluno Registrado" :selects="$students" />
            </div>
            <div>
                <x-anamnesis.label for="informant">Informante</x-anamnesis.label>
                <x-anamnesis.input name="informant" id="informant" value="{{old('informant', $medHistory->informant)}}"
                    placeholder="Nome do Informante" required />
            </div>
            <div>
                <x-anamnesis.label for="date_of_anamnesis">Data da Anamnese</x-anamnesis.label>
                <x-anamnesis.input name="date_of_anamnesis" id="date_of_anamnesis" placeholder="Data da Anamnese"
                    class="date" required value="{{old('date_of_anamnesis', $medHistory->date_of_anamnesis)}}" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 my-2">
            <div>
                <x-anamnesis.label for="date_of_birth">Data de Nascimento</x-anamnesis.label>
                <x-anamnesis.input id="date_of_birth" value="{{\Carbon\Carbon::createFromFormat('Y-m-d', $medHistory->student->date_of_birth)->format('d/m/Y')}}" placeholder="Data" readonly />
            </div>
            <div>
                <x-anamnesis.label for="diagnostic">Diagnóstico</x-anamnesis.label>
                <x-anamnesis.input id="diagnostic" value="{{$medHistory->student->diagnostic->name}}" placeholder="Diagnóstico do Aluno" readonly />
            </div>
            <div>
                <x-anamnesis.label for="appraisal">Laudo/Especialista</x-anamnesis.label>
                <x-anamnesis.input name="appraisal" id="appraisal" value="{{old('appraisal', $medHistory->appraisal)}}" placeholder="Avaliação"
                    required />
            </div>
            <div class="flex">
                <input type="hidden" name="have_caregiver" value="0">

                <label for="have_caregiver" class="inline-flex items-center">
                    <input type="checkbox" name="have_caregiver" {{ old('have_caregiver', $medHistory->have_caregiver) ? 'checked' : '' }} id="have_caregiver"
                        class="form-checkbox" value="1">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Tem Cuidador?</span>
                </label>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-4 my-2">
            <div>
                <x-anamnesis.label for="school">Escola do Aluno:</x-anamnesis.label>
                <x-anamnesis.input class="w-full" id="school" value="{{$medHistory->student->school}}" placeholder="Escola que Estuda" readonly />
            </div>
            <div>
                <x-anamnesis.label for="not_study_justify">Se não estuda justifique</x-anamnesis.label>
                <x-anamnesis.input class="w-full" name="not_study_justify" id="not_study_justify"
                    value="{{old('not_study_justify', $medHistory->not_study_justify)}}" placeholder="Justificação" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 my-2">
            <div>
                <x-anamnesis.label for="grade_school">Série:</x-anamnesis.label>
                <x-anamnesis.input id="grade_school" value="{{$medHistory->student->grade_school}}" placeholder="Série que faz" readonly />
            </div>
            <div>
                <x-anamnesis.label for="class_school">Turma:</x-anamnesis.label>
                <x-anamnesis.input id="class_school" value="{{$medHistory->student->class_school}}" placeholder="Turma na Escola" readonly />
            </div>
            <div>
                <x-anamnesis.label for="turn_school">Turno:</x-anamnesis.label>
                <x-anamnesis.input id="turn_school" value="{{$medHistory->student->turn_school}}" placeholder="Turno na Escola" readonly />
            </div>
            <div>
                <input type="hidden" name="have_AEE" value="0">

                <label for="have_AEE" class="inline-flex items-center">
                    <input type="checkbox" name="have_AEE" id="have_AEE" {{ old('have_AEE', $medHistory->have_AEE) ? 'checked' : '' }}
                        class="form-checkbox" value="1" data-target="turn_AEE" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Tem AEE?</span>
                </label>
                <x-anamnesis.input class="turn_AEE" name="turn_AEE" id="turn_AEE" value="{{old('turn_AEE', $medHistory->turn_AEE)}}" placeholder="Turno da AEE" disabled />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 my-2">
            <div class="col-span-2">
                <x-anamnesis.label for="name_mother">Nome da Mãe</x-anamnesis.label>
                <x-anamnesis.input class="w-full" name="name_mother" id="name_mother" value="{{old('name_mother', $medHistory->name_mother)}}"
                    placeholder="Nome da Mãe" required />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 my-2">
            <div>
                <x-anamnesis.label for="date_mother">Data de Nascimento da Mãe</x-anamnesis.label>
                <x-anamnesis.input name="date_mother" id="date_mother" value="{{old('date_mother', $medHistory->date_mother)}}"
                    class="date dateInput" placeholder="Ex: 01/11/2000" required />
            </div>
            <div>
                <x-anamnesis.label for="rg_mother">RG da Mãe</x-anamnesis.label>
                <x-anamnesis.input class="rg" name="rg_mother" id="rg_mother" value="{{old('rg_mother', $medHistory->rg_mother)}}"
                    placeholder="RG da Mãe" required />
            </div>
            <div>
                <x-anamnesis.label for="profession_mother">Profissão da Mãe</x-anamnesis.label>
                <x-anamnesis.input name="profession_mother" id="profession_mother" value="{{old('profession_mother', $medHistory->profession_mother)}}"
                    placeholder="Profissão da Mãe" required />
            </div>
            <div>
                <x-anamnesis.label for="cellphone_mother">Telefone da Mãe</x-anamnesis.label>
                <x-anamnesis.input class="cellphone" name="cellphone_mother" id="cellphone_mother"
                    value="{{old('cellphone_mother', $medHistory->cellphone_mother)}}" placeholder="Ex: (88)99312-1231" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 my-2">
            <div class="col-span-2">
                <x-anamnesis.label for="name_father">Nome do Pai</x-anamnesis.label>
                <x-anamnesis.input class="w-full" name="name_father" id="name_father" value="{{old('name_father', $medHistory->name_father)}}"
                    placeholder="Nome do Pai" required />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 my-2">
            <div>
                <x-anamnesis.label for="date_father">Data de Nascimento do Pai</x-anamnesis.label>
                <x-anamnesis.input class="date dateInput" name="date_father" id="date_father"
                    value="{{old('date_father', $medHistory->date_father)}}" placeholder="Ex: 01/11/2000" required />
            </div>
            <div>
                <x-anamnesis.label for="rg_father">RG do Pai</x-anamnesis.label>
                <x-anamnesis.input class="rg" name="rg_father" id="rg_father" value="{{old('rg_father', $medHistory->rg_father)}}"
                    placeholder="RG do Pai" required />
            </div>
            <div>
                <x-anamnesis.label for="profession_father">Profissão do Pai</x-anamnesis.label>
                <x-anamnesis.input name="profession_father" id="profession_father" value="{{old('profession_father', $medHistory->profession_father)}}"
                    placeholder="Profissão do Pai" required />
            </div>
            <div>
                <x-anamnesis.label for="cellphone_father">Telefone do Pai</x-anamnesis.label>
                <x-anamnesis.input class="cellphone" name="cellphone_father" id="cellphone_father"
                    value="{{old('cellphone_father', $medHistory->cellphone_father)}}" placeholder="Ex: (88)99312-1231" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 my-2">
            <div class="col-span-2">
                <x-anamnesis.label for="address">Endereço</x-anamnesis.label>
                <x-anamnesis.input class="w-full" name="address" id="address" value="{{old('address', $medHistory->address)}}"
                    placeholder="Ex: Travessa Joaquim Félix" required />
            </div>
            <div>
                <input type="hidden" name="have_medication" value="0">

                <label for="have_medication" class="inline-flex items-center">
                    <input type="checkbox" name="have_medication" id="have_medication" {{ old('have_medication', $medHistory->have_medication) ? 'checked' : '' }} 
                        class="form-checkbox" value="1" data-target="what_medication" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm">Usa Medicação?</span>
                </label>
                <x-anamnesis.input class="what_medication" name="what_medication" id="what_medication"
                    value="{{old('what_medication', $medHistory->what_medication)}}" placeholder="Qual(is)?" disabled />
            </div>
        </div>

        <!-- II - Queixa Inicial -->

        <div class="my-3">
            <h1 class="text-xl font-bold">
                II - Queixa Inicial
            </h1>
        </div>

        <div>
            <x-anamnesis.label for="compplaint">Queixa Inicial</x-anamnesis.label>
            <x-anamnesis.input class="w-full" name="compplaint" value="{{old('compplaint', $medHistory->compplaint)}}" id="compplaint"
                placeholder="Queixa Inicial" />
        </div>

        <!-- III - Situação Sociofamiliar -->

        <div class="my-4">
            <h1 class="text-xl font-bold">
                III - Situação Sociofamiliar
            </h1>
        </div>

        <div>
            <x-anamnesis.label for="who_lives">Com quem mora?</x-anamnesis.label>
            <x-anamnesis.input class="w-full" name="who_lives" id="who_lives" value="{{old('who_lives', $medHistory->who_lives)}}"
                placeholder="Ex: Pai, Mãe, ..." required />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 my-2">
            <div>
                <x-anamnesis.label for="state_parents_relation">Pais Casados ou Separados?</x-anamnesis.label>
                <x-anamnesis.select valueName="state_parents_relation" selectId="state_parents_relation"
                    title="Relação">
                    <option value="Casados" {{ old('state_parents_relation', $medHistory->state_parents_relation) == 'Casados' ? 'selected' : '' }}>
                        Casados
                    </option>
                    <option value="Separados" {{ old('state_parents_relation', $medHistory->state_parents_relation) == 'Separados' ? 'selected' : '' }}>
                        Separados
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label for="time_state_relation">Há quanto tempo?</x-anamnesis.label>
                <x-anamnesis.input name="time_state_relation" id="time_state_relation"
                    value="{{old('time_state_relation', $medHistory->time_state_relation)}}" placeholder="Ex: 30 dias" required />
            </div>
            <div class="col-span-2">
                <input type="hidden" name="have_kinship_parents" value="0">

                <label for="have_kinship_parents" class="inline-flex items-center">
                    <input type="checkbox" name="have_kinship_parents" id="have_kinship_parents" {{ old('have_kinship_parents', $medHistory->have_kinship_parents) ? 'checked' : '' }}
                        class="form-checkbox" value="1" data-target="what_kinship_parents" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm">Existe Parentesco entre os Pais?</span>
                </label>
                <x-anamnesis.input class="what_kinship_parents" name="what_kinship_parents" id="what_kinship_parents"
                    value="{{old('what_kinship_parents', $medHistory->what_kinship_parents)}}" placeholder="Qual?" disabled />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 my-2">
            <div class="flex">
                <input type="hidden" name="new_relation_mother" value="0">

                <label for="new_relation_mother" class="inline-flex items-center">
                    <input type="checkbox" name="new_relation_mother" id="new_relation_mother" {{ old('new_relation_mother', $medHistory->new_relation_mother) ? 'checked' : '' }}
                        class="form-checkbox" value="1" data-target="relation_mother" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm">Mãe: Novo relacionamento?</span>
                </label>
            </div>
            <div>
                <x-anamnesis.label for="time_new_relation_mother">Há quanto Tempo?</x-anamnesis.label>
                <x-anamnesis.input name="time_new_relation_mother" id="time_new_relation_mother"
                    value="{{old('time_new_relation_mother', $medHistory->time_new_relation_mother)}}" placeholder="Ex: 30 dias" class="relation_mother"
                    disabled />
            </div>
            <div>
                <x-anamnesis.label for="lives_together_new_relation_mother">Moram juntos?</x-anamnesis.label>
                <x-anamnesis.select valueName="lives_together_new_relation_mother" notRequired
                    selectId="lives_together_new_relation_mother" title="Sim/Não" class="relation_mother" disabled>
                    <option value="Sim" {{ old('lives_together_new_relation_mother', $medHistory->lives_together_new_relation_mother) == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('lives_together_new_relation_mother', $medHistory->lives_together_new_relation_mother) == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 my-2">
            <div class="flex">
                <label for="new_relation_father" class="inline-flex items-center">
                    <input type="hidden" name="new_relation_father" value="0">

                    <input type="checkbox" name="new_relation_father" id="new_relation_father" {{ old('new_relation_father', $medHistory->new_relation_father) ? 'checked' : '' }}
                        class="form-checkbox" value="1" data-target="relation_father" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm">Pai: Novo relacionamento?</span>
                </label>
            </div>
            <div>
                <x-anamnesis.label for="time_new_relation_father">Há quanto Tempo?</x-anamnesis.label>
                <x-anamnesis.input name="time_new_relation_father" id="time_new_relation_father"
                    value="{{old('time_new_relation_father', $medHistory->time_new_relation_father)}}" placeholder="Ex: 30 dias" class="relation_father"
                    disabled />
            </div>
            <div>
                <x-anamnesis.label for="lives_together_new_relation_father">Moram juntos?</x-anamnesis.label>
                <x-anamnesis.select valueName="lives_together_new_relation_father" notRequired
                    selectId="lives_together_new_relation_father" title="Sim/Não" class="relation_father" disabled>
                    <option value="Sim" {{ old('lives_together_new_relation_father', $medHistory->lives_together_new_relation_father) == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('lives_together_new_relation_father', $medHistory->lives_together_new_relation_father) == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
        </div>


    </x-table-edit>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#student_id').change(function () {
            var studentId = $(this).val();
            if (studentId) {
                $.ajax({
                    url: '/studentapi/' + studentId,
                    type: 'GET',
                    success: function (data) {
                        $('#date_of_birth').val(data.date_of_birth);
                        $('#diagnostic').val(data.diagnostic);
                        $('#school').val(data.school);
                        $('#grade_school').val(data.grade_school);
                        $('#class_school').val(data.diagnostic);
                        $('#turn_school').val(data.turn_school);
                    }
                });
            } else {
                // Limpa os campos se nenhum estudante estiver selecionado 
                $('#date_of_birth').val('');
                $('#diagnostic').val('');
                $('#school').val('');
                $('#grade_school').val('');
                $('#class_school').val('');
                $('#turn_school').val('');
            }
        });
    });
</script>