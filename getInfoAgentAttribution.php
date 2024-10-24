<?php
    include "connexion.php";
    include "encrypt.php";
    
    $id=decrypt($_POST['id']);
    $result=array();
        
    try {
        //code...
        $sql='SELECT * FROM attribution a 
                INNER JOIN materiel m ON(a.matos_id=m.id) 
                INNER JOIN affectation aff ON(a.affectation_id=aff.id)
                INNER JOIN statut_agent sa ON(aff.statut_agent_id=sa.id)
                INNER JOIN agent ag ON(aff.agent_id=ag.id)
                INNER JOIN type_materiel t ON(m.type_matos_id=t.id)
                WHERE a.affectation_id=?';
        $req=$db->prepare($sql);
        $req->execute(array($id));
        while($a=$req->fetch(PDO::FETCH_ASSOC)){
            $result[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
        echo encrypt(json_encode("Erreur 404"));
    }
    
    echo encrypt(json_encode($result));