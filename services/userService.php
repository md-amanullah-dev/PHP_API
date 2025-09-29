<?php
require_once __DIR__ . '/../models/userModel.php';

class UserService
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function fetchUsers($search, $startDate, $endDate)
    {
        return $this->userModel->getAllUsers($search, $startDate, $endDate);
    }


    public function userDetails($userId)
    {
        return $this->userModel->userDetails($userId);
    }


    public function addUsers($data)
    {
        return $this->userModel->addUsers($data);
    }
}
