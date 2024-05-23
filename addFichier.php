<?php
    include "connexion.php";
    include "encrypt.php";
    
    $data=json_decode(decrypt($_POST['data']));
    $type_fichier_id=$data->type_fichier_id;
    $agent_id=$data->agent_id;
    $marque_manom_fichiertos_id=$data->nom_fichier;
    $fichier=$data->fichier;
    $isOK=false;
    $msg="";
    
    
    //$data=json_decode(decrypt($_POST['data']));
    try {
        //code...
        $sql="INSERT INTO fichiers_agent(type_fichier_id, agent_id, nom_fichier, fichier) 
            VALUES(?,?,?,?) ";
        $req=$db->prepare($sql);
        $req->execute(array($type_fichier_id, $agent_id,$nom_fichier,$fichier));
        if($req){
            $isOK=true;
            $msg="Insertion réussie";
        }
        else{
            $isOK=false;
            $msg="Echec de l'insertion";
        }

    } catch (PDOException $th) {
        //throw $th;
        $isOK=false;
        $msg="Erreur 404";
    }
    echo encrypt(json_encode([
        $isOK,
        $msg
    ]));
    //echo encrypt(json_encode([
    //        $isOK,
    //        $msg
    //]));