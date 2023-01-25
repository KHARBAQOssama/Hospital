<?php
include __DIR__."/../autoloader.php";

class User{

    protected $id;
    protected $full_name;
    protected $email;
    protected $phone;
    protected $photo;
    protected $password;
    protected $cin;
    protected $role;

    public function __construct($full_name, $email, $phone, $password, $id = null, $cin = null, $role = null, $photo = null){
        $this->id = $id;
        $this->full_name = $full_name;
        $this->cin = $cin;
        $this->role = $role;
        $this->email = $email;
        $this->phone = $phone;
        $this->photo = $photo;
        $this->password = $password;
    }

    public function __get($var){
        return $this->$var;
    }

    public function __set($var,$val){
        $this->$var = $val;
    }

    static function signIn($user,$password){
        $conn = new Db;
        $pdo = $conn->connection();
        $request = "SELECT * FROM users WHERE email = '$user'";
        $statement = $pdo->prepare($request);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}