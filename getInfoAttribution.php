<?php
    include "connexion.php";
    include "encrypt.php";
    
    $id=decrypt($_POST['id']);
    $result=array();
        
    try {
        //code...
        $sql='SELECT * FROM attribution a INNER JOIN materiel m ON(a.matos_id=m.id) 
                INNER JOIN affectation aff ON(a.affectation_id=aff.id)
                INNER JOIN statut_agent st ON(st.agent_id=ag.id)
                INNER JOIN agent ag ON() WHERE a.matos_id=?';
        $req=$db->prepare($sql);
        $req->execute(array($id));
        $result=$req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $th) {
        //throw $th;
        echo encrypt(json_encode("Erreur 404"));
    }
    
    echo encrypt(json_encode($result));