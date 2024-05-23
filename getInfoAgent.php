<?php
    include "connexion.php";
    include "encrypt.php";
    
    $id=decrypt($_POST['id']);
    $result=array();
        
    try {
        //code...
        $sql='SELECT * FROM agent a 
                INNER JOIN statut_agent st ON(a.id=st.agent_id) 
                INNER JOIN type_agent t ON(st.type_agent_id=t.id)  
                INNER JOIN affectation aff ON(aff.statut_agent_id=st.id)
                INNER JOIN sous_structure s ON(aff.sous_structure_id=s.id) 
                INNER JOIN poste p ON(aff.poste_id=p.id) WHERE a.id=?';
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