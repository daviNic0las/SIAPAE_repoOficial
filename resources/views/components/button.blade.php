@props([
    'variant' => 'primary',
    'iconOnly' => false,
    'srText' => '',
    'href' => false,
    'button' => false,
    'size' => 'base',
    'disabled' => false,
    'pill' => false,
    'squared' => false,
    'bg' => 'bg-white dark:bg-dark-eval-1',
])

@php

    $baseClasses = 'inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2';

    switch ($variant) {
        case 'primary':
            $variantClasses = 'bg-gray-700 text-white hover:text-white dark:text-gray-200 hover:bg-gray-900 focus:ring focus:ring-gray-500 dark:hover:bg-dark-eval-3';
        break;
        case 'secondary':
            $variantClasses = 'bg-white text-gray-500 hover:bg-gray-100 focus:ring focus:ring-gray-500 dark:text-gray-400 dark:bg-dark-eval-1 dark:hover:bg-dark-eval-2 dark:hover:text-gray-200';
        break;
        case 'success':
            $variantClasses = 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500 dark:text-gray-100 dark:bg-green-700 dark:hover:bg-green-600';
        break;
        case 'danger':
            $variantClasses = 'bg-red-600 text-white hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600 focus:ring-red-700';
        break;
        case 'warning':
            $variantClasses = 'bg-yellow-400 text-white hover:bg-yellow-500 dark:bg-yellow-500 dark:hover:bg-yellow-400';
        break;
        case 'blue':
            $variantClasses = 'bg-blue-500 text-white hover:bg-blue-600 dark:bg-blue-800 dark:hover:bg-blue-700';
        break;
        case 'black':
            $variantClasses = 'bg-black text-gray-300 hover:text-white hover:bg-gray-800 focus:ring focus:ring-black dark:hover:bg-dark-eval-3';
        break;
        case 'trash':
            $variantClasses = $bg.' border border-gray-300 hover:border-red-600 dark:border-gray-700 dark:hover:border-red-700 text-black hover:text-white hover:bg-red-600 focus:ring focus:ring-red-700 dark:text-gray-400 dark:hover:bg-red-700 dark:hover:text-gray-200';
        break;
        case 'edit':
            $variantClasses = $bg.' border border-gray-300 hover:border-yellow-400 hover:bg-yellow-400 focus:ring focus:ring-yellow-500 dark:text-gray-400 dark:border-gray-700 dark:hover:border-yellow-500 dark:hover:bg-yellow-500 dark:hover:text-gray-900';
        break;
        case 'restore':
            $variantClasses = $bg.' border border-gray-300 hover:border-blue-600 hover:bg-blue-600 hover:text-white focus:ring focus:ring-blue-600 dark:text-gray-400 dark:border-gray-700 dark:hover:border-blue-500 dark:hover:bg-blue-500 dark:hover:text-gray-900';
        break;
        default:
            $variantClasses = 'bg-gray-300 text-white hover:bg-gray-600 focus:ring focus:ring-gray-500';
    }

    switch ($size) {
        case 'hyper-sm':
            $sizeClasses = $iconOnly ? 'p-1' : 'px-1.5 py-1 text-sm';
        break;
        case 'sm':
            $sizeClasses = $iconOnly ? 'p-1.5' : 'px-2.5 py-1.5 text-sm';
        break;
        case 'base':
            $sizeClasses = $iconOnly ? 'p-2' : 'px-4 py-2 text-base';
        break;
        case 'lg':
        default:
            $sizeClasses = $iconOnly ? 'p-3' : 'px-5 py-2 text-xl';
        break;
    }

    $classes = $baseClasses . ' ' . $sizeClasses . ' ' . $variantClasses;

    if(!$squared && !$pill){
        $classes .= ' rounded-md';
    } else if ($pill) {
        $classes .= ' rounded-full';

    }

@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        @if($iconOnly)
            <span class="sr-only">{{ $srText ?? '' }}</span>
        @endif
    </a>
@elseif ($button)
    <button {{ $attributes->merge(['type' => 'button', 'class' => $classes]) }}>
        {{ $slot }}
        @if($iconOnly)
            <span class="sr-only">{{ $srText ?? '' }}</span>
        @endif
    </button>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
        {{ $slot }}
        @if($iconOnly)
            <span class="sr-only">{{ $srText ?? '' }}</span>
        @endif
    </button>
@endif
