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


        // Frontend se aaye hue search & date filter
        $search = $_GET['search'] ?? null;
        $startDate = $_GET['startDate'] ?? null;
        $endDate = $_GET['endDate'] ?? null;

        $users = $this->userService->fetchUsers($search, $startDate, $endDate);

        echo json_encode([
            "status" => "success",
            "data" => $users
        ]);
    }


    
    public function userDetails()


    {
        header('Content-Type: application/json');


        // Frontend se aaye hue search & date filter
        $userId = $_GET['userId'];

        if ($userId === null || !is_numeric($userId)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Missing or invalid userId"]);
            return;
        }

        $user = $this->userService->userDetails($userId);

        if (!$user) {
            http_response_code(404);
            echo json_encode(["status" => "error", "message" => "User not found"]);
            return;
        }

        echo json_encode([
            "status" => "success",
            "data" => $user
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
