<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllUsers($search = null, $startDate = null, $endDate = null) {
        $query = "SELECT userId, userName, firstName, lastName, phone, userImage,createdOn 
                  FROM users 
                  WHERE 1=1";
    
        $params = [];
    
        // ✅ Search filter (firstName or lastName)
        if (!empty($search)) {
            $query .= " AND (firstName LIKE :search OR lastName LIKE :search)";
            $params[':search'] = "%" . $search . "%";
        }
    
        // ✅ Date filter
        if (!empty($startDate) && !empty($endDate)) {
            $query .= " AND DATE(createdOn) BETWEEN :startDate AND :endDate";
            $params[':startDate'] = $startDate;
            $params[':endDate'] = $endDate;
        }
    
        $query .= " ORDER BY userId DESC";
    
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function userDetails($userId) {
        $stmt = $this->pdo->prepare("
            SELECT userId, userName, firstName, lastName, phone, userImage, createdOn
            FROM users
            WHERE userId = :userId
        ");
    
        $stmt->execute([':userId' => $userId]);
    
        return $stmt->fetch(PDO::FETCH_ASSOC); // single user
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
