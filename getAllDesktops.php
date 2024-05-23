<?php
    include "connexion.php";
    include "encrypt.php";

    try {
        //code...
        $attributions=array();
        $sql='SELECT m.* FROM materiel m INNER JOIN type_materiel t ON(m.type_matos_id=t.id) WHERE t.nom_type_matos IN ("Ordinateur Fixe", "All In One");
        ';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $attributions[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($attributions));