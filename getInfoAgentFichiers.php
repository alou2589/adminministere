<?php
    include "connexion.php";
    include "encrypt.php";
    
    $id=decrypt($_POST['id']);
    $result=array();
        
    try {
        //code...
        $sql='SELECT * FROM fichiers_agent f 
                INNER JOIN agent a ON(a.id=f.agent_id) 
                INNER JOIN type_fichier t ON(t.id=f.type_fichier_id)
                WHERE f.agent_id=?';
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