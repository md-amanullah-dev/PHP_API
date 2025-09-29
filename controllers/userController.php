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


    public function addUsers()
    {
        header('Content-Type: application/json');

        // ✅ Read raw POST data
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input || !isset($input['userName']) || !isset($input['firstName']) || !isset($input['password'])) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => "Invalid input"
            ]);
            return;
        }

        $user = $this->userService->addUsers($input);

        echo json_encode([
            "status" => "success",
            "message" => "User added successfully",
            "data" => $user
        ]);
    }
}
