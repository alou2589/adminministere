<?php
    include "connexion.php";
    include "encrypt.php";
    
    $data=json_decode(decrypt($_POST['data']));
    $hierarchie=$data->hierarchie;
    $grade=$data->grade;
    $echelon=$data->echellon;
    $date_prise_service=date('Y-m-d',strtotime($data->date_prise_service));
    $date_avancement=date('Y-m-d',strtotime($data->date_avancement));
    $date_debut_ministere=date('Y-m-d',strtotime($data->date_debut_ministere));
    $type_agent_id=$data->type_agent_id;
    $agent_id=$data->agent_id;
    $matricule=$data->matricule;
    $fonction=$data->fonction;
    $type_agent_id=$data->type_agent_id;
    $isOK=false;
    $msg="";
    
    
    //$data=json_decode(decrypt($_POST['data']));
    try {
        //code...
        $statutAgent=$db->prepare("SELECT id FROM statut_agent  WHERE agent_id=? ");
        $statutAgent->execute(array($agent_id));
        if($statutAgent->rowCount()>=1){
            $isOK=false;
            $msg="Cet agent existe déjà";
        }
        else {
                $sql="INSERT INTO statut_agent(echellon,grade, hierarchie, date_prise_service,date_avancement,type_agent_id,matricule,fonction,agent_id) 
                    VALUES(?,?,?,?,?,?,?,?,?,?) ";
                $req=$db->prepare($sql);
                $req->execute(array($echelon, $grade,$hierarchie,$date_prise_service,$date_avancement,$date_debut_ministere,$type_agent_id, $matricule, $fonction, $agent_id));
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