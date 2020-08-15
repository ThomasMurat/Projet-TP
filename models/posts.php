<?php
class posts {
    public $id = 0;
    public $image = '';
    public $content = '';
    public $postDate = '';
    public $lastEditDate = '';
    public $universe = '';
    public $author = '';
    public $postType = '';
    private $db = NULL;
    public function __construct(){
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=anymanga;charset=utf8', 'root', '');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
    public function getWelcomeContent(){
        $getWelcomeContentQuery = $this->db->prepare(
            'SELECT `pos`.`content`
            FROM `42pmz96_posts` AS `pos`
                LEFT JOIN `42pmz96_poststypes` AS `pot` ON `pos`.`id_42pmz96_postsTypes` = `pot`.`id`
                LEFT JOIN `42pmz96_users` AS `use` ON `pos`.`id_42pmz96_users` = `use`.`id`
                LEFT JOIN `42pmz96_universes` AS `uni` ON `pos`.`id_42pmz96_universes` = `uni`.`id`
            WHERE `pot`.`name` = \'accueil\' AND `uni`.`universe` = :universe'
        );
        $getWelcomeContentQuery->bindValue(':universe', $this->universe, PDO::PARAM_STR);
        $getWelcomeContentQuery->execute();
        $data = $getWelcomeContentQuery->fetch(PDO::FETCH_OBJ);
        $this->content = $data->content;
    }
}