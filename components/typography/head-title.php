<?php
function head_title($string) {
    $string = str_replace('-', ' ', $string);
    $string = ucwords($string);
    
    return $string;
}

?>