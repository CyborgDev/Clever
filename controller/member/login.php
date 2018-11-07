<?php
	/**
     * Feuille de verification et de traitement d'une inscription.
     * Un nouvel inscrit est forcement un membre de niveau 2 (membre)
     * Les infos imperatives sont le pseudo, le mot de passe et l'email, les autres infos sont generees par defaut ou ne sont pas obligatoires.
     */

    //Inclusion du modele Member
    include 'model/Member.php';

    /**
     * On verifie que l'utilisateur n'est pas deja connecte
     * S'il n'est pas connecte : execution du script
     * S'il est connecte : page d'erreur
     */
    if ($pseudo == ''){
        if (isset($_POST['pseudo']) && isset($_POST['password'])){
    
            //Creation de l'objet Member
            $new_connected = Member::asGuest();
    
            //Recuperation des donnees du formulaire
            $new_connected->setPseudo($_POST['pseudo']);
            $new_connected->setPwd($_POST['password']);
            $new_connected->setEmail('');
            $new_connected->setDiscord("Donn�e non renseign�e");
            $new_connected->randomAvatar();
            $new_connected->setSignature('Citoyen de la Providence');
            $new_connected->setLocation("Nowhere");
            $new_connected->setRegistered(date("Y-m-d"));
            $new_connected->setLastVisit(date("Y-m-d"));
            $new_connected->setRank(2);
            $new_connected->setNumberPost(0);
    
            /**
             * On encode le mot de passe et on verifie qu'aucune des informations existent dans la base
             * Le mot est teste une fois encode
             */
            $new_connected->encodingPwd();
            if (!$new_connected->doesPseudoExist()) {
                $error = '<div class="alert alert-danger"><strong>Une erreur s\'est produite !</strong><br>'.Member::ERR_INFO_NOT_CORRECT;
                include 'view/member/error.php';
            } else if (!$new_connected->doesPwdExist()) {
                $error = '<div class="alert alert-danger"><strong>Une erreur s\'est produite !</strong><br>'.Member::ERR_INFO_NOT_CORRECT;
                include 'view/member/error.php';
            } else {
                $new_connected->login();
                $error = '<div class="alert alert-success"><strong>Aucun problème !</strong><br>'.Member::SUC_CONNEXION;
                include 'view/member/error.php';
            }

        } else {
            include 'view/member/login.php';
        }
    } else {
        $error = '<div class="alert alert-danger"><strong>Une erreur s\'est produite !</strong><br>'.Member::ERR_IS_CO;
        include 'view/member/error.php';
    }

    ?>