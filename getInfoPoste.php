<?php
    include "connexion.php";
    include "encrypt.php";
    
    $id=decrypt($_POST['id']);
        
    try {
        //code...
        $sql='SELECT * FROM poste WHERE id=?';
        $req=$db->prepare($sql);
        $req->execute(array($id));
        $result=$req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $th) {
        //throw $th;
        echo encrypt(json_encode("Erreur 404"));
    }
    
    echo encrypt(json_encode($result));