<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
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
            <i id="closer" class="ti-close"></i>
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
                    <a href="#">
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
                <div class="top-title">List des stagiaires</div>
                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>
            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>List des Stagiaires</h2>
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
                                <td>Departement</td>
                                <td>Type Stage</td>
                                <td>Date de début</td>
                                <td>Durée</td>
                                <td>Statut</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                    <button style="align-self: center;margin-top: 30px;" class="btn"><a href="./form.php">Ajouter un nouveau</a></button>
                </div>


            </div>

        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
    <script src="./engineJs/lecture.js"></script>

</body>

</html>