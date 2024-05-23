<?php
    include "connexion.php";
    include "encrypt.php";

    try {
        //code...
        $directions=array();
        $sql='SELECT * FROM structure s INNER JOIN type_structure t ON(s.type_structure_id=t.id) WHERE t.nom_type_structure="Direction" ';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $directions[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($directions));