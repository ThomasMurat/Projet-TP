<?php
class postsTypes {
    public $id = 0;
    public $name = '';
    private $db = NULL;
    private $table = '`42pmz96_postsTypes`';
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    /**
     * Vérifie l'éxistance d'une categorie par son id
     *
     * @return bool
     */
    public function checkPostTypesExist(){
        $checkPostTypesExist = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isExist`
            FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $checkPostTypesExist->bindValue(':id', $this->id, PDO::PARAM_INT);
        $checkPostTypesExist->execute();
        return $checkPostTypesExist->fetch(PDO::FETCH_OBJ)->isExist;
    }
    /**
     * Récupère la liste des categorie d'article 
     *
     * @return array
     */
    public function getCategoriesList(){
        $getCategoriesList = $this->db->query(
            'SELECT `id`, `name`
            FROM ' . $this->table 
        );
        return $getCategoriesList->fetchAll(PDO::FETCH_OBJ);
    }
}