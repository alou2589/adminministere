<?php
    include "connexion.php";
    include "encrypt.php";
    
    $type_matos=array();
    
    try {
        //code...
        $sql='SELECT * FROM type_materiel';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $type_matos[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($type_matos));