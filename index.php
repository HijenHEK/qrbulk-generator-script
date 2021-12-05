<?php

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

require "./vendor/autoload.php";
require "./helpers.php";
$codes = ['hello' , 'Hello' , 'heLlo' , 'hellO'];
$extension = 'png';



var_dump(count($codes));
$output_folder  = 'results';

if($argc == 2) {
    $input_file = $argv[1];
    if(is_txt($input_file)) { die('not a txt file ? please try a gain with a .txt file !') ;}
    if(!file_exists($input_file)) {
        die('file dosn\'t exist !');
    }
    $output_folder = create_folder_from($input_file);
    $codes = [];
    $codes = read_from_file($input_file);

}




$options = new QROptions([
    'version'    => 5,
    'outputType' => $extension,
    'eccLevel'   => QRCode::ECC_L,
]);

if( !file_exists($output_folder)) {
    mkdir($output_folder);
}
$clean_codes = array_unique($codes);

foreach($clean_codes as $code) {
    
    // invoke a fresh QRCode instance
    $qrcode = new QRCode($options);
    

    // use file name sanitizer helper function 

    $filename =  sanitize_name($code);
    $clean_path = clean_path($output_folder,$filename,$extension) ;
    $qrcode->render($code , $clean_path);

}