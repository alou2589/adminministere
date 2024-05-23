<?php
    include "connexion.php";
    include "encrypt.php";
    
    $data=json_decode(decrypt($_POST['data']));
    $type_matos_id=$data->type_matos_id;
    $fournisseur_id=$data->fournisseur_id;
    $marque_matos_id=$data->marque_matos_id;
    $modele_matos=$data->modele_matos;
    $sn_matos=$data->sn_matos;
    $info_matos=$data->info_matos;
    $date_reception=date('Y-m-d',strtotime($data->date_reception));
    $isOK=false;
    $msg="";
    
    
    //$data=json_decode(decrypt($_POST['data']));
    try {
        //code...
        $matosData=$db->prepare("SELECT id FROM materiel WHERE sn_matos=?");
        $matosData->execute(array($sn_matos));
        if($matosData->rowCount()>=1){
            $isOK=false;
            $msg="Ce matériel existe déjà";
        }
        else {
                $sql="INSERT INTO materiel(type_matos_id, fournisseur_id, marque_matos_id, modele_matos,sn_matos,date_reception,info_matos) 
                    VALUES(?,?,?,?,?,?,?) ";
                $req=$db->prepare($sql);
                $req->execute(array($type_matos_id, $fournisseur_id,$marque_matos_id,$modele_matos,$sn_matos,$date_reception,$info_matos));
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