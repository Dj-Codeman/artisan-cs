<?php
require_once('static/html/index.html');

class UserData {
    public $clientid;
    public $servname;
    public $username;
    public $password;

    public function __construct($clientid, $servname, $username, $password) {
        $this->clientid = $clientid;
        $this->servname = $servname;
        $this->username = $username;
        $this->password = $password;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processing the user data
    $data = new UserData($_POST['clientid'], $_POST['servname'], $_POST['username'], $_POST['password']);
    $jsonData = json_encode($data);

    shell_exec("doas bash static/scripts/prep.sh");
    shell_exec("bash static/scripts/storage.sh " . $data->clientid . " '$jsonData'");

    header('Location: static/html/success.html');
    exit;
}

?>

