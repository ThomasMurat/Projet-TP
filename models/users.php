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
    public $desactivationDate = '';
    public $statu = 1;
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
            'INSERT INTO ' . $this->table . ' (`username`, `password`, `mail`, `birthDate`, `image`, `subscribDate`, `id_42pmz96_roles`, `statu`)
            VALUES (:username, :password, :mail, :birthDate, :image, :subscribDate, :id_42pmz96_roles, 1)'
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
     * Fonction permettant de récupérer une liste d'utilisateurs
     *
     * @param array $searchArray tableau associatif propre à la recherche
     * @param array $pageArray tableau associatif propre à la pagination
     * @return array
     */
    public function getUsersList($searchArray = array(), $pageArray = array()){
        $where = '';
        if(!empty($searchArray)){
            $where = ' WHERE ';
            $whereArray = array();
            foreach($searchArray as $fieldName => $value){
                if($fieldName == 'username' || $fieldName == 'mail'){
                    $whereArray[$fieldName] = ' `' . $fieldName . '` LIKE :' . $fieldName;
                }
                if($fieldName == 'birthDate'){
                    $whereArray['birthDate'] = ' `birthDate` < :birthDate ';
                }
                if($fieldName == 'id_42pmz96_roles' || $fieldName == 'statu'){
                    $whereArray[$fieldName] = ' `' . $fieldName . '` = :' . $fieldName;
                }
            }
            $where .= implode(' AND ', $whereArray);
        } 
        $getUsersList = $this->db->prepare(
            'SELECT `use`.`id`, `username`, `mail`, `birthDate`, `subscribDate`, `role`, `desactivationDate`, `statu`
            FROM ' . $this->table . ' AS `use`
                INNER JOIN `42pmz96_roles` AS `rol` ON `rol`.`id` = `use`.`id_42pmz96_roles` '
        . $where . ' '
        . (count($pageArray) == 2 ? 'LIMIT :limit OFFSET :offset' : '')
        );
        foreach($searchArray as $fieldName => $value){
            if($fieldName == 'id_42pmz96_roles'){
                $getUsersList->bindValue(':id_42pmz96_roles', $value, PDO::PARAM_INT);
            }else if($fieldName == 'statu'){
                $getUsersList->bindValue(':statu', $value, PDO::PARAM_BOOL);
            }else{
                $getUsersList->bindValue(':' . $fieldName, $value, PDO::PARAM_STR);
            }
        }
        if (count($pageArray) == 2){
            $getUsersList->bindvalue(':limit', $pageArray['limit'], PDO::PARAM_INT);
            $getUsersList->bindvalue(':offset', $pageArray['offset'], PDO::PARAM_INT);
        }
        $getUsersList->execute();
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
            'SELECT `use`.`id` AS `userId`, `username`, `mail`, `birthDate`, `subscribDate`, `image`, `role`, `statu`, `desactivationDate`
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
        $data = $getUserPassword->fetch(PDO::FETCH_OBJ);
        if(is_object($data)){
            return $data->password;
        }else {
            return '';
        }  
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
            if($field == 'statu'){
                $updateUser->bindValue(':statu' , $this->statu, PDO::PARAM_BOOL);
            }else {
                $updateUser->bindValue(':'. $field , $this->$field, ($field == 'id_42pmz96_roles') ? PDO::PARAM_INT : PDO::PARAM_STR);
            }
        }
        $updateUser->bindValue(':' . $UQfield, $this->$UQfield, ($UQfield == 'id') ? PDO::PARAM_INT : PDO::PARAM_STR);
        return $updateUser->execute();
    }
    /**
     * Fonction permettant la suppression d'un utilisateur celon son id
     *
     * @return bool
     */
    public function deleteUser(){
        $deleteUser = $this->db->prepare(
            'DELETE FROM ' . $this->table .
            ' WHERE `id` = :id');
        $deleteUser->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteUser->execute();
    }
}