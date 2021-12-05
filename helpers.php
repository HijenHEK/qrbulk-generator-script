<?php 

// clean name for file or directory creation
function sanitize_name($name) {
    $name = trim($name);
    return preg_replace("([^\w\s\d\-_~,;\[\]\(\)])" , "" ,  $name);
}

// check if the name is clean for file or directory creation
function is_sanitized($name) {
    return $name == sanitize_name($name) ;
}

// get file name only
function get_file_name($file) {
    $dot_pos = strrpos($file, '.' );
    return $dot_pos ? substr($file ,0, $dot_pos) : $file;
}
// get extension only
function get_file_extension($file) {
    $dot_pos = strrpos($file, '.' );
    return $dot_pos ? substr($file , $dot_pos) : null;
}
// check if file is txt
function is_txt($file) {
    get_file_extension($file) == 'txt' ;
}
// create a folder and add time int if exists already 
function create_folder_from($file) {
    $file = sanitize_file_name($file);
    $folder_name = get_file_name($file);
    if(file_exists($folder_name)){ mkdir($folder_name . time() . rand(0,500)); return $folder_name ;}
    mkdir($folder_name); return $folder_name;
}

// clean file name ( with extension )
function sanitize_file_name($file_name){
    $dot_pos = strrpos($file_name, '.' );
    $only_name = substr($file_name ,0, $dot_pos);
    $extension = substr($file_name , $dot_pos);
    $only_name_clean = sanitize_name($only_name);
    return str_replace(' ','', $only_name_clean) . $extension;
}

// read line from a txt file and return a qr code array
function read_from_file(String $file) : array{
    $handle = fopen($file, "r");
    $array = [];
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            array_push($array , $line);
        }

        fclose($handle);
    } else {
        die('error while reading from file ' . $file);
    }
    return $array;
}

function clean_path(String $output_folder , String $filename , String $extenstion)
{
    $files = scandir($output_folder);
    $underscore_pos = strrpos($filename, '_' );
    $orignal_file_name = $underscore_pos ? substr($filename ,0, $underscore_pos) : $filename;
    $duplicate_names = preg_grep('/^'.$orignal_file_name.'.*/i',$files); 
    var_dump($orignal_file_name , $files, $duplicate_names);
    $duplicate_names_count = count($duplicate_names);

    if(file_exists($output_folder.'/'.  strtolower($orignal_file_name).'.' . $extenstion)) {
        $filename = $orignal_file_name . '_' . $duplicate_names_count ;
    }
    return $output_folder .'/'. $filename.'.' . $extenstion ;
}