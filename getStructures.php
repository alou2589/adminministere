<?php
    include "connexion.php";
    include "encrypt.php";
    
    $structures=array();
    
    try {
        //code...
        $sql='SELECT * FROM structure';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $structures[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($structures));