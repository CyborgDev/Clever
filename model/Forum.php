<?php
class Forum {
    /**
     * Variables de l'objets
     * @var int $_forum_id;
     * @var int $_cat_id;
     * @var string $_name;
     * @var string $_description;
     * @var int $_forum_parent_id;
     * @var int $_list_order;
     * @var int $_last_post_id;
     * @var int $_nb_topic;
     * @var int $_nb_post;
     * @var int $_auth_view;
     * @var int $_auth_post;
     * @var int $_auth_announcement;
     * @var int $_auth_modo;
     */
    private $_forum_id;
    private $_cat_id;
    private $_name;
    private $_description;
    private $_forum_parent_id;
    private $_list_order;
    private $_last_post_id;
    private $_nb_topic;
    private $_nb_post;
    private $_auth_view;
    private $_auth_post;
    private $_auth_announcement;
    private $_auth_modo;

    /**
     * Constructeur
     */
    public function __construct(){
        $this->_forum_id = -1;
        $this->_cat_id = -1;
        $this->_name = "";
        $this->_description = "";
        $this->_forum_parent_id = -1;
        $this->_list_order = -1;
        $this->_last_post_id = -1;
        $this->_nb_topic = -1;
        $this->_nb_post = -1;
        $this->_auth_view = -1;
        $this->_auth_post = -1;
        $this->_auth_announcement = -1;
        $this->_auth_modo = -1;
    }

    // -------------------------------------------------------------------------------------------------------------- //
    /**
     * Fonctions statiques de classe
     * Ces fonctions doivent servir à la recuperation de plusieurs Topics a la fois
     */

    
}