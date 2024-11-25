<x-app-layout>

    <x-table-create
        title="Anamnese"
        onlyHead
        actionRoute="anamnesis">

        <!-- I - Identificação -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-form.label for="informant">Informante</x-form.label>
                <input type="text" name="informant" id="informant" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" required>
            </div>
            <div>
                <label for="date_of_anamnesis" class="block text-sm font-medium text-gray-700">Data da Anamnese</label>
                <input type="date" name="date_of_anamnesis" id="date_of_anamnesis" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" required>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="appraisal" class="block text-sm font-medium text-gray-700">Avaliação</label>
                <input type="text" name="appraisal" id="appraisal" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="student_id" class="block text-sm font-medium text-gray-700">Estudante</label>
                <select name="student_id" id="student_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
                    <!-- Opções do estudante -->
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="have_caregiver" class="inline-flex items-center">
                    <input type="checkbox" name="have_caregiver" id="have_caregiver" class="form-checkbox" data-target="caregiver_info" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm">Tem Cuidador?</span>
                </label>
            </div>
            <div>
                <label for="caregiver_info" class="block text-sm font-medium text-gray-700">Informações do Cuidador</label>
                <input type="text" name="caregiver_info" id="caregiver_info" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm disabled:bg-gray-100 disabled:text-gray-500 disabled:border-gray-300" disabled data-dependent="true">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="class_AEE" class="block text-sm font-medium text-gray-700">Classe AEE</label>
                <input type="text" name="class_AEE" id="class_AEE" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="study" class="block text-sm font-medium text-gray-700">Estudo</label>
                <input type="text" name="study" id="study" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="name_mother" class="block text-sm font-medium text-gray-700">Nome da Mãe</label>
                <input type="text" name="name_mother" id="name_mother" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="date_mother" class="block text-sm font-medium text-gray-700">Data de Nascimento da Mãe</label>
                <input type="date" name="date_mother" id="date_mother" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="rg_mother" class="block text-sm font-medium text-gray-700">RG da Mãe</label>
                <input type="text" name="rg_mother" id="rg_mother" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="profession_mother" class="block text-sm font-medium text-gray-700">Profissão da Mãe</label>
                <input type="text" name="profession_mother" id="profession_mother" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="name_father" class="block text-sm font-medium text-gray-700">Nome do Pai</label>
                <input type="text" name="name_father" id="name_father" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="date_father" class="block text-sm font-medium text-gray-700">Data de Nascimento do Pai</label>
                <input type="date" name="date_father" id="date_father" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="rg_father" class="block text-sm font-medium text-gray-700">RG do Pai</label>
                <input type="text" name="rg_father" id="rg_father" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="profession_father" class="block text-sm font-medium text-gray-700">Profissão do Pai</label>
                <input type="text" name="profession_father" id="profession_father" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Endereço</label>
                <input type="text" name="address" id="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="cellphone" class="block text-sm font-medium text-gray-700">Celular</label>
                <input type="text" name="cellphone" id="cellphone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="have_medication" class="inline-flex items-center">
                    <input type="checkbox" name="have_medication" id="have_medication" class="form-checkbox">
                    <span class="ml-2 text-sm">Usa Medicação?</span>
                </label>
            </div>
            <div>
                <label for="what_medication" class="block text-sm font-medium text-gray-700">Qual Medicação?</label>
                <input type="text" name="what_medication" id="what_medication" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
        </div>

        <!-- II - Queixa Inicial -->
        <div>
            <label for="compplaint" class="block text-sm font-medium text-gray-700">Queixa Inicial</label>
            <input type="text" name="compplaint" id="compplaint" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>

        <!-- III - Situação Sociofamiliar -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="who_lives" class="block text-sm font-medium text-gray-700">Com quem mora?</label>
                <input type="text" name="who_lives" id="who_lives" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="state_parents_relation" class="block text-sm font-medium text-gray-700">Relação dos Pais</label>
                <input type="text" name="state_parents_relation" id="state_parents_relation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="time_state_relation" class="block text-sm font-medium text-gray-700">Tempo de Relação</label>
                <input type="text" name="time_state_relation" id="time_state_relation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="new_relation_mother" class="inline-flex items-center">
                    <input type="checkbox" name="new_relation_mother" id="new_relation_mother" class="form-checkbox">
                    <span class="ml-2 text-sm">Nova Relação com Mãe?</span>
                </label>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="time_new_relation_mother" class="block text-sm font-medium text-gray-700">Tempo de Nova Relação (Mãe)</label>
                <input type="text" name="time_new_relation_mother" id="time_new_relation_mother" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="lives_new_relation_mother" class="block text-sm font-medium text-gray-700">Onde mora (Nova Relação com Mãe)</label>
                <input type="text" name="lives_new_relation_mother" id="lives_new_relation_mother" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            </div>
        </div>


    </x-table-create>

</x-app-layout>