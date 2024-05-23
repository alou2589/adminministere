<?php
    include "connexion.php";
    include "encrypt.php";
    
    $data=json_decode(decrypt($_POST['data']));
    $hierarchie=$data->hierarchie;
    $grade=$data->grade;
    $echelon=$data->echellon;
    $date_prise_service=date('Y-m-d',strtotime($data->date_prise_service));
    $date_avancement=date('Y-m-d',strtotime($data->date_avancement));
    $agent_id=$data->agent_id;
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
                $sql="INSERT INTO statut_agent(agent_id,echellon,grade, hierarchie, date_prise_service,date_avancement) 
                    VALUES(?,?,?,?,?,?) ";
                $req=$db->prepare($sql);
                $req->execute(array($agent_id, $echelon,$grade,$hierarchie,$date_prise_service,$date_avancement));
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