<?php
class roles {
    public $id = 0;
    public $role = '';
    private $db = null;
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    public function checkRoleExistByID(){
        $checkRoleExistByID = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isRoleExiste`
            FROM `42pmz96_roles`
            WHERE `id` = :id'
        );
        $checkRoleExistByID->bindValue(':id', $this->id, PDO::PARAM_INT);
        $checkRoleExistByID->execute();
        return $checkRoleExistByID->fetch(PDO::FETCH_OBJ)->isRoleExiste;
    }
    public function getRolesList(){
        $getRolesList = $this->db->query(
            'SELECT `id`, `role`
            FROM `42pmz96_roles`'
        );
        return $getRolesList->fetchAll(PDO::FETCH_OBJ);
    }
}