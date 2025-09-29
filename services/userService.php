<?php
require_once __DIR__ . '/../models/userModel.php';

class UserService
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function fetchUsers()
    {
        return $this->userModel->getAllUsers();
    }


    public function addUsers($data)
    {
        return $this->userModel->addUsers($data);
    }
}
