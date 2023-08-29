<?php
require_once("connection.php");
include_once("userVerify.php");
include_once("userLoginAuth.php");
session_start();

if (isset($_POST['acao'])) {
    $acao = $_POST['acao'];
    $data = $_POST;
    switch ($acao) {
        case "login":
            $userAuth = new UserAuth($conn);
            $verifications = array(
                "userIsSet" => $userAuth->userIsSet($data['username']),
                "userAuthenticated" => $userAuth->userAuth($data['username'], $data['password'])
            );
            $messages = array(
                "userIsSet" => "Usuário não cadastrado",
                "userAuthenticated" => "Senha incorreta"
            );
            foreach ($verifications as $key => $value) {
                if (!$value) {
                    $_SESSION['errorMessage'] = $messages[$key];
                    break;
                }
            }
            if ($verifications['userIsSet'] && $verifications['userAuthenticated']) {
                $_SESSION['successMessage'] = "Usuário Logado com sucesso";
            }
            $conn = null;
            header("Location: ../login.php");
            break;
            die();
        case "register":
            $userVerify = new UserVerify($conn);
            $verifications = array(
                "userLength" => $userVerify->userLength($data['name']),
                "userName" => $userVerify->userAvailable($data['name']),
                "email" => $userVerify->emailAvailable($data['email']),
                "password" => $userVerify->validatePassword($data['password']),
                "confirmPassword" => $userVerify->validateConfirmPassword($data['password'], $data['confirmpassword'])
            );
            $allConditionsMet = true;
            $messages = array(
                "userLength" => "Nome de usuário deve ter no mínimo 5 caracteres.",
                "userName" => "O nome de usuário já está em uso.",
                "email" => "O email já está em uso.",
                "password" => "A senha não atende aos requisitos.",
                "confirmPassword" => "As senhas não coincidem."
            );
            foreach ($verifications as $key => $value) {
                if (!$value) {
                    $_SESSION["errorMessage"] = $messages[$key];
                    $allConditionsMet = false;
                    break;
                }
            }
            if ($allConditionsMet) {
                $username = trim($data['name']);
                $email = trim($data['email']);
                $passwrdHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $query = "INSERT INTO register (username,email,password) VALUES (:username,:email,:password)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":password", $passwrdHash);
                $stmt->execute();
                $_SESSION['successMessage'] = "Usuário cadastrado com sucesso";
            }
            $conn = null;
            header("Location: ../register.php");
            break;
            die();
    }
}
