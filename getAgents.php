<?php
    include "connexion.php";
    include "encrypt.php";
    
    $agents=array();
    
    try {
        //code...
        $sql='SELECT * FROM agent ';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $agents[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($agents));