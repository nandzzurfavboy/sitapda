<?php

function baseDate(
    $label,
    $name,
    $required = false,
    $value = '',
    $min = '',
    $max = ''
) {
    $requiredAttr = $required ? 'required' : '';
    $requiredLabel = $required ? ' <span class="text-red-500">*</span>' : '';
    $minAttr = $min ? "min='{$min}'" : '';
    $maxAttr = $max ? "max='{$max}'" : '';

    return "
    <div>
      <label class='block text-sm font-medium text-gray-700'>{$label}{$requiredLabel}</label>
      <input type='date' name='{$name}' value='{$value}' {$minAttr} {$maxAttr} class='mt-1 w-full rounded-lg border py-2 px-4 border-gray-200 shadow-sm sm:text-sm' {$requiredAttr} />
    </div>
  ";
}
