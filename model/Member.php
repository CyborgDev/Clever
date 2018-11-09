<?php
class Member {

    /**
     * Constantes de l'objet
     */
    const ERR_IS_CO = 'Vous ne pouvez pas accéder à cette page si vous êtes connecté';
    const SUC_REGISTRATION = 'L\'inscription a été effectuée avec succès';
    const ERR_DATA_NOT_TRANSMITTED = 'Des données n\'ont pas été transmises';
    const ERR_EMAIL_EXIST = 'Cette adresse est déjà utilisée pour un autre compte.';
    const ERR_PSEUDO_EXIST = 'Ce pseudo est déjà utilisé pour un autre compte.';
    const ERR_PWD_EXIST = 'Vous ne pouvez pas utiliser ce mot de passe.';
	const SUC_CONNEXION = 'Vous etes maintenant connecté';
	const ERR_EMAIL_NOT_EXIST = 'Cette adresse n\'est pas enregistrée.';
    const ERR_INFO_NOT_CORRECT = 'Le pseudo ou le mot de passe est incorrect, essayez à nouveau';
    const ERR_MISSING_INFO = 'Des informations sont manquantes';

    /**
     * Variables de l'objet
     */
    private $_id;
    private $_pseudo;
    private $_pwd;
    private $_email;
    private $_discord;
    private $_avatar;
    private $_signature;
    private $_location;
    private $_registered;
    private $_last_visit;
    private $_rank;
    private $_number_post;

    /**
     * Constructeurs
     */
    public function __construct(){
        $this->_id = -1;
        $this->_pseudo = 'Guest';
        $this->_pwd = '';
        $this->_email = '';
        $this->_discord = '';
        $this->_avatar = '';
        $this->_signature = '';
        $this->_location = '';
        $this->_registered = '';
        $this->_last_visit = '';
        $this->_rank = 1;
        $this->_number_post = 0;
    }

    // -------------------------------------------------------------------------------------------------------------- //
    /**
     * Fonctions utiles pour un membre
     * Sur cette feuille sont présentes les fonctions nécéssaire à :
     * - L'inscription
     * - La connection
     * - La gestion du/des profil(s)
     */

    /**
     * Fonction randomAvatar(), usage : $aMember->randomAvatar();
     * return void
     * Cette fonction applique aleatoirement un des 4 avatars de base au profil cible
     */
    public function randomAvatar(){
        $avatar = rand(1,4);
        $this->_avatar = 'http://localhost/Clever/webroot/pictures/avatar'.$avatar.'.png';
    }

    /**
     * Fonction encodingPwd(), usage : $aMember->encodingPwd();
     * return void
     * Cette fonction encode le mot de passe par deux fois avec les protocole md5
     */
    public function encodingPwd(){
        $this->_pwd =  md5(md5($this->_pwd));
    }

    /**
     * Fonction doesEmailExist(), usage : $aMember->doesEmailExist();
     * return bool (true si l'adresse existe, false si non)
     * Cette fonction cherche a savoir si l'adresse de la cible existe deja dans la base de donnees
     */
    public function doesEmailExist(){
        global $db;
        $query = $db->prepare('SELECT COUNT(*) FROM members WHERE email = :email');
        $query->bindValue(':email',  $this->_email, PDO::PARAM_STR);
        $query->execute();

        if ($query->fetchColumn() != 0){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Fonction doesPseudoExist(), usage : $aMember->doesPseudoExist();
     * return bool (true si le pseudo existe, false si non)
     * Cette fonction cherche a savoir si le pseudo de la cible existe deja dans la base de donnees
     */
    public function doesPseudoExist(){
        global $db;
        $query = $db->prepare('SELECT COUNT(*) FROM members WHERE pseudo = :pseudo');
        $query->bindValue(':pseudo',  $this->_pseudo, PDO::PARAM_STR);
        $query->execute();

        if ($query->fetchColumn() != 0){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Fonction doesPwdExist(), usage : $aMember->doesPwdExist();
     * return bool (true si le mot de passe existe, false si non)
     * Cette fonction cherche a savoir si le mot de passe de la cible existe deja dans la base de donnees
     */
    public function doesPwdExist(){
        global $db;
        $query = $db->prepare('SELECT COUNT(*) FROM members WHERE pwd = :pwd');
        $query->bindValue(':pwd',  $this->_pwd, PDO::PARAM_STR);
        $query->execute();

        if ($query->fetchColumn() != 0){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Fonction registration(), usage : $aMember->registration();
     * return String
     * Cette fonction enregistre la cible dans la base de donnees
     * /!\ N'utiliser que si la cible a ete correctement remplie /!\
     */
    public function registration(){
        //On verifie que les infos primordiales sont bien rentrees
        if ($this->_pseudo == "" || $this->_pwd == "" || $this->_email == ""){
            return Member::ERR_MISSING_INFO;
        } else {
            global $db;
            $query = $db->prepare("INSERT INTO members (id, pseudo, pwd, email, discord, avatar, signature, location, registered, last_visit, rank, number_post) VALUES ('', :pseudo, :pwd, :email, :discord, :avatar, :signature, :location, :registered, :last_visit, :rank, :number_post)");
            $query->execute(array(
                "pseudo" => $this->_pseudo, 
                "pwd" => $this->_pwd,
                "email" => $this->_email,
                "discord" => $this->_discord,
                "avatar" => $this->_avatar,
                "signature" => $this->_signature,
                "location" => $this->_location,
                "registered" => $this->_registered,
                "last_visit" => $this->_last_visit,
                "rank" => $this->_rank,
                "number_post" => $this->_number_post)
            );
        }
    }

    /**
     * Fonction login(), usage : $aMember->login();
     * reutrn void;
     * Cette fonction connecte la cible en recherchant le pseudo et le mot de passe de celle dans la base de donnees
     * puis en settant correctement les variables de session
     * /!\ L'existance du pseudo et du mot de passe doivent avoir ete verifies prealablement /!\
     */
    public function login(){
        global $db;
        $query = $db->prepare('SELECT * FROM members WHERE pseudo = :pseudo AND pwd = :pwd');
        $query->execute(array(
            "pseudo" => $this->_pseudo, 
            "pwd" => $this->_pwd));
		$result = $query->fetch(PDO::FETCH_ASSOC);

        $this->_id = $result['id'];
		$this->_pseudo = $result['pseudo'];
		$this->_pwd = $result['pwd'];
		$this->_email = $result['email'];
		$this->_discord = $result['discord'];
		$this->_avatar = $result['avatar'];
		$this->_signature = $result['signature'];
		$this->_location = $result['location'];
		$this->_registered = $result['registered'];
		$this->_last_visit = date("Y-m-d");
		$this->_rank = $result['rank'];
		$this->_number_post = $result['number_post'];

		$update = $db->prepare('UPDATE members SET last_visit = ? WHERE email = ?');
		$update->execute([$this->_last_visit, $this->_email]);

		$_SESSION['level'] = $this->_rank;
		$_SESSION['id'] = $this->_id;
		$_SESSION['pseudo'] = $this->_pseudo;
    }

}