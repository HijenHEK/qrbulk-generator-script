<?php 



function sanitize_name($name) {
    return preg_replace("([^\w\s\d\-_~,;\[\]\(\)])" , "" ,  $name);
}
function sanitize_file_name($file_name){
    $dot_pos = strpos($file_name, '.' );
    $only_name = substr($file_name ,0, $dot_pos);
    $extension = substr($file_name , $dot_pos);
    $only_name_clean = sanitize_name($only_name);
    return str_replace(' ','', $only_name_clean) . $extension;
}