<x-app-layout>
    <div class="container mx-auto p-4">
        <form id="multi-step-form" action="" method="POST">
            @csrf
            <!-- Step 1 -->
            <div class="form-step">
                <h2 class="text-xl mb-4">Informações do Estudante</h2>
                <div>
                    <label for="student_id">ID do Estudante:</label>
                    <input type="text" name="student_id" id="student_id" class="form-input" value="{{ old('student_id') }}">
                </div>
                <div>
                    <label for="informant">Informante:</label>
                    <input type="text" name="informant" id="informant" class="form-input" value="{{ old('informant') }}">
                </div>
                <button type="button" class="next-step">Próximo</button>
            </div>
            
            <!-- Step 2 -->
            <div class="form-step hidden">
                <h2 class="text-xl mb-4">Informações de Anamnese</h2>
                <div>
                    <label for="date_of_anamnesis">Data da Anamnese:</label>
                    <input type="date" name="date_of_anamnesis" id="date_of_anamnesis" class="form-input" value="{{ old('date_of_anamnesis') }}">
                </div>
                <div>
                    <label for="appraisal">Avaliação:</label>
                    <input type="text" name="appraisal" id="appraisal" class="form-input" value="{{ old('appraisal') }}">
                </div>
                <button type="button" class="prev-step">Anterior</button>
                <button type="button" class="next-step">Próximo</button>
            </div>

            <!-- Step 3 -->
            <div class="form-step hidden">
                <h2 class="text-xl mb-4">Informações dos Pais</h2>
                <div>
                    <label for="name_mother">Nome da Mãe:</label>
                    <input type="text" name="name_mother" id="name_mother" class="form-input" value="{{ old('name_mother') }}">
                </div>
                <div>
                    <label for="profession_mother">Profissão da Mãe:</label>
                    <input type="text" name="profession_mother" id="profession_mother" class="form-input" value="{{ old('profession_mother') }}">
                </div>
                <button type="button" class="prev-step">Anterior</button>
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            let currentStep = 0;
            const steps = $(".form-step");

            steps.eq(currentStep).show();
            
            $(".next-step").on("click", function () {
                steps.eq(currentStep).hide();
                currentStep++;
                steps.eq(currentStep).show();
            });

            $(".prev-step").on("click", function () {
                steps.eq(currentStep).hide();
                currentStep--;
                steps.eq(currentStep).show();
            });
        });
    </script>
</x-app-layout>
