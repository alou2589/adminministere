<?php
    include "connexion.php";
    include "encrypt.php";

    try {
        //code...
        $fournisseurs=array();
        $sql='SELECT * FROM fournisseur';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $fournisseurs[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($fournisseurs));