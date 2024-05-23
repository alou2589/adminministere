<?php
    include "connexion.php";
    include "encrypt.php";

    try {
        //code...
        $portables=array();
        $sql='SELECT m.* FROM materiel m INNER JOIN type_materiel t ON(m.type_matos_id=t.id) WHERE t.nom_type_matos="Ordinateur Portable"';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $portables[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($portables));