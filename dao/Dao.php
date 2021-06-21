<?php

class Dao
{
    public $dbh;


    public function __construct()
    {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname= conferences;charset=utf8', 'mysql', 'mysql');
        } catch (PDOException $e) {
            print "Has errors: " . $e->getMessage();  die();
        }
    }


    public function UserRegistration(User $user){
        if($this->CheckUser($user)){
            throw new InsertException('Пользователь с таким email уже существует!');
        }
        $sql = "INSERT INTO `users` (`email`, `password`, `user_name`) VALUES (?, ?, ?)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $user->getEmail(),
            md5($user->getPassword()),
            $user->getName()
        ]);
        $this->SaveSessionBD($user);
        $_SESSION['email'] = $user->getEmail();
        mkdir("../performance/".$_SESSION['email'], 0700);
        mkdir("../presentation/".$_SESSION['email'], 0700);
    }

    public function LoginUser(User $user){
        if($this->CheckUserAndPassword($user)){
            $this->SaveSessionBD($user);
            $_SESSION['email'] = $user->getEmail();
            return true;
        }
        return false;
    }



    public function CheckUser(User $user){
        $sql = "SELECT * FROM users WHERE `email`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
                $user->getEmail()
            ]);
        $count = count($stmt->fetchAll(PDO::FETCH_OBJ));
        if($count==0){
            return false;
        }
        return  true;
    }



    public function CheckUserAndPassword(User $user){
        $sql = "SELECT * FROM users WHERE `email`=? and `password`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $user->getEmail(),
            md5($user->getPassword())
        ]);
        $count = count($stmt->fetchAll(PDO::FETCH_OBJ));
        if($count==0){
            return false;
        }
        return true;
    }


    public function SaveSessionBD(User $user){
        $sql = "UPDATE `users` SET `session_id`=?, `session_time`=? WHERE `email`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            htmlspecialchars(session_id()),
            date("Y-m-d H:i:s"),
            $user->getEmail()
        ]);

    }

    public function CheckSession(User $user){
        $sql = "SELECT * FROM users WHERE `email`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $user->getEmail()
        ]);
        foreach ($stmt as $returnedUser){
            $diffHours = date_diff(new DateTime(date('Y-m-d H:i:s')), new DateTime($returnedUser['session_time']))->h;
            if($diffHours<10 && $returnedUser['session_id'] == $user->getSessionId()){
                return  true;
            }
        }
        return false;
    }

    public function addApplication(Application $application, $email){
        $sql = "SELECT id FROM users WHERE `email`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $email
        ]);
        $user_id = null;
        foreach ($stmt as $returnedUser){
            $user_id = $returnedUser['id'];
        }
        $sql = "INSERT INTO `applications` (`name`, `user_description`, `subject`, `description`, `performance`, `presentation`, `user_id`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $application->getName(),
            $application->getUserDescription(),
            $application->getSubject(),
            $application->getDescription(),
            $application->getPerformance(),
            $application->getPresentation(),
            $user_id
        ]);
    }

    public function searchApplication($applicationId){
        $sql = "SELECT * FROM applications WHERE `id`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $applicationId
        ]);
        return $stmt;
    }

    public function receiveApplcation($email){
        $sql = "SELECT id FROM users WHERE `email`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $email
        ]);
        $user_id = null;
        foreach ($stmt as $returnedUser){
            $user_id = $returnedUser['id'];
        }
        $sql = "SELECT * FROM applications WHERE `user_id`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $user_id
        ]);
        return $stmt;
    }

    public function receiveNameUser($email){
        $sql = "SELECT `user_name` FROM users WHERE `email`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $email
        ]);
        foreach ($stmt as $id){
            return $id['user_name'];
        }
    }

}