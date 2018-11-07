<?php
    try{
        $db = new PDO('mysql:host=localhost;dbname=clever_db', 'root', '');
    } catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
    ?>