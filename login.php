<?php
    include "connexion.php";
    include "encrypt.php";
    
    $email= decrypt($_POST['email']);
    $password=decrypt($_POST['password']);
    
    try {
        //code...
        if(isset($email, $password)){
            $req=$db->prepare("SELECT * FROM user WHERE email=?");
            $req->execute(array($email));
            $user=$req->fetch(PDO::FETCH_ASSOC);
            if($user && password_verify($password,$user["password"])){
                $array=$user;
                $success=1;
                $msg="Succés";
            }
            else{
            $success=0;
            $msg="Email ou Mot de passe incorrect";
            }
        }
        else{
            $success=0;
            $msg="Cases Vides";
        }
    } catch (PDOException $th) {
        //throw $th;
     $success=0;
     $msg="Erreur 404";
    }
    
    echo encrypt(json_encode([
        "data"=>[
            $msg,
            $success,
            $array
        ]
    ]));