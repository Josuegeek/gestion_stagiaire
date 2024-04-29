<?php
include("./enginePhp/home.php");
//include("./enginePhp/getAllStage.php");
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
                    <a href="#">
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
                <div class="top-title">Accueil</div>
                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $proStageCount; ?></div>
                        <div class="cardName">Stages Professionnels</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $academicStageCount; ?></div>
                        <div class="cardName">Stages Académiques</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $finishedStageCount; ?></div>
                        <div class="cardName">Stages Terminés</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $allStageCount; ?></div>
                        <div class="cardName">Total des Stages</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Stages Recents</h2>
                        <a href="./list.php" class="btn">Afficher Tout</a>
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
                            <!--
                            <tr>
                                <td>Iswa Senteri Josué</td>
                                <td>Informatique</td>
                                <td>Professionnel</td>
                                <td>12/04/2024</td>
                                <td>3 mois</td>
                                <td><span class="status delivered">Delivered</span></td>
                            </tr>

                            <tr>
                                <td>Iswa Senteri Josué</td>
                                <td>Informatique</td>
                                <td>Professionnel</td>
                                <td>12/04/2024</td>
                                <td>3 mois</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>

                            
                            <tr>
                                <td>Iswa Senteri Josué</td>
                                <td>Informatique</td>
                                <td>Professionnel</td>
                                <td>12/04/2024</td>
                                <td>3 mois</td>
                                <td><span class="status return">Return</span></td>
                            </tr>

                            <tr>
                                <td>Iswa Senteri Josué</td>
                                <td>Informatique</td>
                                <td>Professionnel</td>
                                <td>12/04/2024</td>
                                <td>3 mois</td>
                                <td><span class="status inProgress">In Progress</span></td>
                            </tr>

                            <tr>
                                <td>Iswa Senteri Josué</td>
                                <td>Informatique</td>
                                <td>Professionnel</td>
                                <td>12/04/2024</td>
                                <td>3 mois</td>
                                <td><span class="status delivered">Delivered</span></td>
                            </tr>

                            <tr>
                                <td>Iswa Senteri Josué</td>
                                <td>Informatique</td>
                                <td>Professionnel</td>
                                <td>12/04/2024</td>
                                <td>3 mois</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>

                            <tr>
                                <td>Iswa Senteri Josué</td>
                                <td>Informatique</td>
                                <td>Professionnel</td>
                                <td>12/04/2024</td>
                                <td>3 mois</td>
                                <td><span class="status return">Return</span></td>
                            </tr>

                            <tr>
                                <td>Iswa Senteri Josué</td>
                                <td>Informatique</td>
                                <td>Professionnel</td>
                                <td>12/04/2024</td>
                                <td>3 mois</td>
                                <td><span class="status inProgress">In Progress</span></td>
                            </tr>
                        -->
                        </tbody>
                    </table>
                    <button style="align-self: center;margin-top: 30px;" class="btn"><a href="./form.php">Ajouter un nouveau</a></button>
                </div>

                <!-- ================= New Customers ================ 
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Recent Customers</h2>
                    </div>

                    <table>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Italy</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit <br> <span>India</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Italy</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit <br> <span>India</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Italy</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit <br> <span>India</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Italy</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit <br> <span>India</span></h4>
                            </td>
                        </tr>
                    </table>
                </div>
                -->
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
    <script src="./engineJs/lecture.js"></script>

</body>

</html>