<?php
include("./enginePhp/getStage.php");
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$id="";
$stage = array();
$stageExists = false;
$departement = "";
$fonction = "";
$type_stage = "";
$date_debut = "";
$duree = "";
$nom = "";
$lieu_naiss = "";
$date_naiss = "";
$prov_origin = "";
$district = "";
$village = "";
$adresse =  "";
$tel = "";
$fac = "";
$dept = "";
$supervision = "";
$class = "";
$status = "";

if (isset($_GET["id"])) {
    $stage =  getStage($_GET["id"]);
    if (count($stage) > 0) {
        $id=$_GET["id"];
        $stageExists = true;
        $departement = $stage[0]["departement"];
        $fonction = $stage[0]["fonction"];
        $type_stage = $stage[0]["type_stage"];
        $date_debut = $stage[0]["date_debut"];
        $duree = $stage[0]["duree"];
        $nom = $stage[0]["nom_complet"];
        $lieu_naiss = $stage[0]["lieu_naissance"];
        $date_naiss = $stage[0]["date_naissance"];
        $prov_origin = $stage[0]["province"];
        $district = $stage[0]["district"];
        $village = $stage[0]["village"];
        $adresse = $stage[0]["adresse"];
        $tel = $stage[0]["telephone"];
        $fac = $stage[0]["fac"];
        $dept = $stage[0]["dept_fac"];
        $supervision = $stage[0]["directeur"];
        $status = $stage[0]["status"];

        if(strpos(strtolower($status), 'en cours') !== false){
            $class = "status delivered";
        }
        else{
            $class = "status return";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stagiaires</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/themify-icons/themify-icons.css">
</head>

<body>
    <?php
    include("./enginePhp/showAlert.php");
    ?>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <i class="ti-layout-grid2-alt"></i>
                        </span>
                        <span class="title">Gestion des stagiaires</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <i class="ti-home"></i>
                        </span>
                        <span class="title">Accueil</span>
                    </a>
                </li>

                <li>
                    <a href="./form.php">
                        <span class="icon">
                            <i class="ti-plus"></i>
                        </span>
                        <span class="title">Ajouter un stagiaire</span>
                    </a>
                </li>

                <li>
                    <a href="./list.php">
                        <span class="icon">
                            <i class="ti-layout-list-thumb"></i>
                        </span>
                        <span class="title">List et Gestion</span>
                    </a>
                </li>

                <li>
                    <a href="./encadreur.php">
                        <span class="icon">
                            <i class="ti-user"></i>
                        </span>
                        <span class="title">Les encadreurs</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <i class="ti-power-off"></i>
                        </span>
                        <span class="title">Se deconnecter</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <i class="ti-menu"></i>
                </div>
                <div class="top-title">Affichage de stagiaire</div>
                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>
            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="form-card">
                    <div class="cardHeader">
                        <h2>Stagiaire <?php if(isset($_GET["id"])) echo $_GET["id"]; ?></h2>
                        <?php
                        if ($stageExists) {
                            echo "<div class=\"row align-center\">
                            <label for=\"type\">Type Stage : </label>
                            <div class=\"btn\">$type_stage</div>
                        </div>";
                        }
                        ?>
                    </div>

                    <div class="info-container">
                        <div <?php if (!$stageExists) echo "style=\"display:none;\"" ?> class="left">
                            <div class="row">
                                <div class="user-profile">
                                    <i class="ti-user"></i>
                                </div>
                                <div class="right">
                                    <b>
                                        <?php echo "$nom" ?>
                                    </b>
                                    <p>Née à <b><?php echo "$lieu_naiss" ?></b>, le <b><?php echo "$date_naiss" ?></b></p>
                                    <p>Province d'origine : <b><?php echo "$prov_origin" ?></b></p>
                                    <p>District d'origine : <b><?php echo "$district" ?></b></p>
                                    <p>Village d'origine : <b><?php echo "$village" ?></b></p>
                                    <p>Adresse : <b><?php echo "$adresse" ?></b></p>
                                    <p>Téléphone : <b><?php echo "$tel" ?></b></p>

                                    <br>
                                    <p>faculté : <b><?php echo "$fac" ?></b></p>
                                    <p>departement : <b><?php echo "$dept" ?></b></p>
                                    <p>Sous la supervision de : <b><?php echo "$supervision" ?></b></p>
                                </div>

                            </div>

                        </div>
                        <div <?php if (!$stageExists) echo "style=\"display:none;\"" ?> class="right">
                            <p>Durée de Stage : <b><?php echo "$duree" ?> mois</b></p>
                            <p>Département : <b><?php echo "$departement" ?></b></p>
                            <p>Titre/Fonction : <b><?php echo "$fonction" ?></b></p>
                            <p>Statut : <span class="<?php echo "$class" ?>"><?php echo "$status" ?></span></p>
                        </div>
                    </div>
                    <?php
                    if (!$stageExists) {
                        echo "<h1 style=\"text-align: center;\" class=\"color-primary\">Stage Introuvabble</h1>";
                    } else {
                        echo "<ul>
                        <li>
                            <a class=\"small-btn bg-yellow\" href=\"form.php?id=$id\">
                                <i class=\"ti-pencil\"></i>
                            </a>
                        </li>
                        <li>
                            <a onclick=\"deleteStage($id)\" class=\"small-btn\" href=\"#\">
                                <i class=\"ti-trash\"></i>
                            </a>
                        </li>
                    </ul>";
                    }
                    ?>

                </div>
            </div>

        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

</body>

</html>