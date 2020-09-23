<?php
class producers {
    public $id = 0;
    public $name = '';
    public $description = '';
    public $id_42pmz96_producerTypes = 0;
    private $table = '`42pmz96_producers`';
    private $db = null;
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    /**
     * Fonction vérifiant l'unicité d'une valeur pour un champs unique donné
     *
     * @param string $UQfield champs aux valeurs uniques
     * @return bool
     */
    public function checkProducerExist($UQfield = 'id'){
        $checkProducerExist = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isExist`
            FROM ' . $this->table . 
           ' WHERE `' . $UQfield . '` = :' . $UQfield
        );
        if($UQfield == 'id'){
            $checkProducerExist->bindValue(':id', $this->id, PDO::PARAM_INT);
        }else {
            $checkProducerExist->bindValue(':' . $UQfield, $this->$UQfield, PDO::PARAM_STR);
        }
        $checkProducerExist->execute();
        return $checkProducerExist->fetch(PDO::FETCH_OBJ)->isExist; 
    }
    /**
     * récupère les informations d'un producteur
     *
     * @param string $UQfield champ au valeurs unique
     * @return object
     */
    public function getProducerProfile($UQfield = 'id'){
        $getProducerProfile = $this->db->prepare(
            'SELECT `id`, `description` , `name`, `picture`, `id_42pmz96_producerTypes`
            FROM ' . $this->table . 
            ' WHERE `' . $UQfield . '` = :' . $UQfield
        );
        $getProducerProfile->bindValue(':' . $UQfield, $this->$UQfield, ($UQfield == 'id') ? PDO::PARAM_INT : PDO::PARAM_STR);
        $getProducerProfile->execute();
        return $getProducerProfile->fetch(PDO::FETCH_OBJ);
    }
    /**
     * Fonction récupérant une liste de producteur
     *
     * @param [array] $searchArray tableau assoc propre à la recherche
     * @param array $pageArray tableau assoc propre à la pagination
     * @return array
     */
    public function getProducersList($searchArray, $pageArray = array()){
        $where = '';
        if(!empty($searchArray)){
            $where = ' WHERE ';
            $whereArray = array();
            foreach($searchArray as $fieldName => $value){
                if($fieldName == 'name'){
                    $whereArray[$fieldName] =  '`prod`.`' . $fieldName . '` LIKE :' . $fieldName;
                }
                if($fieldName == 'id_42pmz96_producerTypes'){
                    $whereArray[$fieldName] = ' `' . $fieldName . '` = :' . $fieldName;
                }
            }
            $where .= implode(' AND ', $whereArray);
        }
        $query = 
        $getProducersList = $this->db->prepare(
            'SELECT `prod`.`id` AS `prodId`, `prod`.`name` AS `prodName`, `typ`.`name`AS `typName`
            FROM ' . $this->table . ' AS `prod`
                INNER JOIN `42pmz96_producerTypes` AS `typ` ON `id_42pmz96_producerTypes` = `typ`.`id` '
            . $where . ' '
            . (count($pageArray) == 2 ? 'LIMIT :limit OFFSET :offset' : '')
        );
        foreach($searchArray as $fieldName => $value){
            if($fieldName == 'id_42pmz96_producerTypes'){
                $getProducersList->bindValue(':' . $fieldName, $value, PDO::PARAM_INT);
            }else {
                $getProducersList->bindValue(':' . $fieldName, $value, PDO::PARAM_STR);
            }
        }
        if (count($pageArray) == 2){
            $getProducersList->bindvalue(':limit', $pageArray['limit'], PDO::PARAM_INT);
            $getProducersList->bindvalue(':offset', $pageArray['offset'], PDO::PARAM_INT);
        }
        $getProducersList->execute();
        return $getProducersList->fetchAll(PDO::FETCH_OBJ);
    }
    /**
     * Ajoute un producteur
     *
     * @return bool
     */
    public function addProducer(){
        $addProducer = $this->db->prepare(
            'INSERT INTO ' . $this->table . ' (`description`, `name`, `picture`, `id_42pmz96_producerTypes`)
            VALUES (:description, :name, :picture, :id_42pmz96_producerTypes)'
        );
        $addProducer->bindValue(':description', $this->description, PDO::PARAM_STR);
        $addProducer->bindValue(':name', $this->name, PDO::PARAM_STR);
        $addProducer->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $addProducer->bindValue(':id_42pmz96_producerTypes', $this->id_42pmz96_producerTypes, PDO::PARAM_INT);
        return $addProducer->execute();
    }
    /**
     * Met à jour un producteur selon son id
     *
     * @return bool
     */
    public function updateProducer(){
        $updateProducer = $this->db->prepare(
            'UPDATE ' . $this->table .
            ' SET `name` = :name, `picture` = :picture, `id_42pmz96_producerTypes` = :id_42pmz96_producerTypes
            WHERE `id` = :id'
        );
        $updateProducer->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateProducer->bindValue(':name', $this->name, PDO::PARAM_STR);
        $updateProducer->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $updateProducer->bindValue(':id_42pmz96_producerTypes', $this->id_42pmz96_producerTypes, PDO::PARAM_INT);
        return $updateProducer->execute();
    }
    public function deleteProducer(){
        $deleteProducer = $this->db->prepare(
            'DELETE FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $deleteProducer->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteProducer->execute();
    }
}