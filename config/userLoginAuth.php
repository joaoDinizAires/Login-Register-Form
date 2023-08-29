<?php
    require_once("connection.php");
    class UserAuth{
        protected $conn;
        public function __construct($conn)
        {
            $this->conn = $conn;
        }
        public function userIsSet($username){
            $stmt = $this->conn->prepare("SELECT username FROM register WHERE username = :username");
            $stmt->bindParam(':username',$username);
            $stmt->execute();
            return $stmt->rowCount() === 1;
            $this->conn = null;
        }
        public function userAuth($username,$givenPassword){
            if($this->userIsSet($username)){
                $stmt = $this->conn->prepare("SELECT password FROM register WHERE username = :username");
                $stmt->bindParam(":username",$username);
                $stmt->execute();
                $storedPassword = $stmt->fetchColumn();
                if (password_verify($givenPassword,$storedPassword)){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }

?>