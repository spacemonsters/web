<?php

function fixUrl($val){
    return urlencode($val);
}
function fixDb($val){
    return '"'.addslashes($val).'"';
}
?>