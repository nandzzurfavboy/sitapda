<?php
function baseSelect(
  $label,
  $name,  
  $dataOption,
  $valueOption,
  $labelOption,
  $defaultOption,
  $selectedOption = '',
  $required = false,
) {
  $requiredAttr = $required ? 'required' : '';
  $requiredLabel = $required ? ' <span class="text-red-500">*</span>' : '';
  $selectHTML = "
    <div>
      <label class='block text-sm font-medium text-gray-700'>{$label}{$requiredLabel}</label>
      <select name='{$name}' class='bg-white mt-1 w-full rounded-lg border py-2.5 px-4 border-gray-200 shadow-sm sm:text-sm' {$requiredAttr}>
        <option value=''>{$defaultOption}</option>";

  foreach ($dataOption as $option) {
    $selected = ($option[$valueOption] == $selectedOption) ? 'selected' : '';
    $selectHTML .= "<option value='{$option[$valueOption]}' {$selected}>{$option[$labelOption]}</option>";
  }

  $selectHTML .= "</select>
    </div>";

  return $selectHTML;
}
?>
