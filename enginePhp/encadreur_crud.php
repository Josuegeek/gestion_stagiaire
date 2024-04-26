<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}


if (isset($_GET['id']) || isset($_GET['op'])) {
    if (isset($_GET['op']) && $_GET['op'] == "delete") {
        delete();
    } else if (isset($_GET['op']) && $_GET['op'] == "lecture") {
        lecture();
    } else {
        $_SESSION["errorMsg"] = "Paramètres invalids";
        header('Location: ../encadreur.php');
    }
} else if (isset($_POST['id'])) {
    if ($_POST['op'] == "insert") {
        echo "insertion";
        insertion();
    } else if ($_POST['op'] == "edit") {
        echo "edition";
        edit();
    } else {
        $_SESSION["errorMsg"] = "Paramètres invalids";
        header('Location: ../encadreur.php');
    }
} else {
    $_SESSION["errorMsg"] = "Paramètres invalids";
    header('Location: ../encadreur.php');
}

//fonction pour la lecture
function lecture()
{
    try {
        // Connexion à la base de données
        $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);

        $req = "SELECT * FROM encadreur";

        $allEnc = array();

        $result = $mysqli->query($req);
        while ($row = $result->fetch_assoc()) {
            $allEnc[] = $row;
        }

        echo (json_encode([
            'status' => 'success',
            'allEnc' => $allEnc
        ]));
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo (json_encode([
            'status' => 'error',
            'msg' => $msg
        ]));
    }
}

//fonction pour l'insertion
function insertion()
{
    try {
        //$show = print_r($_POST['dept']);
        //echo "<script>alert($show, 'you');</script>";
        if (isset($_POST['id'])) {
            $departement = $_POST['dept'];
            $nom = $_POST['nom'];
            $fonction = $_POST['fonction'];
            $matricule = $_POST['matricule'];

            $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);

            //debut de la transaction
            $mysqli->begin_transaction();

            $id = getLastIndex();

            $req =  "INSERT INTO encadreur(idencadreur,nom_complet, matricule, fonction, departement)
                        VALUES ($id,'$nom','$matricule', '$fonction', '$departement')";
            echo $req;

            if ($mysqli->query($req)) {

                $mysqli->commit();
                $mysqli->close();
                $_SESSION["successMsg"] = "Insertion Réussie";
            } else {
                $_SESSION["errorMsg"] = "Erreur pendant l'insertion d'encadreur";
            }
        } else {
            $_SESSION["errorMsg"] = "Erreur de post";
        }

        header('Location: ../encadreur.php');
    } catch (Exception $e) {
        $_SESSION["errorMsg"] = $e->getMessage();
        header('Location: ../encadreur.php');
    }
}

//fonction pour l'édition
function edit()
{
    try {
        //$show = print_r($_POST['dept']);
        //echo "<script>alert($show, 'you');</script>";
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $departement = $_POST['dept'];
            $nom = $_POST['nom'];
            $fonction = $_POST['fonction'];
            $matricule = $_POST['matricule'];

            $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);

            //debut de la transaction
            $mysqli->begin_transaction();

            //$id = getLastIndex();

            $req =  "UPDATE encadreur SET nom_complet='$nom', matricule='$matricule', fonction='$fonction', 
            departement='$departement' WHERE idencadreur=$id";
            //echo $req;

            if ($mysqli->query($req)) {

                $mysqli->commit();
                $mysqli->close();
                $_SESSION["successMsg"] = "Modification Réussie";
            } else {
                $_SESSION["errorMsg"] = "Erreur pendant la modification d'encadreur";
            }
        } else {
            $_SESSION["errorMsg"] = "Erreur de post";
        }

        header('Location: ../encadreur.php');
    } catch (Exception $e) {
        $_SESSION["errorMsg"] = $e->getMessage();
        header('Location: ../encadreur.php');
    }
}

//fonction pour la suppression
function delete()
{
    try {
        //$show = print_r($_POST['dept']);
        //echo "<script>alert($show, 'you');</script>";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $mysqli = new mysqli("localhost", "root", "", "stagiaire", 3306);

            //debut de la transaction
            $mysqli->begin_transaction();

            //$id = getLastIndex();

            $req =  "DELETE FROM encadreur WHERE idencadreur=$id";
            echo $req;

            if ($mysqli->query($req)) {

                $mysqli->commit();
                $mysqli->close();
                $_SESSION["successMsg"] = "Suppression Réussie";
            } else {
                $_SESSION["errorMsg"] = "Erreur pendant la Suppression d'encadreur";
            }
        } else {
            $_SESSION["errorMsg"] = "Erreur de post";
        }

        header('Location: ../encadreur.php');
    } catch (Exception $e) {
        $_SESSION["errorMsg"] = $e->getMessage();
        header('Location: ../encadreur.php');
    }
}

function getLastIndex()
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

        return $num;
    } catch (Exception $ex) {
        $msg =  $ex->getMessage();
        echo "<script>console.log('Error','$msg');</script>";
        $_SESSION["errorMsg"] = "Erreur pendant la récup du dernier index";
    }
}
