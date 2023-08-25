<?php 

function encrypt($key, $plaintext) {
    $nonce = random_bytes(12);
    $ciphertext = openssl_encrypt($plaintext, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $nonce, $tag);

    $encryptedData = $nonce . $ciphertext . $tag;
    return base64_encode($encryptedData);
}

function decrypt($key, $encryptedData) {
    $encryptedData = base64_decode($encryptedData);

    $nonceSize = 12;
    $nonce = substr($encryptedData, 0, $nonceSize);
    $ciphertext = substr($encryptedData, $nonceSize, -$nonceSize);
    $tag = substr($encryptedData, -$nonceSize);

    return openssl_decrypt($ciphertext, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $nonce, $tag);
}

?>