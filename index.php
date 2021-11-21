<?php

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

require "./vendor/autoload.php";
require "./helpers.php";
$codes = [
    "*qr ;; value 1,",
    "qr value 2",
    "qr value 3",
 ];

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
    'outputType' => 'png',
    'eccLevel'   => QRCode::ECC_L,
]);

if( !file_exists($output_folder)) {
    mkdir($output_folder);
}

foreach($codes as $code) {
    


    // invoke a fresh QRCode instance
    $qrcode = new QRCode($options);
    

    // use file name sanitizer helper function 

    $filename = sanitize_name($code);

    $qrcode->render($code , $output_folder.'/'. $filename.'.png');
}