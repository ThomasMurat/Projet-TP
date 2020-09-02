<?php 
class licencesPresentation {
    public $id = 0;
    public $presentation = '';
    public $image = '';
    public $universe = '';
    public $license = '';
    private $db = NULL;
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    public function getLicensesList(){
        $getLicensesListQuery = $this->db->prepare(
            'SELECT `pre`.`id`, `pre`.`image`, `pre`.`presentation`
                    ,`lic`.`name`, `lic`.`creationDate`
                    ,`uni`.`universe`
            FROM `42pmz96_presentations` AS `pre`
                LEFT JOIN `42pmz96_licenses` AS `lic` ON `pre`.`id_42pmz96_licenses` = `lic`.`id`
                LEFT JOIN `42pmz96_universes` AS `uni` ON `pre`.`id_42pmz96_universes` = `uni`.`id`
            WHERE `lic`.`id` > 1 AND `uni`.`universe` = :universe'
        );
        $getLicensesListQuery->bindValue(':universe', $this->universe, PDO::PARAM_STR);
        $getLicensesListQuery->execute();
        $data = $getLicensesListQuery->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
}