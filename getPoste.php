<?php
    include "connexion.php";
    include "encrypt.php";
    
    $postes=array();
    
    try {
        //code...
        $sql='SELECT * FROM poste';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $postes[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($postes));