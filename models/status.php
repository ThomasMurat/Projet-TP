<?php
class status {
    public $id = 0;
    public $name = '';
    private $db = NULL;
    private $table = '`42pmz96_status`';
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    /**
     * Vérifie l'éxistance d'un statu par son id
     *
     * @return bool
     */
    public function checkStatusExist(){
        $checkStatusExist = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isExist`
            FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $checkStatusExist->bindValue(':id', $this->id, PDO::PARAM_INT);
        $checkStatusExist->execute();
        return $checkStatusExist->fetch(PDO::FETCH_OBJ)->isExist;
    }
    /**
     * Récupère la liste des status 
     *
     * @return array
     */
    public function getStatusList(){
        $getStatusList = $this->db->query(
            'SELECT `id`, `name`
            FROM ' . $this->table 
        );
        return $getStatusList->fetchAll(PDO::FETCH_OBJ);
    }
}