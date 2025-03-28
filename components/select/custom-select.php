<?php
function customSelect(
  $name,  
  $dataOption,
  $valueOption,
  $labelOption,
  $defaultOption,
  $selectedOption = '',
) {
  $selectHTML = "
    <div>
      <select name='{$name}' class='px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm'>
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
