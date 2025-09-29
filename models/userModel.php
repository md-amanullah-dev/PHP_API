<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllUsers()
    {
        $stmt = $this->pdo->query("SELECT  userName, firstName, lastName, phone, userImage FROM users");
        return $stmt->fetchAll();
    }
}
