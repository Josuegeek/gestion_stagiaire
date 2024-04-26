<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

try{
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $departement = $_POST['dept'];
        $fonction = $_POST['fonction'];
        $type_stage = $_POST['type'];
        $date_debut = $_POST['date_debut'];
        $duree = $_POST['duree'];
        $status = $_POST['status'];
        $nom = $_POST['nom'];
        $lieu_naiss = $_POST['lieu-naissance'];
        $date_naiss = $_POST['date-naissance'];
        $prov_origin = $_POST['prov-origin'];
        $district = $_POST['district-origin'];
        $village = $_POST['village-origin'];
        $adresse =  $_POST['adresse'];
        $tel = $_POST['tel'];
        $fac = $_POST['fac'];
        $dept = $_POST['departement'];
        $supervision = $_POST['supervision'];
    
        $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);
    
        //debut de la transaction
        $mysqli->begin_transaction();
        
        //$id = getLastIndex();
    
        $req =  "UPDATE stagiaire SET nom_complet='$nom', date_naissance='$date_naiss', lieu_naissance='$lieu_naiss', 
                province='$prov_origin', district='$district', village='$village', adresse='$adresse', 
                telephone='$tel', dept_fac='$dept', fac='$fac', directeur='$supervision'
                    WHERE id='$id'";
    
        if ($mysqli->query($req)) {
            $req = "UPDATE stage SET type_stage='$type_stage', date_debut='$date_debut', duree='$duree', 
                    departement='$departement', fonction='$fonction', status='$status'
                        WHERE id = '$idStage'";
            
            if($mysqli->query($req)){
                //fin de la transcation
                $mysqli->commit();
                $mysqli->close();
                $_SESSION["successMsg"] = "Modification Réussie";
            }
            else{
                $_SESSION["errorMsg"] = "Erreur pendant la Modification de stage";
            }
        }
    
        else{
            $_SESSION["errorMsg"] = "Erreur pendant la Modification de stagiaire";
        }
    }
    else{
        $_SESSION["errorMsg"] = "Erreur de post";
    }
    
    header('Location: ../form.php');
}
catch(Exception $e){
    $_SESSION["errorMsg"] = $e->getMessage();
    header('Location: ../form.php');
}