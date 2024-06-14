<?php
    include "connexion.php";
    include "encrypt.php";
    
    $id=decrypt($_POST['id']);
    $result=array();
        
    try {
        //code...
        $sql='SELECT * FROM carte_pro c 
        INNER JOIN affectation aff ON(c.affectation_id=aff.id)
        INNER JOIN statut_agent st ON(aff.statut_agent_id=st.id)
        INNER JOIN agent a ON(st.agent_id=a.id) WHERE c.affectation_id=?';
        $req=$db->prepare($sql);
        $req->execute(array($id));
        $result=$req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $th) {
        //throw $th;
        echo encrypt(json_encode("Erreur 404"));
    }
    
    echo encrypt(json_encode($result));