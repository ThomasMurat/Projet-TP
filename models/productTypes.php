<?php
class productTypes {
    public $id = 0;
    public $name = '';
    private $db = NULL;
    private $table = '`42pmz96_productTypes`';
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    /**
     * Vérifie l'éxistance d'un type de produit par son id
     *
     * @return bool
     */
    public function checkProductTypesExist(){
        $checkProductTypesExist = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isExist`
            FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $checkProductTypesExist->bindValue(':id', $this->id, PDO::PARAM_INT);
        $checkProductTypesExist->execute();
        return $checkProductTypesExist->fetch(PDO::FETCH_OBJ)->isExist;
    }
    /**
     * Récupère la liste des type de produit 
     *
     * @return array
     */
    public function getproductTypesList(){
        $getProductTypesList = $this->db->query(
            'SELECT `id`, `name`
            FROM ' . $this->table 
        );
        return $getProductTypesList->fetchAll(PDO::FETCH_OBJ);
    }
}