<?php

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

require "./vendor/autoload.php";


$codes = [
    "qr value 1",
    "qr value 2",
    "qr value 3",
 ];



$options = new QROptions([
    'version'    => 5,
    'outputType' => 'png',
    'eccLevel'   => QRCode::ECC_L,
]);

foreach($codes as $code) {
    
    
    // invoke a fresh QRCode instance
    $qrcode = new QRCode($options);
    
    // and dump the output
    $qrcode->render( $code );
    
    // ...with additional cache file
    if( !file_exists('results')) {
        mkdir('results');
    }
    $qrcode->render($code , 'results/'. $code.'.png');
}