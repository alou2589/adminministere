<?php
    include "connexion.php";
    include "encrypt.php";
    
    $nom_type_matos=decrypt($_POST['nom_type_matos']);
    $result=array();
        
    try {
        //code...
        $sql='SELECT m.* FROM materiel m INNER JOIN type_materiel t ON(m.type_matos_id=t.id) WHERE m.id NOT IN(SELECT matos_id FROM attribution) AND t.nom_type_matos LIKE ?';
        $req=$db->prepare($sql);
        $req->execute(array($nom_type_matos));
        while($a=$req->fetch(PDO::FETCH_ASSOC)){
            $result[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
        echo encrypt(json_encode("Erreur 404"));
    }
    
    echo encrypt(json_encode($result));