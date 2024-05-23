<?php
    include "connexion.php";
    include "encrypt.php";
    
    $type_agents=array();
    
    try {
        //code...
        $sql='SELECT * FROM type_agent';
        $req=$db->query($sql);
        while($a= $req->fetch()) {
            # code...
            $type_agents[]=$a;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
    
    echo encrypt(json_encode($type_agents));