<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

lecture();

//fonction pour la lecture
function lecture()
{
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        try {
            // Connexion à la base de données
            $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);
    
            $req = "SELECT * FROM encadreur WHERE idencadreur=$id";
    
            $allEnc = array();
    
            $result = $mysqli->query($req);
            while ($row = $result->fetch_assoc()) {
                $allEnc[] = $row;
            }
    
            echo (json_encode([
                'status' => 'success',
                'enc' => $allEnc
            ]));
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo (json_encode([
                'status' => 'error',
                'msg' => $msg
            ]));
        }
    }
}