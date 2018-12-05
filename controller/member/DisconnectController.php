<?php
	$lvl = 1;
    $id = 0;
    $pseudo = '';
	session_unset();
	session_destroy();
	$error = '<div class="alert alert-success"><strong>Aucun problème !</strong><br>Déconnexion réussie';
	include 'view/member/error.php';
	?>