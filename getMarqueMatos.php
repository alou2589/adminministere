<?php
    include "connexion.php";
    include "encrypt.php";

    try {
        //code...
        $marques=array();
        $sql='SELECT * FROM marque_matos';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $marques[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($marques));