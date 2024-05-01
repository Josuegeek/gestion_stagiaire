<?php
    include('./enginePhp/home.php')
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les encadreurs</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="assets/isjoverform/isjoverform.css">
</head>

<body>
    <?php
    include("./enginePhp/showAlert.php");
    ?>

    <!-- =============== Invisible Form ================ -->
    <div class="isjoverform2 isjform-hide">
        <div id="signupFrm" class="signupFrm">
            <div class="wrapper">
                <form class="form" action="./enginePhp/encadreur_crud.php" method="POST">
                    <div id="form-title" class="top-title">Ajouter un encadreur</div>
                    <br>
                    <div class="row gap">
                        <b>ID :</b>
                        <span id="idLbl"><b><?php echo $encNum ?></b></span>
                    </div>
                    <br>
                    <div style="display: none;" class="inputContainer">
                        <input id="id" name="id" type="number" placeholder="a" class="input" value="<?php echo $encNum ?>" required>
                        <label for="id" class="label">ID de l'encadreur</label>
                    </div>
                    <div class="inputContainer">
                        <input id="matricule" name="matricule" type="text" placeholder="a" class="input" required>
                        <label for="matricule" class="label">Matricule</label>
                    </div>
                    <div class="inputContainer">
                        <input id="nom" name="nom" type="text" placeholder="a" class="input" required>
                        <label for="nom" class="label">Nom complet</label>
                    </div>
                    <div class="inputContainer">
                        <input id="fonction" name="fonction" type="text" placeholder="a" class="input" required>
                        <label for="fonction" class="label">Fonction</label>
                    </div>
                    <div class="inputContainer">
                        <input id="dept" name="dept" type="text" placeholder="a" class="input" required>
                        <label for="dept" class="label">Departement</label>
                        <input style="display: none;" id="op" name="op" type="text" value="insert">
                    </div>
                    <div class="row gap">
                        <button id="btn-add-enc" class="btn">Ajouter</button>
                        <div onclick="closeIsjForm2(0)" class="btn btn-secondary">Annuler</div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <i id="closer" class="ti-close"></i>
            <ul>
                <li>
                    <a href="./index.html">
                        <span class="icon">
                            <i class="ti-layout-grid2-alt"></i>
                        </span>

                        <span class="title">Gestion des stagiaires</span>
                    </a>
                </li>

                <li>
                    <a href="./index.php">
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
                <div class="top-title">Les encadreurs</div>
                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="row mg-top w-100 center gap wrap">
                <button onclick="showForm(0)" class="btn">Ajouter un nouveau encadreur</button>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Liste des encadreurs</h2>
                        <i onclick="reloadTable();" class="ti-reload small-btn"></i>
                        <div class="search">
                            <label>
                                <input id="searchText" type="text" placeholder="Recherhcer">
                                <i id="searchBtn" class="ti-search"></i>
                            </label>
                        </div>
                    </div>

                    <table id="defaulTable">
                        <thead>
                            <tr>
                                <td>Nom complet</td>
                                <td>Matricule</td>
                                <td>Departement</td>
                                <td>Fonction</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                    <button onclick="showForm(0)" style="align-self: center;margin-top: 30px;" class="btn">Ajouter un nouveau</button>
                </div>


            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/isjoverform/isjoverform.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="./engineJs/lecture_encadreur.js"></script>
</body>

</html>