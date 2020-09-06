<?php
class roles {
    public $id = 0;
    public $role = '';
    private $db = null;
    private $table = '`42pmz96_roles`';
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    public function checkRoleExistByID(){
        $checkRoleExistByID = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isRoleExiste`
            FROM ' . $this->table . 
           ' WHERE `id` = :id'
        );
        $checkRoleExistByID->bindValue(':id', $this->id, PDO::PARAM_INT);
        $checkRoleExistByID->execute();
        return $checkRoleExistByID->fetch(PDO::FETCH_OBJ)->isRoleExiste;
    }
    /**
     * Fonction récupérant la list de tous les rôles existant pour les utilisateurs
     *
     * @return array
     */
    public function getRolesList(){
        $getRolesList = $this->db->query(
            'SELECT `id`, `role`
            FROM ' . $this->table
        );
        return $getRolesList->fetchAll(PDO::FETCH_OBJ);
    }
}