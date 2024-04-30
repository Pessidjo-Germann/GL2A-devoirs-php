<?php

require_once 'config.php';
require_once 'controller/AdminController.php';
require_once 'modele/AdminModel.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

$adminModel = new AdminModel($db);
$adminController = new AdminController($adminModel);

switch($action) {
    case 'register':
        $adminController->register();
        break;
    case 'login':
        $adminController->login();
        break;
    default:
        echo "404 Not Found";
        break;
}

?>
