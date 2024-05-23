<?php
    include "connexion.php";
    include "encrypt.php";
    
    
    $nom_type_matos[]=decrypt($_POST['nom_type_matos']);
    $matos=array();

    try {
        //code...
        $sql='SELECT * FROM materiel m INNER JOIN type_materiel t ON(m.type_matos_id=t.id) WHERE t.nom_type_matos IN ? ';
        $req=$db->prepare($sql);
        $req->execute(array($nom_type_matos));
        while($a= $req->fetch(PDO::FETCH_ASSOC)) {
            # code...
            $matos[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($matos));