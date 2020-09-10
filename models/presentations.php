<?php
class presentations {
    public $id = 0;
    public $presentation = '';
    public $image = '';
    public $id_42pmz96_universes = 0;
    public $id_42pmz96_licenses = 0;
    private $db = null;
    private $table = '`42pmz96_presentations`';
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    /**
     * Fonction vérifiant l'unicité d'une valeur pour un champs unique donné
     *
     * @param string $UQfield champs aux valeurs uniques
     * @return bool
     */
    public function checkPresentationValueUnavailability($UQfield = 'id'){
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
     * Fonction recupérant toutes les informations propre à une license
     *
     * @param string $UQfield champ aux valeurs uniques
     * @return object
     */
    public function getLicenseProfile($UQfield = 'id'){
        ($UQfield == 'id') ? $joinfield = 'pre`.`id' : $joinfield = $UQfield;
        $getLicenseProfile = $this->db->prepare(
            'SELECT `pre`.`id` AS `presId`, `image`, `presentation`
            ,`name`, `creationDate`, `universe`, `id_42pmz96_licenses` 
            FROM ' . $this->table . ' AS `pre`
                LEFT JOIN `42pmz96_licenses` AS `lic` ON `pre`.`id_42pmz96_licenses` = `lic`.`id`
                LEFT JOIN `42pmz96_universes` AS `uni` ON `pre`.`id_42pmz96_universes` = `uni`.`id`
            WHERE `' . $joinfield . '` = :' . $UQfield
        );
        if($UQfield == 'id'){
            $getLicenseProfile->bindValue(':id', $this->id, PDO::PARAM_INT);
        }else {
            $getLicenseProfile->bindValue(':' . $UQfield, $this->$UQfield, PDO::PARAM_STR);
        }
        $getLicenseProfile->execute();
        return $getLicenseProfile->fetch(PDO::FETCH_OBJ);
    }
    /**
     * Fonction permettant la modification d'une license
     *
     * @return void
     */
    public function updatePresentation(){
        $updateUser = $this->db->prepare(
            'UPDATE ' . $this->table . 
            ' SET `presentation`= :presentation, `image` = :image
            WHERE `id` = :id'
        ); 
        $updateUser->bindValue(':presentation' , $this->presentation, PDO::PARAM_STR);
        $updateUser->bindValue(':image' , $this->image, PDO::PARAM_STR);
        $updateUser->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $updateUser->execute();
    }
    /**
     * Function supprimant une présentation
     *
     * @return bool
     */
    public function deletePresentation(){
        $deleteLicense = $this->db->prepare(
            'DELETE FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $deleteLicense->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteLicense->execute();
    }
}