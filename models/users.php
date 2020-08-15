<?php
class users {
    public $id = 0;
    public $username = '';
    public $password = '';
    public $mail = '';
    public $birthDate = '';
    public $subscribDate = '';
    public $role = '';
    private $db = NULL;
    public function __construct(){
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=anymanga;charset=utf8', 'root', '');
        } catch (Exception $error) {
            die($error->getMessage());
        }
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
            'INSERT INTO `42pmz96_users` (`username`, `password`, `mail`, `birthDate`, `subscribDate`, `id_42pmz96_roles`)
            VALUES (:username, :password, :mail, :birthDate, :subscribDate, 2)'
        );
        $registerNewUserQuery->bindValue(':username', $this->username, PDO::PARAM_STR);
        $registerNewUserQuery->bindValue(':password', $this->password, PDO::PARAM_STR);
        $registerNewUserQuery->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $registerNewUserQuery->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $registerNewUserQuery->bindValue(':subscribDate', $this->subscribDate, PDO::PARAM_STR);
        return $registerNewUserQuery->execute();
    }
    public function getUserInfo(){
        $getUserInfoQuery = $this->db->prepare(
            'SELECT `username`, `mail`, `birthDate`, `subscribDate`
            FROM `42pmz96_users`
            WHERE `id` = :id'
        );
        $getUserInfoQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        $getUserInfoQuery->execute();
        $data = $getUserInfoQuery->fetch(PDO::FETCH_OBJ);
        return $data;
    }
    public function getUserPassword(){
        $checkUserPasswordQuery = $this->db->prepare(
            'SELECT `password`
            FROM `42pmz96_users`
            WHERE `username` = :username'
        );
        $checkUserPasswordQuery->bindValue(':username', $this->username, PDO::PARAM_STR);
        $checkUserPasswordQuery->execute();
        $data = $checkUserPasswordQuery->fetch(PDO::FETCH_OBJ);
        $this->password = $data->password;
    }
}