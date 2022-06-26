<!-- Connect Login Form To Root Database -->
<?php
include_once './validation/Validation.php';

include "root.php";
$db = new data();
$aksi = $_GET["aksi"];
if ($aksi == 'login') {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $val = new Validation();
        $val->name('username')->value($username)->pattern('alpha')->required();
        $val->name('password')->value($password)->customPattern('[A-Za-z0-9-.;_!#@]{5,15}')->required();

        if ($val->isSuccess()) {
            $db->login($username,
                $password);
        } else {
            //echo "Validation error!";
            echo json_encode(['error' => true, 'errors' => $val->getErrors()]);
        }
    }
}
