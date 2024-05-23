<?php
    include "connexion.php";
    include "encrypt.php";
    
    $divisions=array();
    
    try {
        //code...
        $sql='SELECT * FROM sous_structure s INNER JOIN type_sous_structure t ON(s.type_sous_structure_id=t.id) WHERE t.nom_type_sous_structure="Division" ';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $divisions[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($divisions));