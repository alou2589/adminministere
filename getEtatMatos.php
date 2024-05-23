<?php
    include "connexion.php";
    include "encrypt.php";
    
    $id=decrypt($_POST['id']);
    $result=array();
        
    try {
        //code...
        $sql='SELECT COUNT(*) AS nbMatos FROM materiel  WHERE id IN(SELECT matos_id FROM ticket) AND id=?';
        $req=$db->prepare($sql);
        $req->execute(array($id));
        $result[]=$req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $th) {
        //throw $th;
        echo encrypt(json_encode("Erreur 404"));
    }
    
    echo encrypt(json_encode($result));