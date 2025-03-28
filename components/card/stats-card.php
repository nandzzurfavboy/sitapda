<?php

function statsCard($icon, $value, $label)
{
  return "
  <div class=\"flex p-2 space-x-4 rounded-xl md:space-x-6 border\">
    <div class=\"flex justify-center p-2 align-middle rounded-lg sm:p-4 bg-[#e87918]\">
      $icon
    </div>
    <div class=\"flex flex-col justify-center align-middle\">
      <p class=\"text-3xl font-semibold leading\">$value</p>
      <p class=\"capitalize\">$label</p>
    </div>
  </div>
  ";
}
