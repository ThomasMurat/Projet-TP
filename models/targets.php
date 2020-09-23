<?php
class targets {
    public $id = 0;
    public $target = '';
    private $db = NULL;
    private $table = '`42pmz96_targets`';
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    /**
     * Vérifie l'éxistance d'une cible par son id
     *
     * @return bool
     */
    public function checkTargetsExist(){
        $checkTargetsExist = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isExist`
            FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $checkTargetsExist->bindValue(':id', $this->id, PDO::PARAM_INT);
        $checkTargetsExist->execute();
        return $checkTargetsExist->fetch(PDO::FETCH_OBJ)->isExist;
    }
    /**
     * Récupère la liste des cibles
     *
     * @return array
     */
    public function getTargetsList(){
        $getTargetsList = $this->db->query(
            'SELECT `id`, `target`
            FROM ' . $this->table 
        );
        return $getTargetsList->fetchAll(PDO::FETCH_OBJ);
    }
}