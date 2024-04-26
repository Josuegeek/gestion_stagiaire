<?php

function getStage($id){
    try {
        // Connexion à la base de données
        $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);
    
        $reqStage = "SELECT * FROM stagiaire_v WHERE id=$id";
        
        $stage = array();
    
        $result = $mysqli->query($reqStage);
        while ($row = $result->fetch_assoc()) {
            $stage[] = $row;
        }
        
        return $stage;
    } 
    catch (Exception $e) {
        return null;
    }
    
}