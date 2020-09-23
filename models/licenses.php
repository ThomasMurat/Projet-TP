<?php
class licenses {
    public $id = 0;
    public $name = '';
    public $creationDate = '';
    private $db = null;
    private $table = '`42pmz96_licenses`';
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    /**
     * Fonction vérifiant l'unicité d'une valeur pour un champs unique donné
     *
     * @param string $UQfield champs aux valeurs uniques
     * @return bool
     */
    public function checkLicensesValueUnavailability($UQfield = 'id'){
        $checkLicensesValueUnavailability = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isUnavailable`
            FROM ' . $this->table . 
           ' WHERE `' . $UQfield . '` = :' . $UQfield
        );
        if($UQfield == 'id'){
            $checkLicensesValueUnavailability->bindValue(':id', $this->id, PDO::PARAM_INT);
        }else {
            $checkLicensesValueUnavailability->bindValue(':' . $UQfield, $this->$UQfield, PDO::PARAM_STR);
        }
        $checkLicensesValueUnavailability->execute();
        return $checkLicensesValueUnavailability->fetch(PDO::FETCH_OBJ)->isUnavailable; 
    }
    /**
     * Fonction récupérant le nom de la license correspondant à l'id envoyer
     *
     * @return string
     */
    public function getLicenseName(){
        $getLicenseName = $this->db->prepare(
            'SELECT `name`
            FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $getLicenseName->bindValue(':id', $this->id, PDO::PARAM_INT);
        $getLicenseName->execute();
        return $getLicenseName->fetch(PDO::FETCH_OBJ)->name;
    } 
    /**
     * Fonction récupérant la liste des noms des licenses
     *
     * @return array
     */
    public function getLicensesNameList(){
        $getLicensesNameList = $this->db->query(
            'SELECT `id`, `name`
            FROM ' . $this->table
        );
        return $getLicensesNameList->fetchAll(PDO::FETCH_OBJ);
    }
    /**
     * Fonction permettant de récupérer une liste de licence et toute leurs infos
     *
     * @param [array] $searchArray tableau associatif propre à la recherche
     * @param array $pageArray tableau asssociatif propre à la pagination
     * @return array
     */
    public function getLicensesList($searchArray, $pageArray = array()){
        $where = '';
        $whereArray = array();
        if(!empty($searchArray)){
            $where = ' WHERE ';
            $whereArray = array();
            foreach($searchArray as $fieldName => $value){
                if($fieldName == 'name'){
                    $whereArray[$fieldName] = ' `' . $fieldName . '` LIKE :' . $fieldName;
                }else if($fieldName == 'creationDate'){
                    $whereArray['creationDate'] = ' `creationDate` > :creationDate ';
                }else{
                    $whereArray[$fieldName] = ' `' . $fieldName . '` = :' . $fieldName;
                }
            }
            $where .= implode(' AND ', $whereArray);
        }
        $getLicensesListQuery = $this->db->prepare(
            'SELECT `pre`.`id` AS `presId`, `image`, `presentation`, `lic`.`id` AS `licId`, `universe`
                    ,`name`, `creationDate` 
            FROM ' . $this->table . ' AS `lic`
                LEFT JOIN `42pmz96_presentations` AS `pre` ON `id_42pmz96_licenses` = `lic`.`id`
                LEFT JOIN `42pmz96_universes` AS `uni` ON `id_42pmz96_universes` = `uni`.`id` '
            . $where . 
            ' ORDER BY `name` '
            . (count($pageArray) == 2 ? ' LIMIT :limit OFFSET :offset' : '')  
        );
        foreach($searchArray as $fieldName => $value){
            if($fieldName == 'id_42pmz96_universes' || $fieldName == 'id_42pmz96_licenses'){
                $getLicensesListQuery->bindValue(':' . $fieldName, $value, PDO::PARAM_INT);
            }else {
                $getLicensesListQuery->bindValue(':' . $fieldName, $value, PDO::PARAM_STR);
            }
        }
        if (count($pageArray) == 2){
            $getLicensesListQuery->bindvalue(':limit', $pageArray['limit'], PDO::PARAM_INT);
            $getLicensesListQuery->bindvalue(':offset', $pageArray['offset'], PDO::PARAM_INT);
        }
        $getLicensesListQuery->execute();
        return $getLicensesListQuery->fetchAll(PDO::FETCH_OBJ);
    }
    /**
     * Function permettant d'insérer une License
     *
     * @return bool
     */
    public function addLicense(){
        $addLicense = $this->db->Prepare(
            'INSERT INTO ' . $this->table . ' (`name`, `creationDate`)
            VALUES (:name, :creationDate)'
        );
        $addLicense->bindValue(':name', $this->name, PDO::PARAM_STR);
        $addLicense->bindValue(':creationDate', $this->creationDate, PDO::PARAM_STR);
        return $addLicense->execute();
    } 
    /**
     * Fonction permettant la modification d'une license
     *
     * @return bool
     */
    public function updateLicense(){
        $updateUser = $this->db->prepare(
            'UPDATE ' . $this->table . 
            ' SET `name`= :name, `creationDate` = :creationDate
            WHERE `id` = :id'
        ); 
        $updateUser->bindValue(':name' , $this->name, PDO::PARAM_STR);
        $updateUser->bindValue(':creationDate' , $this->creationDate, PDO::PARAM_STR);
        $updateUser->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $updateUser->execute();
    }
    /**
     * Function supprimant une license et ses présentations
     *
     * @return bool
     */
    public function deleteLicense(){
        $deleteLicense = $this->db->prepare(
            'DELETE FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $deleteLicense->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteLicense->execute();
    }
}