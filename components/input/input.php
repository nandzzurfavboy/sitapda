<?php

function baseInput(
  $label,
  $name,
  $required = false,
  $type = 'text',
  $value = '',
  $placeholder = '',
  $autocomplete = 'off'
) {
  $requiredAttr = $required ? 'required' : '';
  $requiredLabel = $required ? ' <span class="text-red-500">*</span>' : '';
  return "
    <div>
      <label class='block text-sm font-medium text-gray-700'>{$label}{$requiredLabel}</label>
      <input type='{$type}' name='{$name}' value='{$value}' placeholder='{$placeholder}' autocomplete='{$autocomplete}' class='mt-1 w-full rounded-lg border py-2 px-4 border-gray-200 shadow-sm sm:text-sm' {$requiredAttr} />
    </div>
  ";
}

