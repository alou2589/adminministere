<?php
    include "connexion.php";
    include "encrypt.php";
    
    $id=decrypt($_POST['id']);
    $result=array();
        
    try {
        //code...
        $sql='SELECT * FROM attribution a INNER JOIN materiel m ON(m.id=a.matos_id) INNER JOIN agent ag ON(a.agent_id=ag.id) WHERE a.matos_id=?';
        $req=$db->prepare($sql);
        $req->execute(array($id));
        $result[]=$req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $th) {
        //throw $th;
        echo encrypt(json_encode("Erreur 404"));
    }
    
    echo encrypt(json_encode($result));