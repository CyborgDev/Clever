<?php
class Post {
    /**
     * Variables de l'objet
     */
    private $_id;
    private $_creator;
    private $_text;
    private $_post_time;
    private $_topic_id;
    private $_forum_id;

    /**
     * Constructeur
     */

    public function __construct(){
        $this->_id = -1;                        //Type : int
        $this->_creator = -1;                   //Type : int
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
     * Fonction GetAll(), Cette fonction recupere l'entierete des posts du forum
     * /!\ Dangereux si le nombre de Posts est eleve /!\
     * @return array $postList;
     * @see Post::GetAll();
     */
    public static function GetAll() {
        global $db;
        $allPosts = $db->prepare('SELECT * FROM posts')->execute();
        $postList = array();
        while ($dataPost = $allPosts->fetch()){
            $newPost = new Post();
            $newPost->fill($dataPost);
            $postList[] = $newPost;
        }
        return $postList;
    }

    /**
     * Fonction GetAllByUserId(), Cette fonction recupere l'entierete des posts du forum creer par l'utilisateur numero $user_id
     * /!\ Dangereux si le nombre de Posts est eleve /!\     
     * @param int : $user_id correspondant a l'id d'un utilisateur
     * @return array $postList;
     * @see Post::GetAllByUserId($user_id);
     */
    public static function GetAllByUserId($user_id){
        global $db;
        $allPosts = $db->prepare('SELECT * FROM posts WHERE creator = :user_id')->bindValue(':user_id', $user_id, PDO::PARAM_INT)->execute();
        $postList = array();
        while ($dataPost = $allPosts->fetch()){
            $newPost = new Post();
            $newPost->fill($dataPost);
            $postList[] = $newPost;
        }
        return $postList;
    }

    /**
     * Fonction GetAllByTopicId(), Cette fonction recupere l'entierete des posts du forum correspondant au topic numero $topic_id
     * /!\ Dangereux si le nombre de Posts est eleve /!\
     * @param int : topic_id correspondant a l'id d'un topic
     * @return array $postList;
     * @see Post::GetAllByTopicId($topic_id);;
     */
    public static function GetAllByTopicId($topic_id){
        global $db;
        $allPosts = $db->prepare('SELECT * FROM posts WHERE topic_id = :topic_id')->bindValue(':topic_id', $topic_id, PDO::PARAM_INT)->execute();
        $postList = array();
        while ($dataPost = $allPosts->fetch()){
            $newPost = new Post();
            $newPost->fill($dataPost);
            $postList[] = $newPost;
        }
        return $postList;
    }

    /**
     * Fonction GetAllByForumId(), Cette fonction recupere l'entierete des posts du forum correspondant au forum numero $forum_id
     * /!\ Dangereux si le nombre de Posts est eleve /!\
     * @param int : $forum_id correspondant a l'id d'un forum
     * @return array $postList;
     * @see Post::GetAllByForumId($forum_id);
     */
    public static function GetAllByForumId($forum_id){
        global $db;
        $allPosts = $db->prepare('SELECT * FROM posts WHERE forum_id = :forum_id')->bindValue(':forum_id', $forum_id, PDO::PARAM_INT)->execute();
        $postList = array();
        while ($dataPost = $allPosts->fetch()){
            $newPost = new Post();
            $newPost->fill($dataPost);
            $postList[] = $newPost;
        }
        return $postList;
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
     * Fonction fill(), usage : $aPost->fill($array);
     * return : void
     * Cette fonction rempli l'objet $this avec les donnees qui lui sont passees dans le parametre $array
     * @param array Tableau contenant les donnees d'un objet Post, structure : {id, creator, text, post_time, topic_id, forum_id}
     */
    public function fill($data){
        $this->_id = $data['id'];
        $this->_creator = $data['creator'];
        $this->_text = $data['text'];
        $this->_post_time = $data['post_time'];
        $this->_topic_id = $data['topic_id'];
        $this->_forum_id = $data['forum_id'];
    }

    /**
     * Fonction insert(), usage : $aPost->insert($text);
     * return void
     * Cette fonction insert un nouveau post dans la base de donnees
     * @param creator   Int correspondant à l'id du createur du post
     * @param text      String contenant tout le text d'un post
     * @param topic_id  Int correspondant à l'id du topic ou est poste le post
     * @param forum_id  Int correspondant à l'id du forum dans lequel est poste le post
     */
    public function insert($creator, $text, $topic_id, $forum_id){
        global $db;
        $this->_creator = $creator;
        $this->_text = $text;
        $this->_post_time = date("Y-m-d");
        $this->_topic_id = $topic_id;
        $this->_forum_id = $forum_id;
        $insert = $db->prepare('INSERT INTO posts (id, creator, text, post_time, topic_id, forum_id) VALUES ("", :creator, :text, :post_time, :topic_id, :forum_id)');
        $insert->execute(array(
                "creator"   => $this->_creator,
                "text"      => $this->_text,
                "post_time" => $this->_post_time,
                "topic_id"  => $this->_topic_id,
                "forum_id"  => $this->_forum_id
            )
        );
    }

    /**
     * Fonction edit(), usage : $aPost->edit($text);
     * return void
     * Cette fonction modifie le text d'un post en le remplacant par le contenu de $text
     * @param text String contenant tout le text d'un post
     */
    public function edit($text){
        global $db;
        $this->_text = $text;
        $update = $db->prepare('UPDATE posts SET text =? WHERE id =?');
        $update->execute([$this->_text, $this->_id]);
    }

    /**
     * Fonction delete(), usage : $aPost->delete();
     * return void
     * Cette fonction supprime le post cible de la base de donnees
     */
    public function delete(){
        global $db;
        $delete = $db->prepare('DELETE FROM posts WHERE id = :id');
        $delete->bindValue(':id', $this->_id, PDO::PARAM_INT);
        $delete->execute();
    }
}