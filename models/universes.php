<?php
class universes {
    public $id = 0;
    public $universe = '';
    private $table = '`42pmz96_universes`';
    private $db = null;
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    /**
     * Vérifie si un univer existe selon son nom ou son id
     *
     * @param string $UQfield
     * @return bool
     */
    function universeExist($UQfield = 'id'){
        $universeExist = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isUniverseExist`
            FROM ' . $this->table .
            ' WHERE `' . $UQfield . '` = :' . $UQfield
        );
        $universeExist->bindValue(':' . $UQfield, $this->$UQfield, ($UQfield = 'id') ? PDO::PARAM_INT : PDO::PARAM_STR);
        $universeExist->execute();
        return $universeExist->fetch(PDO::FETCH_OBJ)->isUniverseExist;
    }
    /**
     * Récupére la liste des univers et leur id
     *
     * @return array
     */
    public function getUniversesList(){
        $getUniversesList = $this->db->query(
            'SELECT `id`, `universe`
            FROM ' . $this->table
        );
        return $getUniversesList->fetchAll(PDO::FETCH_OBJ);
    }
    /**
     * Fonction récupérant le nom de l'univer correspondant à l'id envoyer
     *
     * @return string
     */
    public function getUniverseName(){
        $getUniverseName = $this->db->prepare(
            'SELECT `universe`
            FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $getUniverseName->bindValue(':id', $this->id, PDO::PARAM_INT);
        $getUniverseName->execute();
        return $getUniverseName->fetch(PDO::FETCH_OBJ)->universe;
    }

}