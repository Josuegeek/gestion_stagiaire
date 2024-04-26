<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

try{
    $show = print_r($_POST['dept']);
    //echo "<script>alert($show, 'you');</script>";
    if (isset($_POST['dept'])) {
        $departement = $_POST['dept'];
        $fonction = $_POST['fonction'];
        $type_stage = $_POST['type'];
        $date_debut = $_POST['date_debut'];
        $duree = $_POST['duree'];
        
        //status computing
        $status = "";
        $todayTimeStamp = strtotime(date("Y-m-d"));
        $date_debutTimeStamp = new DateTime($date_debut);
        
        $dateInterval = new DateInterval("P$duree"."M");
        
        $date_fin = $date_debutTimeStamp->add($dateInterval);
        $date_fin_timestamp=$date_fin->getTimestamp();
        if($date_fin_timestamp > $todayTimeStamp){
            if(date('m', $todayTimeStamp)==date('m', $date_fin_timestamp) && date('Y', $todayTimeStamp)==date('Y', $date_fin_timestamp)){
                $status = "En cours (fini ce mois)";
            }
            else{
                $status = "En cours";
            }
            //$diffDate = ($todayTimeStamp - $date_debutTimeStamp) / 86400;
        }
        else if($todayTimeStamp == $date_fin_timestamp){
            $status = "Terminé (today)";
        }
        else{
            $status = "Terminé";
        }

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
        
        $id = getLastIndex();
    
        $req =  "INSERT INTO stagiaire(id,nom_complet, date_naissance, lieu_naissance, province, district, 
                                        village, adresse, telephone, dept_fac, fac, directeur)
                    VALUES ('$id','$nom', '$date_naiss', '$lieu_naiss', '$prov_origin', '$district', '$village'
                            , '$adresse', '$tel', '$dept', '$fac', '$supervision')";
        echo $req;
    
        if ($mysqli->query($req)) {
            $req = "INSERT INTO stage(type_stage, date_debut, duree, departement, fonction, 
                                status, id_stagiaire)
                        VALUES ('$type_stage', '$date_debut', '$duree', '$departement', '$fonction', '$status'
                        , '$id')";
            
            if($mysqli->query($req)){
                //fin de la transcation
                $mysqli->commit();
                $mysqli->close();
                $_SESSION["successMsg"] = "Insertion Réussie";
            }
            else{
                $_SESSION["errorMsg"] = "Erreur pendant l'insertion de stage";
            }
        }
    
        else{
            $_SESSION["errorMsg"] = "Erreur pendant l'insertion de stagiaire";
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


function getLastIndex()
{
    try {
        $num = 0;

        // Connexion à la base de données
        $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);

        $sql = "SELECT * FROM stagiaire ORDER BY id DESC
        LIMIT 1";
        // Exécution de la requête SELECT
        $result = $mysqli->query($sql);

        if (mysqli_num_rows($result) > 0) {
            $accord = mysqli_fetch_assoc($result);
            $id = $accord['id'];
            $num = $id + 1;
        } else {
            $num = 1;
        }

        return $num;
    } catch (Exception $ex) {
        $msg =  $ex->getMessage();
        echo "<script>console.log('Error','$msg');</script>";
        $_SESSION["errorMsg"] = "Erreur pendant la récup du dernier index";
    }
}
