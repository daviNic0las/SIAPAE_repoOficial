<select id="{{$idSelect ?? ''}}" name="{{$valueName}}" @if(isset($notRequired)) @else required @endif class="py-1 border-gray-400 rounded-md dark:border-gray-600 dark:bg-dark-eval-1
        dark:text-gray-400 pr-20 text-sm disabled:bg-gray-200 disabled:text-gray-800 disabled:border-gray-500 {{isset($class) ? $class : ''}} {{isset($full) ? 'w-full' : ''}}" onchange="{{$function ?? ''}}" 
        @if (isset($disabled)) disabled @endif>
    <option value="" class="text-sm">{{$title}}</option>

    {{$slot}}
    
</select>