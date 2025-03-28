<?php

function baseTextarea(
  $label,
  $name,
  $required = false,
  $value = '',
  $placeholder = '',
  $rows = 4
) {
  $requiredAttr = $required ? 'required' : '';
  $requiredLabel = $required ? ' <span class="text-red-500">*</span>' : '';
  return "
    <div>
      <label class='block text-sm font-medium text-gray-700'>{$label}{$requiredLabel}</label>
      <textarea name='{$name}' placeholder='{$placeholder}' class='mt-1 w-full rounded-lg border py-2 px-4 border-gray-200 shadow-sm sm:text-sm' rows='{$rows}' {$requiredAttr}>{$value}</textarea>
    </div>
  ";
}
