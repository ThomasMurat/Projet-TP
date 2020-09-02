<?php
class users {
    public $id = 0;
    public $username = '';
    public $password = '';
    public $mail = '';
    public $birthDate = '';
    public $subscribDate = '';
    public $image = '';
    public $id_42pmz96_roles = '';
    private $db = NULL;
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    public function checkUserExist(){
        $checkUserExistQuery = $this->db->prepare(
            'SELECT COUNT(`username`) AS `isUserExist`
            FROM `42pmz96_users`
            WHERE `username` = :username');
        $checkUserExistQuery->bindValue(':username', $this->username, PDO::PARAM_STR);
        $checkUserExistQuery->execute();
        $data = $checkUserExistQuery->fetch(PDO::FETCH_OBJ);
        return $data->isUserExist;
    }
    public function checkMailExist(){
        $checkMailExistQuery = $this->db->prepare(
            'SELECT COUNT(`mail`) AS `isMailExist`
            FROM `42pmz96_users`
            WHERE `mail` = :mail');
        $checkMailExistQuery->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $checkMailExistQuery->execute();
        $data = $checkMailExistQuery->fetch(PDO::FETCH_OBJ);
        return $data->isMailExist;
    }
    public function registerNewUser(){
        $registerNewUserQuery = $this->db->prepare(
            'INSERT INTO `42pmz96_users` (`username`, `password`, `mail`, `birthDate`, `image`, `subscribDate`, `id_42pmz96_roles`)
            VALUES (:username, :password, :mail, :birthDate, :image, :subscribDate, :id_42pmz96_roles)'
        );
        $registerNewUserQuery->bindValue(':username', $this->username, PDO::PARAM_STR);
        $registerNewUserQuery->bindValue(':password', $this->password, PDO::PARAM_STR);
        $registerNewUserQuery->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $registerNewUserQuery->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $registerNewUserQuery->bindValue(':image', $this->image, PDO::PARAM_STR);
        $registerNewUserQuery->bindValue(':subscribDate', $this->subscribDate, PDO::PARAM_STR);
        $registerNewUserQuery->bindValue(':id_42pmz96_roles', $this->id_42pmz96_roles, PDO::PARAM_INT);
        return $registerNewUserQuery->execute();
    }
    public function getUsersList(){
        $getUsersList = $this->db->query(
            'SELECT `use`.`id`, `username`, `mail`, `birthDate`, `subscribDate`, `role`
            FROM `42pmz96_users` AS `use`
                INNER JOIN `42pmz96_roles` AS `rol` ON `rol`.`id` = `use`.`id_42pmz96_roles` '
        );
        return $getUsersList->fetchAll(PDO::FETCH_OBJ);
    }
    public function getUserInfo(){
        $getUserInfoQuery = $this->db->prepare(
            'SELECT `username`, `mail`, `birthDate`, `subscribDate`
            FROM `42pmz96_users`
            WHERE `id` = :id'
        );
        $getUserInfoQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        $getUserInfoQuery->execute();
        return $getUserInfoQuery->fetch(PDO::FETCH_OBJ);
    }
    public function getUserInfoByUsername(){
        $getUserInfoByUsernameQuery = $this->db->prepare(
            'SELECT `username`, `mail`, `birthDate`, `subscribDate`, `image`, `role`
            FROM `42pmz96_users` AS `use`
                INNER JOIN `42pmz96_roles` AS `rol` ON `rol`.`id` = `use`.`id_42pmz96_roles`
            WHERE `username` = :username'
        );
        $getUserInfoByUsernameQuery->bindValue(':username', $this->username, PDO::PARAM_STR);
        $getUserInfoByUsernameQuery->execute();
        return $getUserInfoByUsernameQuery->fetch(PDO::FETCH_OBJ);
    }
    public function getUserPassword(){
        $checkUserPasswordQuery = $this->db->prepare(
            'SELECT `password`
            FROM `42pmz96_users`
            WHERE `username` = :username'
        );
        $checkUserPasswordQuery->bindValue(':username', $this->username, PDO::PARAM_STR);
        $checkUserPasswordQuery->execute();
        return $checkUserPasswordQuery->fetch(PDO::FETCH_OBJ);
        
    }
    public function updateUserByUsername($fieldArray){
        $set = 'SET ';
        foreach($fieldArray as $field => $value){
            $setArray[$field] = '`' . $field . '` = :' . $field;
        }
        $set .= implode(',', $setArray);
        $updateUserByUsername = $this->db->prepare(
            'UPDATE `42pmz96_users` '
            . ($set) .
            ' WHERE `username` = :username'
        ); 
        foreach($fieldArray as $field => $value){
            $updateUserByUsername->bindValue(':'. $field , $value, PDO::PARAM_STR);
        }
        $updateUserByUsername->bindValue(':username', $this->username, PDO::PARAM_STR);
        return $updateUserByUsername->execute();
    }
}