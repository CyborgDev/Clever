<?php
	/**
     * Feuille de v�rification et de traitement d'une inscription.
     * Un nouvel inscrit est forcement un membre de niveau 2 (membre)
     * Les infos imp�ratives sont le pseudo, le mot de passe et l'email, les autres infos sont g�n�r�es par d�faut ou ne sont pas obligatoires.
     */
    if (isset($_POST['pseudo']) && isset($_POST['password'])){
        //Inclusion du modele Member
        include 'model/Member.php';

        //Cr�ation de l'objet Member
        $new_connected = Member::asGuest();

        //R�cup�ration des donn�es du formulaire
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
         * On encode le mot de passe et on v�rifie qu'aucune des informations �xistent dans la base
         * Le mot est test� une fois encod�
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

    ?>