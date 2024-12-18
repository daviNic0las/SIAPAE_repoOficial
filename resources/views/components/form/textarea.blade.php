@props([
    'disabled' => false,
    'required' => false,
    'sizeFont' => 'sm',
    'height' => 'base',
])

@php
    $baseClasses = 'w-full py-1 border-gray-400 rounded-md focus:border-gray-400 dark:border-gray-600 dark:bg-dark-eval-1 shadow-sm disabled:bg-gray-100 disabled:text-gray-500 disabled:border-gray-400 dark:text-gray-400';

    switch ($sizeFont) {
        case 'sm':
            $sizeClasses = 'text-sm';
        break;
        case 'base':
        default:
            $sizeClasses = 'text-base';
        break;
        case 'lg':
            $sizeClasses = 'text-xl';
        break;
    }

    switch ($height) {
        case 'base':
        default:
            $height = 'h-16';
        break;
        case 'lg':
            $height = 'h-24';
        break;
        case 'text':
            $height = 'h-64';
        break;
    }

    $classes = $baseClasses . ' ' . $sizeClasses . ' ' . $height;
@endphp

<textarea
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
            'class' => $classes
        ])
    !!}
>{{$slot}}
</textarea>
