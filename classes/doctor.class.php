<?php
include __DIR__."/../autoloader.php";


class Doctor extends User{

    function __construct($full_name, $email, $phone,  $password, $photo,  $speciality, $id = null){
                        $this->full_name = $full_name;
                        $this->email = $email;
                        $this->phone = $phone; 
                        $this->password = $password;
                        $this->photo = $photo; 
                        $this->speciality = $speciality;
                        $this->id = $id;
                        $this->role = 2;
    }

    public function createDoctor(){
        $db = new Db;
        $pdo = $db->connection();
        $sql = "SELECT * FROM Users WHERE Users.email=?";
        $query =  $pdo->prepare($sql);
        $query->execute([$this->email]);
        $count = $query->rowCount();
        if($count == 0){
            $sql = "INSERT INTO Users  (full_name  email , phone , password , photo , role_id , doc_speciality_id) 
                    VALUES (?,?,?,?,?,?,?)";
                    $query =  $pdo->prepare($sql);
                    $query ->execute([$this->full_name,
                        $this->email,
                        $this->phone, 
                        $this->password,
                        $this->photo, 
                        $this->role, 
                        $this->doc_speciality_id]);
                        if($query){
                            $_SESSION['doctorAdded'] = 'doctor added successfully';
                            header('location: ./../dashboard_admin.php');
                        }else{
                            $_SESSION['failed'] = 'something goes wrong';
                            header('location: ./../dashboard_admin.php');
                        }
                        
                }else{
            $_SESSION['failed'] = 'The email is already exist !!';
            header('location: ./../dashboard_admin.php');
        }
    }


    public static function removeDoctor($doctorId){
        $db = new Db;
        $pdo = $db->connection();
        $sql = "DELETE FROM Users WHERE Users.id = ? ";
        $query =  $pdo->prepare($sql);
        $query->execute([$doctorId]);
        if($query){
            $_SESSION['doctorDeleted'] = 'doctor has been removed !';
        }else{
            $_SESSION['failed'] = 'something goes wrong';
        }
    }

    public function updateDoctor(){
        $db = new Db;
        $pdo = $db->connection();
        $sql = "UPDATE Users SET full_name = ? , email = ? , phone = ? , password = ? , photo = ? , doc_speciality_id = ? 
                    WHERE Users.id = ?";
        $query =  $pdo->prepare($sql);
        $query ->execute([$this->full_name,
                        $this->email,
                        $this->phone, 
                        $this->password,
                        $this->photo, 
                        $this->speciality,
                        $this->id]);
        if($query){
            $_SESSION['doctorUpdated'] = 'doctor has been Updated !';
            header('location: ./../dashboard_admin.php');
        }else{
            $_SESSION['failed'] = 'something goes wrong';
            header('location: ./../dashboard_admin.php');
        }
    }
}