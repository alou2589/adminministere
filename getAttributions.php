<?php
    include "connexion.php";
    include "encrypt.php";

    try {
        //code...
        $attributions=array();
        $sql='SELECT * FROM attribution';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $attributions[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($attributions));