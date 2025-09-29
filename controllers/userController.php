<?php
require_once __DIR__ . '/../services/userService.php';

class UserController
{
    private $userService;

    public function __construct($pdo)
    {
        $this->userService = new UserService($pdo);
    }

    public function getUsers()
    {
        header('Content-Type: application/json');
        $users = $this->userService->fetchUsers();

        echo json_encode([
            "status" => "success",
            "data" => $users
        ]);
    }
}
