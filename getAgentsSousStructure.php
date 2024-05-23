<?php
    include "connexion.php";
    include "encrypt.php";
    
    $id=decrypt($_POST['id']);
    $result=array();
        
    try {
        //code...
        $sql='SELECT * FROM sous_structure s 
                INNER JOIN affectation aff ON(aff.sous_structure_id=s.id)
                INNER JOIN statut_agent st ON(aff.statut_agent_id=st.id)
                INNER JOIN agent a ON(st.agent_id=a.id) WHERE s.id=?';
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