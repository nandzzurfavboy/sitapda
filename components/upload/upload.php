<?php

function baseUpload(
    $label,
    $name,
    $required = false,
    $accept = '',
    $maxSize = '2MB'
) {
    $requiredAttr = $required ? 'required' : '';
    $requiredLabel = $required ? ' <span class="text-red-500">*</span>' : '';
    $acceptAttr = $accept ? "accept='{$accept}'" : '';

    return "
    <div>
      <label class='block text-sm font-medium text-gray-700'>{$label}{$requiredLabel}</label>
      <div class='mt-1 flex items-center'>
        <input type='file' name='{$name}' {$acceptAttr} class='w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200' {$requiredAttr} />
      </div>
      <p class='mt-1 text-xs text-gray-500'>Ukuran maksimal: {$maxSize}</p>
    </div>
  ";
}
