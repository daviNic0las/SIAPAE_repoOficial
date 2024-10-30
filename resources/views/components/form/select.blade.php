<select id="options" name="{{$valueName}}" required class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
            focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
            dark:focus:ring-offset-dark-eval-1 dark:text-gray-400">

    {{$slot}}

   {{-- <option value=""> Selecione um {{ $optionOne }} </option>
   
    @foreach ($options as $option)
        <option value="{{ $option->id }}" {{ $eledit->{$valueName} == $option->id ? 'selected' : '' }}>
            {{ $option->name }}
        </option>
    @endforeach--}}

</select>