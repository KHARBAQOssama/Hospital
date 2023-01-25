<?php
include __DIR__."/../autoloader.php";

class patient extends User{
    private $birthday;
    private $cin;

    function __construct($full_name, $email, $phone,  $password, $photo, $birthday,$cin, $id = null){
        $this->full_name = $full_name;
        $this->email = $email;
        $this->phone = $phone; 
        $this->password = $password;
        $this->photo = $photo; 
        $this->birthday = $birthday;
        $this->cin = $cin;
        $this->id = $id;
        $this->role = 3;
}

    public function signup(){
        $db = new Db;
        $pdo = $db->connection();
        $sql = "INSERT INTO Users (full_name,email,phone,password,photo,birthday,cin,role_id)
        VALUES (?, ?, ?, ?, ?, ?, ?,?) "; 
        $stmt =  $pdo->prepare($sql);
        $stmt->execute([
            $this->full_name,
            $this->email,
            $this->phone, 
            $this->password,
            $this->photo, 
            $this->birthday,
            $this->cin,
            $this->role
        ]);
    }
}
?>