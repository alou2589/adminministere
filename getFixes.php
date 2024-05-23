<?php
    include "connexion.php";
    include "encrypt.php";

    try {
        //code...
        $fixes=array();
        $sql='SELECT * FROM materiel s INNER JOIN type_materiel t ON(s.type_matos_id=t.id) WHERE t.nom_type_matos="Ordinateur Fixe"';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $fixes[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($fixes));