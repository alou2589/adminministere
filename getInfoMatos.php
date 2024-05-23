<?php
    include "connexion.php";
    include "encrypt.php";
    
    $id=decrypt($_POST['id']);
    $nom_type_matos=decrypt($_POST['nom_type_matos']);
    $result=array();
        
    try {
        //code...
        $sql='SELECT * FROM materiel m INNER JOIN type_materiel t ON(m.type_matos_id=t.id) INNER JOIN marque_matos mm ON(m.marque_matos_id=mm.id) 
                INNER JOIN fournisseur f ON(m.fournisseur_id=f.id) WHERE m.id=? AND t.nom_type_matos=?';
        $req=$db->prepare($sql);
        $req->execute(array($id,$nom_type_matos));
        while($a=$req->fetch(PDO::FETCH_ASSOC)){
            $result[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
        echo encrypt(json_encode("Erreur 404"));
    }
    
    echo encrypt(json_encode($result));