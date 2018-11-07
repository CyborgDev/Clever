<?php
class Member {

    /**
     * Constantes de l'objet
     */
        //Constantes pour l'inscription au forum
        const ERR_IS_CO = 'Vous ne pouvez pas accéder à cette page si vous êtes connecté';
        const SUC_REGISTRATION = 'L\'inscription a été effectuée avec succès';
        const ERR_DATA_NOT_TRANSMITTED = 'Des données n\'ont pas été transmises';
        const ERR_EMAIL_EXIST = 'Cette adresse est déjà utilisée pour un autre compte.';
        const ERR_PSEUDO_EXIST = 'Ce pseudo est déjà utilisé pour un autre compte.';
        const ERR_PWD_EXIST = 'Vous ne pouvez pas utiliser ce mot de passe.';

		//Constantes pour la connection au forum
		const SUC_CONNEXION = 'Vous etes maintenant connecté';
		const ERR_EMAIL_NOT_EXIST = 'Cette adresse n\'est pas enregistrée.';
        const ERR_INFO_NOT_CORRECT ='Le pseudo ou le mot de passe est incorrect, essayez à nouveau';

    /**
     * Variables de l'objet
     */
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
        //Nothing to do here
    }

    public static function connected($array){
        $member = new self();
        $member->setPseudo($array['pseudo']);
        $member->setPwd($array['pwd']);
        $member->setEmail($array['email']);
        $member->setDiscord($array['discord']);
        $member->setAvatar($array['avatar']);
        $member->setSignature($array['signature']);
        $member->setLocation($array['location']);
        $member->setRegistered($array['registered']);
        $member->setLastVisit($array['last_visit']);
        $member->setRank($array['rank']);
        $member->setNumberPost($array['number_post']);

        $_SESSION['level'] = $member->getRank();
        $_SESSION['id'] = $array['id'];
        $_SESSION['pseudo'] = $member->getPseudo();

        return $member;
    }

    public static function asGuest(){
        $guest = new self();
        $guest->setPseudo('Guest');
        $guest->setPwd('');
        $guest->setEmail('');
        $guest->setDiscord('');
        $guest->setAvatar('');
        $guest->setSignature('');
        $guest->setLocation('');
        $guest->setRegistered('');
        $guest->setLastVisit('');
        $guest->setRank(1);
        $guest->setNumberPost(0);
        return $guest;
    }

    /**
     * Setters and Getters
     */
    public function setPseudo($pseudo){
        $this->_pseudo = $pseudo;
    }
    public function getPseudo(){
        return $this->_pseudo;
    }

    public function setPwd($pwd){
        $this->_pwd = $pwd;
    }
    public function getPwd(){
        return $this->_pwd;
    }

    public function setEmail($email){
        $this->_email = $email;
    }
    public function getEmail(){
        return $this->_email;
    }

    public function setDiscord($discord){
        $this->_discord = $discord;
    }
    public function getDiscord(){
        return $this->_discord;
    }

    public function setAvatar($avatar){
        $this->_avatar = $avatar;
    }
    public function getAvatar(){
        return $this->_avatar;
    }

    public function setSignature($signature){
        $this->_signature = $signature;
    }
    public function getSignature(){
        return $this->_signature;
    }

    public function setLocation($location){
        $this->_location = $location;
    }
    public function getLocation(){
        return $this->_location;
    }

    public function setRegistered($registered){
        $this->_registered = $registered;
    }
    public function getRegistered(){
        return $this->_registered;
    }

    public function setLastVisit($lastVisit){
        $this->_last_visit = $lastVisit;
    }
    public function getLastVisit(){
        return $this->_last_visit;
    }

    public function setRank($rank){
        $this->_rank = $rank;
    }
    public function getRank(){
        return $this->_rank;
    }

    public function incrementNumberPost(){
        $this->_number_post = $this->_number_post + 1;
    }
    public function setNumberPost($numberPost){
        $this->_number_post = $numberPost;
    }
    public function getNumberPost(){
        return $this->_number_post;
    }

    /**
     * Fonctions utiles pour un membre
     * Sur cette feuille sont présentes les fonctions nécéssaire à :
     * - L'inscription
     * - La connection
     * - La gestion du/des profil(s)
     */
    public function randomAvatar(){
        $avatar = rand(1,4);
        $this->setAvatar('http://localhost/Clever/webroot/pictures/avatar'.$avatar.'.png');
    }

    public function encodingPwd(){
        $this->_pwd =  md5(md5($this->_pwd));
    }

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

    public function registration(){
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
            "number_post" => $this->_number_post
            ));
    }

    public function login(){
        global $db;
        $query = $db->prepare('SELECT * FROM members WHERE pseudo = :pseudo AND pwd = :pwd');
        $query->execute(array(
            "pseudo" => $this->_pseudo, 
            "pwd" => $this->_pwd));
		$result = $query->fetch(PDO::FETCH_ASSOC);

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
		$_SESSION['id'] = $result['id'];
		$_SESSION['pseudo'] = $this->_pseudo;
    }

}