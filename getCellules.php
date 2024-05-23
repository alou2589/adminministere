<?php
    include "connexion.php";
    include "encrypt.php";
    
    $cellules=array();
    
    try {
        //code...
        $sql='SELECT * FROM sous_structure s INNER JOIN type_sous_structure t ON(s.type_sous_structure_id=t.id) WHERE t.nom_type_sous_structure="Cellule" ';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $cellules[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($cellules));