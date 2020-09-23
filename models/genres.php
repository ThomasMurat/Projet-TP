<?php
class genres {
    public $id = 0;
    public $name = '';
    private $table = '`42pmz96_genres`';
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
    public function checkGenresExistByID($UQfield = 'id'){
        $checkGenresExistByID = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isExist`
            FROM ' . $this->table . 
           ' WHERE `'. $UQfield . '` = :' . $UQfield
        );
        $checkGenresExistByID->bindValue(':' . $UQfield, $this->$UQfield, ($UQfield == 'id') ? PDO::PARAM_INT : PDO::PARAM_STR);
        $checkGenresExistByID->execute();
        return $checkGenresExistByID->fetch(PDO::FETCH_OBJ)->isExist;
    }
    /**
     * Récupére le nom d'un genre par sont id
     *
     * @return string
     */
    public function getGenresName(){
        $getGenresName = $this->db->prepare(
            'SELECT `name`
            FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $getGenresName->bindValue(':id', $this->id, PDO::PARAM_STR);
        $getGenresName->execute();
        return $getGenresName->fetch(PDO::FETCH_OBJ)->name;
    }
    /**
     * Fonction récupérant la list des genres
     *
     * @return array
     */
    public function getGenresList(){
        $getGenresList = $this->db->query(
            'SELECT `id`, `name`
            FROM ' . $this->table
        );
        return $getGenresList->fetchAll(PDO::FETCH_OBJ);
    } 
}