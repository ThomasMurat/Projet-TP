<?php
class producerRoles {
    public $id = 0;
    public $role = '';
    private $table = '`42pmz96_producerRoles`';
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
    public function checkProducerRolesExistByID($UQfield = 'id'){
        $checkProducerRolesExistByID = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isExist`
            FROM ' . $this->table . 
           ' WHERE `'. $UQfield . '` = :' . $UQfield
        );
        $checkProducerRolesExistByID->bindValue(':' . $UQfield, $this->$UQfield, ($UQfield == 'id') ? PDO::PARAM_INT : PDO::PARAM_STR);
        $checkProducerRolesExistByID->execute();
        return $checkProducerRolesExistByID->fetch(PDO::FETCH_OBJ)->isExist;
    }
    /**
     * Fonction récupérant la list de toutes les categories de producteurs
     *
     * @return array
     */
    public function getProducerRolesList(){
        $getProducerRolesList = $this->db->query(
            'SELECT `id`, `role`
            FROM ' . $this->table
        );
        return $getProducerRolesList->fetchAll(PDO::FETCH_OBJ);
    } 
}