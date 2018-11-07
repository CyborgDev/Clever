<?php
class Post {
    /**
     * Variables de l'objet
     */
    private $_creator;
    private $_text;
    private $_post_time;
    private $_topic_id;
    private $_forum_id;

    /**
     * Constructeur
     */

    public function __construct(){
        $this->_creator = new Member();         //Type : Member
        $this->_text = "";                      //Type : String
        $this->_post_time = "";                 //Type : Date
        $this->_topic_id = -1;                  //Type : int
        $this->_forum_id = -1;                  //Type : int
    }

    // -------------------------------------------------------------------------------------------------------------- //
    /**
     * Fonctions statiques de classe
     * Ces fonctions doivent servir à la recuperation de plusieurs Posts a la fois
     */

    /**
     * Fonction GetAll(), usage Member::GetAll();
     * Cette fonction recupere l'entierete des posts du forum
     * /!\ Dangereux si le nombre de Posts est eleve /!\
     */
    public static function GetAll() {
        global $db;
        $allPosts = $db->prepare('SELECT * FROM posts')->execute();
        //Remplissage des objets
        return $allPosts;
    }

    /**
     * Fonction GetAllByUserId(), usage Member::GetAllByUserId($user_id);
     * Cette fonction recupere l'entierete des posts du forum creer par l'utilisateur numero $user_id
     * @param user_id : int correspondant a l'id d'un utilisateur
     * /!\ Dangereux si le nombre de Posts est eleve /!\
     */
    public static function GetAllByUserId($user_id){
        global $db;
        $allPosts = $db->prepare('SELECT * FROM posts WHERE creator = :user_id')->bindValue(':user_id', $user_id, PDO::PARAM_INT)->execute();
        //Remplissage des objets
        return $allPosts;
    }

    /**
     * Fonction GetAllByTopicId(), usage Member::GetAllByTopicId($topic_id);
     * Cette fonction recupere l'entierete des posts du forum correspondant au topic numero $topic_id
     * @param topic_id : int correspondant a l'id d'un topic
     * /!\ Dangereux si le nombre de Posts est eleve /!\
     */
    public static function GetAllByTopicId($topic_id){
        global $db;
        $allPosts = $db->prepare('SELECT * FROM posts WHERE topic_id = :topic_id')->bindValue(':topic_id', $topic_id, PDO::PARAM_INT)->execute();
        //Remplissage des objets
        return $allPosts;
    }

    /**
     * Fonction GetAllByForumId(), usage Member::GetAllByForumId($forum_id);
     * Cette fonction recupere l'entierete des posts du forum correspondant au forum numero $forum_id
     * @param forum_id : int correspondant a l'id d'un forum
     * /!\ Dangereux si le nombre de Posts est eleve /!\
     */
    public static function GetAllByForumId($forum_id){
        global $db;
        $allPosts = $db->prepare('SELECT * FROM posts WHERE forum_id = :forum_id')->bindValue(':forum_id', $forum_id, PDO::PARAM_INT)->execute();
        //Remplissage des objets
        return $allPosts;
    }

    // -------------------------------------------------------------------------------------------------------------- //
    /**
     * Fonctions utiles pour un post
     * Sur cette feuille sont presentes les fonctions necessaires a :
     * - La creation d'un post
     * - La modification d'un post
     * - La suppression d'un post
     */

    /**
     * Fonction fill(), cette fonction rempli l'objet $this
     * avec les donnees qui lui sont passees dans le parametre $array
     * @param array Tableau contenant les donnees d'un objet Post, structure : {id, creator, text, post_time, topic_id, forum_id}
     */
    public function fill($array){
        //TO DO
    }
}