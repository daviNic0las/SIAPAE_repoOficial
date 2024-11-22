@props([
    'disabled' => false,
])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
            'class' => 'py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
            focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
            dark:focus:ring-offset-dark-eval-1',
        ])
    !!}
>
