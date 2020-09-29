<?php
class producerTypes {
    public $id = 0;
    public $name = '';
    private $table = '`42pmz96_producerTypes`';
    private $db = null;
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    /**
     * Fonction vérifiant l'éxistance d'une valeur pour un champ donnée
     *
     * @param string $UQfield
     * @return bool
     */
    public function checkProducerTypesExistByID($UQfield = 'id'){
        $checkProducerTypesExistByID = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isExist`
            FROM ' . $this->table . 
           ' WHERE `'. $UQfield . '` = :' . $UQfield
        );
        $checkProducerTypesExistByID->bindValue(':' . $UQfield, $this->$UQfield, ($UQfield == 'id') ? PDO::PARAM_INT : PDO::PARAM_STR);
        $checkProducerTypesExistByID->execute();
        return $checkProducerTypesExistByID->fetch(PDO::FETCH_OBJ)->isExist;
    }
    /**
     * Récupére le nom d'un categorie par sont id
     *
     * @return string
     */
    public function getProducerTypeName(){
        $getProducerTypeName = $this->db->prepare(
            'SELECT `name`
            FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $getProducerTypeName->bindValue(':id', $this->id, PDO::PARAM_STR);
        $getProducerTypeName->execute();
        return $getProducerTypeName->fetch(PDO::FETCH_OBJ)->name;
    }
    /**
     * Fonction récupérant la list de toutes les categories de producteurs
     *
     * @return array
     */
    public function getProducerTypesList(){
        $getProducerTypesList = $this->db->query(
            'SELECT `id`, `name`
            FROM ' . $this->table
        );
        return $getProducerTypesList->fetchAll(PDO::FETCH_OBJ);
    } 
}