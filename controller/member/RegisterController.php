<?php
    /**
     * Feuille de vérification et de traitement d'une inscription.
     * Un nouvel inscrit est forcement un membre de niveau 2 (membre)
     * Les infos impératives sont le pseudo, le mot de passe et l'email, les autres infos sont générées par défaut ou ne sont pas obligatoires.
     */
	//Inclusion du modele Member
    include 'model/Member.php';
	if ($pseudo == ''){
		if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email'])){

        //Création de l'objet Member
        $new_registrant = Member::asGuest();

        //Récupération des données du formulaire
        $new_registrant->setPseudo($_POST['pseudo']);
        $new_registrant->setPwd($_POST['password']);
        $new_registrant->setEmail($_POST['email']);
        $discord = "Donnée non renseignée";
        if ($_POST['discord'] != ""){
            $discord = $_POST['discord'];
        }
        $new_registrant->setDiscord($discord);
        $new_registrant->randomAvatar();
        $new_registrant->setSignature('Citoyen de la Providence');
        $new_registrant->setLocation("Nowhere");
        $new_registrant->setRegistered(date("Y-m-d"));
        $new_registrant->setLastVisit(date("Y-m-d"));
        $new_registrant->setRank(2);
        $new_registrant->setNumberPost(0);

        /**
         * On encode le mot de passe et on vérifie qu'aucune des informations censées être uniques n'éxistent pas déjà dans la base
         * Le mot est testé une fois encodé
         * Les autres données sont laissées brutes
         */
        $new_registrant->setPwd(Member::encodingPwd($new_registrant->getPwd()));
        if (Member::doesEmailExist($new_registrant->getEmail())) {
            $error = '<div class="alert alert-danger"><strong>Une erreur s\'est produite !</strong><br>'.Member::ERR_EMAIL_EXIST;
            include 'view/member/error.php';
        } else if (Member::doesPseudoExist($new_registrant->getPseudo())) {
            $error = '<div class="alert alert-danger"><strong>Une erreur s\'est produite !</strong><br>'.Member::ERR_PSEUDO_EXIST;
            include 'view/member/error.php';
        } else if (Member::doesPwdExist($new_registrant->getPwd())) {
            $error = '<div class="alert alert-danger"><strong>Une erreur s\'est produite !</strong><br>'.Member::ERR_PWD_EXIST;
            include 'view/member/error.php';
        } else {
            $new_registrant->registration();
            $error = '<div class="alert alert-success"><strong>Aucun problème !</strong><br>'.Member::SUC_REGISTRATION;
            include 'view/member/error.php';
        }
		} else {
			include 'view/member/register.php';
		}
	} else {
		$error = '<div class="alert alert-danger"><strong>Une erreur s\'est produite !</strong><br>'.Member::ERR_IS_CO;
		include 'view/member/error.php';
	}
    

    ?>