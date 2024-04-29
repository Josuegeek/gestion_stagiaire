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

                <li >
                    <a href="index.php">
                        <span class="icon">
                            <i class="ti-home"></i>
                        </span>
                        <span class="title">Accueil</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <i class="ti-plus"></i>
                        </span>
                        <span class="title">Ajouter un Stagiaire</span>
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
                <div class="top-title">Formulaire de stagiaire</div>
                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>
            <!-- ================ Order Details List ================= -->
            <div class="details">
                <form class="form-card" action="<?php 
                                if($stageExists) echo "./enginePhp/edit.php"; else echo "./enginePhp/insertion.php" ?>" method="post">
                    <div class="cardHeader">
                        <h2>Formulaire <?php echo "$id" ?></h2>
                        <div class="row align-center">
                            <label for="type">Type Stage : </label>
                            <select class="btn" name="type" id="type">
                                <option value="academique" <?php if($type_stage=="Académique") echo "selected" ?>>Académique</option>
                                <option value="pro" <?php if($type_stage=="Professionnel") echo "selected" ?>>Professionnel</option>
                            </select>
                        </div>
                    </div>

                    <div class="inputs-container">
                        <div class="form-title">Informations sur le stagiaire</div>
                        <div class="input-div">
                            <div>
                                <label for="dept"><b>Departement :</b></label>
                                <input style="display: none;" id="id" name="id" type="number" value="<?php if($stageExists) echo $id ?>">
                                <input id="dept" name="dept" type="text" required <?php 
                                if($stageExists) echo "value=\"$departement\"" ?>>
                            </div>
                            <div>
                                <label for="fonction"><b>Titre ou Fonction :</b></label>
                                <input id="fonction" name="fonction" type="text" required <?php 
                                if($stageExists) echo "value=\"$fonction\"" ?>>
                            </div>
                            <div>
                                <label for="duree"><b>Durée de stage :</b></label>
                                <input id="duree" name="duree" type="number" required <?php 
                                if($stageExists) echo "value=\"$duree\"" ?>>
                                <b>Mois</b>
                            </div>
                            <div class="date-div">
                                <label for="date_debut"><b>Date de début :</b></label>
                                <input id="date_debut" name="date_debut" type="date" required <?php 
                                if($stageExists) echo "value=\"$date_debut\"" ?>>
                            </div>
                        </div>
                        <div class="input-div">
                            <div>
                                <label for="nom">Nom complet :</label>
                                <input id="nom" name="nom" type="text" placeholder="Ex:Mukendi Mbuyi Jean" required <?php 
                                if($stageExists) echo "value=\"$nom\"" ?>>
                            </div>
                        </div>
                        <div class="input-div">
                            <div>
                                <label for="lieu-naissance">Lieu de naissance :</label>
                                <input id="lieu-naissance" name="lieu-naissance" type="text" placeholder="Ex:Kinshasa" required
                                <?php 
                                if($stageExists) echo "value=\"$lieu_naiss\"" ?>>
                            </div>
                            <div>
                                <label for="date-naissance">Date de naissance :</label>
                                <input id="date-naissance" name="date-naissance" type="date" required 
                                <?php 
                                if($stageExists) echo "value=\"$date_naiss\"" ?>>    
                            </div>
                        </div>
                        <div class="input-div">
                            <div>
                                <label for="prov-origin">Province d'origine :</label>
                                <input id="prov-origin" name="prov-origin" type="text" required 
                                <?php 
                                if($stageExists) echo "value=\"$prov_origin\"" ?>>
                            </div>
                            <div>
                                <label for="district-origin">District d'origine :</label>
                                <input id="district-origin" name="district-origin" type="text" required
                                <?php 
                                if($stageExists) echo "value=\"$district\"" ?>>
                            </div>
                            
                            <div>
                                <label for="village-origin">Village d'origine :</label>
                                <input id="village-origin" name="village-origin" type="text" required
                                <?php 
                                if($stageExists) echo "value=\"$village\"" ?>>
                            </div>
                        </div>
                        <div class="input-div">
                            <div>
                                <label for="adresse">Adresse complet :</label>
                                <input id="adresse" name="adresse" type="text" placeholder="45,av. street C/Lemba Q/Salongo" required
                                <?php 
                                if($stageExists) echo "value=\"$adresse\"" ?>>
                            </div>
                            <div>
                                <label for="tel">Téléphone :</label>
                                <input id="tel" name="tel" type="tel" placeholder="+243 81456789" required
                                <?php 
                                if($stageExists) echo "value=\"$tel\"" ?>>
                            </div>
                        </div>
                    </div>

                    <div id="section-student" class="inputs-container">
                        <div class="form-title">Pour les étudiants</div>
                        <div class="input-div">
                            <div>
                                <label for="fac">Faculté :</label>
                                <input id="fac" name="fac" type="text" placeholder="Ex : Sciences" required 
                                <?php 
                                if($stageExists) echo "value=\"$fac\"" ?>>
                            </div>
                            <div>
                                <label for="departement">Departement :</label>
                                <input id="departement" name="departement" type="text" placeholder="Chimie" required 
                                <?php 
                                if($stageExists) echo "value=\"$dept\"" ?>>
                            </div>
                        </div>
                        <div class="input-div">
                            <div>
                                <label for="supervision">Sous supervision de :</label>
                                <input id="supervision" name="supervision" type="text" placeholder="Prof. Djungu" required
                                <?php 
                                if($stageExists) echo "value=\"$supervision\"" ?>>
                            </div>
                        </div>
                    </div>
                    

                    <button id="submit" class="btn"><?php if($stageExists) echo "Modifier"; else echo "Enregistrer" ?></button>

                </form>

            </div>
            
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
    <script src="./engineJs/main.js"></script>

</body>

</html>