<?php
    include "connexion.php";
    include "encrypt.php";
    
    $data=json_decode(decrypt($_POST['data']));
    $statut_agent_id=$data->statut_agent_id;
    $sous_structure_id=$data->sous_structure_id;
    $poste_id=$data->poste_id;
    $status_affectation=$data->status_affectation;
    $date_affectation=date('Y-m-d',strtotime($data->date_affectation));
    $isOK=false;
    $msg="";
    
    
    //$data=json_decode(decrypt($_POST['data']));
    try {
        //code...
        $affectationData=$db->prepare("SELECT id FROM affectation WHERE statut_agent_id=? AND status_affectation='en service' ");
        $affectationData->execute(array($statut_agent_id));
        if($affectationData->rowCount()>=1){
            $isOK=false;
            $msg="Cet agent est toujours en service";
        }
        else {
                $sql="INSERT INTO affectation(statut_agent_id, sous_structure_id, poste_id, status_affectation,date_affectation) 
                    VALUES(?,?,?,?,?,?) ";
                $req=$db->prepare($sql);
                $req->execute(array($statut_agent_id, $sous_structure_id,$poste_id,$status_affectation,$date_affectation));
                if($req){
                    $isOK=true;
                    $msg="Insertion réussie";
                }
                else{
                    $isOK=false;
                    $msg="Echec de l'insertion";
                }
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