<?php
    include "connexion.php";
    include "encrypt.php";
    
    $sousStructures=array();
    
    try {
        //code...
        $sql='SELECT * FROM sous_structure';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $sousStructures[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($sousStructures));