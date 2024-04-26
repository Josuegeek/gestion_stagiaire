<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

try{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);
    
        //debut de la transaction
        $mysqli->begin_transaction();
        
        //$id = getLastIndex();
    
        $req =  "DELETE FROM stagiaire WHERE id='$id'";
        //echo "$req";
    
        if ($mysqli->query($req)) {
            //echo "$req PASSED";
            //$req = "DELETE FROM stage WHERE id = '$idStage'";
            $_SESSION["successMsg"] = "Suppresion Réussie";
            $mysqli->commit();
            $mysqli->close();
            /*
            if($mysqli->query($req)){
                //fin de la transcation
                $mysqli->commit();
                $mysqli->close();
                $_SESSION["successMsg"] = "Suppresion Réussie";
            }
            else{
                $_SESSION["errorMsg"] = "Erreur pendant la Sppression de stage";
            }
            */
        }
    
        else{
            $_SESSION["errorMsg"] = "Erreur pendant la Sppression de stagiaire";
        }
    }
    else{
        $_SESSION["errorMsg"] = "Erreur de Get";
    }
    
    header('Location: ../list.php');
}
catch(Exception $e){
    $_SESSION["errorMsg"] = $e->getMessage();
    header('Location: ../list.php');
}