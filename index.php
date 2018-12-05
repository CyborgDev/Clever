<?php
    //On démarre la session
    session_start();
    //Attribution des variables de session
    $lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
    $id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
    $pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

    //On se connecte à la base de données
    include 'controller/components/database.php';

    //On inclut le la tête du forum
    include 'view/components/head.php';
 
    //On inclut le contrôleur s'il existe et s'il est spécifié
    if (!empty($_GET['page']) && is_file('controller/'.$_GET['page'].'Controller.php')){

        //On inclut le contrôleur
        include 'controller/'.$_GET['page'].'Controller.php';

    } else {
        include 'view/home.php';
    }

    //On inclut le pied de page
    include 'view/components/foot.php';