<?php
    include "connexion.php";
    include "encrypt.php";
    
    $affectations=array();
    
    try {
        //code...
        $sql='SELECT * FROM affectation aff 
                INNER JOIN statut_agent st ON(aff.statut_agent_id=st.id)
                INNER JOIN agent ag ON(st.agent_id=ag.id)';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $affectations[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($affectations));