<?php 
    define('host',"mysql:host=127.0.0.1;dbname=loginform");
    define('user','root');
    define('passwrd','');
    try{
        $conn = new PDO(host,user,passwrd);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "ERRO:". $e->getMessage();
        die();
    }
?>