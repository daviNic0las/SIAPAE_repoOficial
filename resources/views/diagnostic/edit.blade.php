<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edição de Diagnóstico') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route("diagnostic.update", $diagnostic->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <p><a href="{{ route('diagnostic.index') }}" class="btn btn-warning mb-4">Voltar</a></p>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Nome do Diagnóstico*</label>
                            <input type="text" name="name" required class="form-control" placeholder="Nome"  value="{{$diagnostic->name}}">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="d-grid">
                            <button class="btn btn-warning">Atualizar</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
