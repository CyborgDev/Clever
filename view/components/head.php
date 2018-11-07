<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
    <head>
        <?php
            //Si le titre est indiqué, on l'affiche entre les balises <title>
            echo (!empty($titre))?'<title>'.$titre.'</title>':'<title>Clever</title>';
            ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" media="screen" type="text/css" title="Design" href="webroot/css/bootstrap.css" />
        <link rel="stylesheet" media="screen" type="text/css" title="Design" href="webroot/css/clever.css" />
        <link rel="sc" href="">
    </head>
    <body>
        <div class="container" id="body-page">
            <?php
                include 'view/components/navbar.php';
            ?>
            <div class="container-fluid text-center">
                <img src="webroot/pictures/Clever_logo_2.PNG" alt="Logo de Clever">
            </div>