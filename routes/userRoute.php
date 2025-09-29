<?php
require_once __DIR__ . '/../controllers/userController.php';
// require_once __DIR__ . '/../controllers/AddUserController.php';

function userRoute($pdo, $uri) {
    switch ($uri) {
        case '/getUser':
            $controller = new userController($pdo);
            $controller->getUsers();
            return true;

        case '/addUser':
            $controller = new userController($pdo);
            $controller->addUsers();
            return true;
    }
    return false;
}
