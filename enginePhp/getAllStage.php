<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

try {
    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);

    $reqAllStage = "SELECT * FROM stagiaire_v";
    $reqProStage = "SELECT * FROM stagiaire_pro";
    $reqAcademicStage = "SELECT * FROM stagiaire_academique";
    $reqAllFinishedStage = "SELECT * FROM stagiaire_v WHERE status='%Termine%' OR status='%fini%' OR status LIKE '%Terminé%'";

    $allStage = array();
    $proStage = array();
    $academicStage = array();
    $finishedStage = array();

    $result = $mysqli->query($reqAllStage);
    while ($row = $result->fetch_assoc()) {
        $allStage[] = $row;
    }

    $result = $mysqli->query($reqProStage);
    while ($row = $result->fetch_assoc()) {
        $proStage[] = $row;
    }

    $result = $mysqli->query($reqAcademicStage);
    while ($row = $result->fetch_assoc()) {
        $academicStage[] = $row;
    }

    $result = $mysqli->query($reqAllFinishedStage);
    while ($row = $result->fetch_assoc()) {
        $finishedStage[] = $row;
    }

    echo (json_encode([
        'status' => 'success',
        'allStage' => $allStage,
        'finishedStage' => $finishedStage,
        'proStage' => $proStage,
        'academicStage' => $academicStage
    ]));
} 
catch (Exception $e) {
    $msg = $e->getMessage();
    echo (json_encode([
        'status' => 'error',
        'msg' => $msg
    ]));
}
