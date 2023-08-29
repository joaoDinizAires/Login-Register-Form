<?php
    require_once("connection.php");
    class UserVerify{
        protected $conn;
        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        public function userLength($username){//Verifica se o usuario tem mais de 8 caracteres
            $verified = strlen($username) >= 5 ? $username : false;
            return $verified;
        }
        public function userAvailable($username){//Verifica se o usuario ja foi cadastrado no banco de dados
            $stmt = $this->conn->prepare("SELECT username FROM register WHERE username = :username");
            $stmt->bindParam(':username',$username);
            $stmt->execute();
            return $stmt->rowCount() === 0;
            $this->conn = null;
        }
        public function emailAvailable($email){//Verifica se o email ja foi cadastrado no banco de dados
            $stmt = $this->conn->prepare("SELECT email FROM register WHERE email = :email");
            $stmt->bindParam(':email',$email);
            $stmt->execute();
            return $stmt->rowCount() === 0;
            $this->conn = null;

        }
        public function validatePassword($password){//verifica se a senha contém letra maiscula e caracteres especiais
            $regExPattern ='/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/';
            return preg_match($regExPattern,$password) === 1;
        }
        public function validateConfirmPassword($password,$confirmPassword){//verifica se as duas senhas são iguais
            return $password === $confirmPassword;
        }

    }
?>