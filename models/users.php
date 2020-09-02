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
    private $table = '`42pmz96_users`';
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    /**
     * Function permettant de vérifié si la valeur d'un champ existe déjà dans la DB
     *
     * @param [string] $UQfield champ au valeurs uniques
     * @return bool
     */
    public function checkUserValueUnavailability($UQfield = 'username'){
        $checkvalueUnavailability = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isUnavailable`
            FROM ' . $this->table . 
           ' WHERE `' . $UQfield . '` = :' . $UQfield
        );
        if($UQfield == 'id'){
            $checkvalueUnavailability->bindValue(':id', $this->id, PDO::PARAM_INT);
        }else {
            $checkvalueUnavailability->bindValue(':' . $UQfield, $this->$UQfield, PDO::PARAM_STR);
        }
        $checkvalueUnavailability->execute();
        return $checkvalueUnavailability->fetch(PDO::FETCH_OBJ)->isUnavailable;
       
    }
    /**
     * Fonction permettant l'ajout d'un nouvel utilisateur
     *
     * @return bool
     */
    public function addUser(){
        $registerNewUserQuery = $this->db->prepare(
            'INSERT INTO ' . $this->table . ' (`username`, `password`, `mail`, `birthDate`, `image`, `subscribDate`, `id_42pmz96_roles`)
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
    /**
     * Fonction permettant de récupérer la liste des utilisateurs
     *
     * @return array
     */
    public function getUsersList(){
        $getUsersList = $this->db->query(
            'SELECT `use`.`id`, `username`, `mail`, `birthDate`, `subscribDate`, `role`
            FROM ' . $this->table . ' AS `use`
                INNER JOIN `42pmz96_roles` AS `rol` ON `rol`.`id` = `use`.`id_42pmz96_roles` '
        );
        return $getUsersList->fetchAll(PDO::FETCH_OBJ);
    }
    /**
     * Fonction permettant de récupérer toutes les informations sur un utilisateur
     *
     * @param string $UQfield champ au valeurs uniques
     * @return object
     */
    public function getUserProfile($UQfield = 'username'){
        ($UQfield == 'id') ? $joinfield = 'use`.`id' : $joinfield = $UQfield;
        $getUserProfile = $this->db->prepare(
            'SELECT `use`.`id` AS `userId`, `username`, `mail`, `birthDate`, `subscribDate`, `image`, `role`
            FROM ' . $this->table . ' AS `use`
                INNER JOIN `42pmz96_roles` AS `rol` ON `rol`.`id` = `use`.`id_42pmz96_roles`
            WHERE `' . $joinfield . '` = :' . $UQfield
        );
        if($UQfield == 'id'){
            $getUserProfile->bindValue(':id', $this->id, PDO::PARAM_INT);
        }else {
            $getUserProfile->bindValue(':' . $UQfield, $this->$UQfield, PDO::PARAM_STR);
        }
        $getUserProfile->execute();
        return $getUserProfile->fetch(PDO::FETCH_OBJ);
    }
    /**
     * Fonction permettant de récupérer le hash du mot de passe d'un utilisateur
     *
     * @param string $UQfield champ au valeurs uniques
     * @return string
     */
    public function getUserPassword($UQfield = 'username'){
        $getUserPassword = $this->db->prepare(
            'SELECT `password`
            FROM ' . $this->table .
           ' WHERE `' . $UQfield . '` = :' . $UQfield
        );
        if($UQfield == 'id'){
            $getUserPassword->bindValue(':id', $this->id, PDO::PARAM_INT);
        }else {
            $getUserPassword->bindValue(':' . $UQfield, $this->$UQfield, PDO::PARAM_STR);
        }
        $getUserPassword->execute();
        return $getUserPassword->fetch(PDO::FETCH_OBJ)->password;
        
    }
    /**
     * Fonction permettants de modifier les informations d'un utilisateur
     *
     * @param [array] $setFieldArray tableau des noms de champ à modifier
     * @param string $UQfield champ au valeurs uniques
     * @return bool
     */
    public function updateUser($setFieldArray,$UQfield = 'username'){
        $set = 'SET ';
        foreach($setFieldArray as $field){
            $setArray[$field] = '`' . $field . '` = :' . $field;
        }
        $set .= implode(',', $setArray);
        $updateUser = $this->db->prepare(
            'UPDATE ' . $this->table . 
            ' ' . ($set) .
            ' WHERE `' . $UQfield . '` = :' . $UQfield
        ); 
        foreach($setFieldArray as $field){
            $updateUser->bindValue(':'. $field , $this->$field, PDO::PARAM_STR);
        }
        if($UQfield == 'id'){
            $updateUser->bindValue(':id', $this->id, PDO::PARAM_INT);
        }else {
            $updateUser->bindValue(':' . $UQfield, $this->$UQfield, PDO::PARAM_STR);
        }
        return $updateUser->execute();
    }
}