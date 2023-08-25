<?php
require_once 'encrypt.php';

class UserData {
    public $servname;
    public $username;
    public $password;

    public function __construct($servname, $username, $password) {
        $this->servname = $servname;
        $this->username = $username;
        $this->password = $password;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processing the user data
    $data = new UserData($_POST['servname'], $_POST['username'], $_POST['password']);
    $jsonData = json_encode($data);

    // Creating a password based on the users id
    $b64_key = base64_encode($_POST['clientid']);
    $hashAlgorithm = 'sha256';
    $iterations = 10000;
    $outputLength = 32; // 32 bytes (256 bits)
    $key = hash_pbkdf2($hashAlgorithm, $b64_key, '', $iterations, $outputLength, true);

    $cipherdata = encrypt($key, $jsonData);
    $filename = "./data/";
    $filename += $_POST['clientid'];
    $filename += ".sec";

    $file = fopen($filename, 'x');

    if ($file) {
        // Write data to the file
        fwrite($file, $cipherdata);

        // Close the file
        fclose($file);
    } else {
        echo "Failed to open the file.";
    }


    header('Location: success.html');
    exit;
}

?>

