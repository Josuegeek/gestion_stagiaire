<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);

$reqAllStageCount = "SELECT * FROM stage";
$reqProStageCount = "SELECT * FROM stagiaire_pro";
$reqEncadreur = "SELECT * FROM encadreur";
$reqAcademicStageCount = "SELECT * FROM stagiaire_academique";
$reqAllFinishedStage = "SELECT * FROM stage WHERE status LIKE '%terminé%' OR status LIKE '%termine%'";

// Exécution des requetes..
$allStageCount = $mysqli->query($reqAllStageCount)->num_rows;
$proStageCount =  $mysqli->query($reqProStageCount)->num_rows;
$academicStageCount =  $mysqli->query($reqAcademicStageCount)->num_rows;
$finishedStageCount =  $mysqli->query($reqAllFinishedStage)->num_rows;

$result = $mysqli->query($reqProStageCount);
//printf($result);
//remplissage du tableau des encadreurs
$encadreur = array();

$result = $mysqli->query($reqEncadreur);
while ($row = $result->fetch_assoc()) {
    $encadreur[] = $row;
}

$encNum = getLastIndexOfEnc();

function getLastIndexOfEnc()
{
    try {
        $num = 0;

        // Connexion à la base de données
        $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);

        $sql = "SELECT * FROM encadreur ORDER BY idencadreur DESC
        LIMIT 1";
        // Exécution de la requête SELECT
        $result = $mysqli->query($sql);

        if (mysqli_num_rows($result) > 0) {
            $accord = mysqli_fetch_assoc($result);
            $id = $accord['idencadreur'];
            $num = $id + 1;
        } else {
            $num = 1;
        }
        //echo "<script>let STAGE_NUM=$num;</script>";
        return $num;
    } catch (Exception $ex) {
        $msg =  $ex->getMessage();
        //echo "<script>console.log('Error','$msg');</script>";
        $_SESSION["errorMsg"] = "Erreur pendant la récup du dernier index";
    }
}

