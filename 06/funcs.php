<?php

function h($str){
    $str = htmlspecialchars($str, ENT_QUOTES);
    return $str;
}

?>