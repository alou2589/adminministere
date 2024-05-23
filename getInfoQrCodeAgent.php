<?php
    include "connexion.php";
    include "encrypt.php";
    
    $id=decrypt($_POST['id']);
    $result=array();
        
    try {
        //code...
        $sql='SELECT * FROM carte_pro c INNER JOIN agent a ON(c.agent_id=a.id) WHERE c.agent_id=?';
        $req=$db->prepare($sql);
        $req->execute(array($id));
        $result=$req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $th) {
        //throw $th;
        echo encrypt(json_encode("Erreur 404"));
    }
    
    echo encrypt(json_encode($result));