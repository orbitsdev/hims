@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-tory-blue-500 focus:ring-tory-blue-500 rounded-md shadow-sm']) !!}>
