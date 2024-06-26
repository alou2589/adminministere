<?php
    include "connexion.php";
    include "encrypt.php";
    
    $data=json_decode(decrypt($_POST['data']));
    $prenom=$data->prenom;
    $nom=$data->nom;
    $date_naissance=date('Y-m-d',strtotime($data->date_naissance));
    $lieu_naissance=$data->lieu_naissance;
    $genre=$data->genre;
    $telephone=$data->telephone;
    $isOK=false;
    $msg="";
    
    
    //$data=json_decode(decrypt($_POST['data']));
    try {
        //code...
        $agentData=$db->prepare("SELECT id FROM agent WHERE telephone=?");
        $agentData->execute(array($telephone));
        if($agentData->rowCount()>=1){
            $isOK=false;
            $msg="Cet agent existe déjà";
        }
        else {
                $sql="INSERT INTO agent(prenom, nom, date_naissance, lieu_naissance,genre,telephone) 
                    VALUES(?,?,?,?,?,?) ";
                $req=$db->prepare($sql);
                $req->execute(array($prenom, $nom,$date_naissance,$lieu_naissance,$genre,$telephone));
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