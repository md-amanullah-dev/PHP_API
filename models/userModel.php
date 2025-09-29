<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllUsers(){
        $stmt = $this->pdo->query(
            "SELECT  userId, userName, firstName, lastName, phone, userImage FROM users

            ORDER BY userId  DESC
            "
        );
        return $stmt->fetchAll();
    }


    public function addUsers($data){
        // Hash the password before saving
        echo `data $data`;
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    
        $stmt = $this->pdo->prepare("
            INSERT INTO users (userName, firstName, lastName, phone, userImage, password)
            VALUES (:userName, :firstName, :lastName, :phone, :userImage, :password)
        ");
    
        $stmt->execute([
            ':userName'  => $data['userName'],
            ':firstName' => $data['firstName'],
            ':lastName'  => $data['lastName'] ?? null,
            ':phone'     => $data['phone'] ?? null,
            ':userImage' => $data['userImage'] ?? null,
            ':password'  => $hashedPassword
        ]);
    
        return [
            "id"        => $this->pdo->lastInsertId(),
            "userName"  => $data['userName'],
            "firstName" => $data['firstName'],
            "lastName"  => $data['lastName'] ?? null,
            "phone"     => $data['phone'] ?? null,
            "userImage" => $data['userImage'] ?? null
            // password return karne ki zarurat nahi hai API response me
        ];
    }
    

}
