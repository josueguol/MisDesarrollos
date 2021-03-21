<?php 
function decrypt( $input, $key ){
    $cipherSplit = explode( " ", $input);
    $originalSize = intval($cipherSplit[0]);
    $iv = cryptoHelpers::toNumbers($cipherSplit[1]);
    $cipherText = $cipherSplit[2];

    $cipherIn = cryptoHelpers::toNumbers($cipherText);
    $keyAsNumbers = cryptoHelpers::toNumbers(bin2hex($key));
    $keyLength = count($keyAsNumbers);

    $decrypted = AES::decrypt(
        $cipherIn,
        $originalSize,
        AES::modeOfOperation_CBC,
        $keyAsNumbers,
        $keyLength,
        $iv
    );

    $hexDecrypted = cryptoHelpers::toHex($decrypted);
    $retVal = pack("H*" , $hexDecrypted);

    return $retVal;
}

function encrypt( $plaintext, $key ){

    // Set up encryption parameters.
    $plaintext_utf8 = utf8_encode($plaintext);
    $inputData = cryptoHelpers::convertStringToByteArray($plaintext);
    $keyAsNumbers = cryptoHelpers::toNumbers(bin2hex($key));
    $keyLength = count($keyAsNumbers);
    $iv = cryptoHelpers::generateSharedKey(16);

    $encrypted = AES::encrypt(
        $inputData,
        AES::modeOfOperation_CBC,
        $keyAsNumbers,
        $keyLength,
        $iv
    );

    $retVal = $encrypted['originalsize'] . " "
        . cryptoHelpers::toHex($iv) . " "
        . cryptoHelpers::toHex($encrypted['cipher']);

    return $retVal;
}

?>