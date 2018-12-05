<?php
class Topic {
    /**
     * Variables de l'objet
     */
    private $_id;
    private $_forum_id;
    private $_title;
    private $_creator;
    private $_number_view;
    private $_time;
    private $_gender;
    private $_last_post;
    private $_first_post;
    private $_number_post;

    /**
     * Constructeur
     */
    public function __construct(){
        $this->_id = -1;
        $this->_forum_id = -1;
        $this->_title = "";
        $this->_creator = -1;
        $this->_number_view = -1;
        $this->_time = -1;
        $this->_gender = "";
        $this->_last_post_id = -1;
        $this->_first_post_id = -1;
        $this->_number_post = -1;
    }

    // -------------------------------------------------------------------------------------------------------------- //
    /**
     * Fonctions statiques de classe
     * Ces fonctions doivent servir à la recuperation de plusieurs Topics a la fois
     */

    /**
     * Fonction GetAll(), Cette fonction recupere l'entierete des topics du forum
     * /!\ Dangereux si le nombre de Topics est eleve /!\
     * @return array $topicList,
     * @see Topic::GetAll();
     */
    public static function GetAll() {
        global $db;
        $allTopics = $db->prepare('SELECT * FROM topics')->execute();
        $topicList = array();
        while ($dataTopic = $allTopics->fetch()){
            $newTopic = new Topic();
            $newTopic->fill($dataTopic);
            $topicList[] = $newTopic;
        }
        return $topicList;
    }

    /**
     * Fonction GetAllByForumId(), Cette fonction recupere l'entierete des topics du forum qui ont pour forum celui qui a l'id "forum_id"
     * /!\ Dangereux si le nombre de Topics est eleve /!\
     * @param int : $forum_id Identifiant du forum parent
     * @return array $topicList,
     * @see Topic::GetAllByForumId();
     */
    public static function GetAllByForumId($forum_id) {
        global $db;
        $allTopics = $db->prepare('SELECT * FROM topics WHERE forum_id = :forum_id')->bindValue(':forum_id', $forum_id, PDO::PARAM_INT)->execute();
        $topicList = array();
        while ($dataTopic = $allTopics->fetch()){
            $newTopic = new Topic();
            $newTopic->fill($dataTopic);
            $topicList[] = $newTopic;
        }
        return $topicList;
    }

    /**
     * Fonction GetAllByUserId(), Cette fonction recupere l'entierete des topics du forum qui ont pour createur celui qui a l'id "user_id"
     * /!\ Dangereux si le nombre de Topics est eleve /!\
     * @param int : $user_id Identifiant du membre createur
     * @return array $topicList,
     * @see Topic::GetAllByUserId();
     */
    public static function GetAllByUserId($user_id) {
        global $db;
        $allTopics = $db->prepare('SELECT * FROM topics WHERE creator = :user_id')->bindValue(':user_id', $user_id, PDO::PARAM_INT)->execute();
        $topicList = array();
        while ($dataTopic = $allTopics->fetch()){
            $newTopic = new Topic();
            $newTopic->fill($dataTopic);
            $topicList[] = $newTopic;
        }
        return $topicList;
    }

    // -------------------------------------------------------------------------------------------------------------- //
    /**
     * Fonctions utiles pour un forum
     * Sur cette feuille sont presentes les fonctions necessaires a :
     * - La creation d'un forum
     * - La modification d'un forum
     * - La suppression d'un forum
     */

    /**
     * Fonction fill(), Cette fonction remplie l'objet $this avec les données contenues dans un tableau de données.
     * @param array : $data Tableau contenant les données d'un forum
     * @return void;
     * @see $this->fill($data);
     */
    public function fill($data){
        $this->_id = $data['topic_id'];
        $this->_forum_id = $data['forum_id'];
        $this->_title = $data['title'];
        $this->_creator = $data['creator'];
        $this->_number_view = $data['number_view'];
        $this->_time = $data['time'];
        $this->_gender = $data['gender'];
        $this->_last_post_id = $data['last_post_id'];
        $this->_first_post_id = $data['first_post_id'];
        $this->_number_post = $data['numbere_post'];
    }

    /**
     * Fonction insert(), Cette fonction insert un nouveau topic dans la base de donnees
     * @param string : $title   Titre du topic
     * @param string : $gender  Genre du topic
     * @return boolean : $return True si tout s'est bien passe, False sinon.
     * @see $this->insert($title, $gender);
     */
    public function insert($title, $gender){
        global $db;
        global $id;
        $return = true;
        if ($id == 0){
            $return = false;
        } else {
            $this->_forum_id = $_GET['forum'];
            $this->_title = $title;
            $this->_creator = $id;
            $this->_number_view = 0;
            $this->_time = date("Y-m-d");
            $this->_gender = $gender;
            $this->_number_post = 0;

            $insert = $db->prepare("INSERT INTO topics (topic_id, forum_id, title, creator, number_view, time, gender, last_post_id, first_post_id, number_post) VALUES ('', :forum_id, :title, :creator, :number_view, :time, :gender, :last_post_id, :first_post_id, :number_post)");
            $insert->execute(array(
                "forum_id"          => $this->_forum_id,
                "title"             => $this->_title,
                "creator"           => $this->_creator,
                "number_view"       => $this->_number_view,
                "time"              => $this->_time,
                "gender"            => $this->_gender,
                "last_post_id"      => $this->_last_post_id,
                "first_post_id"     => $this->_first_post_id,
                "number_post"       => $this->_number_post)
            );
        }
        return $return;
    }

}