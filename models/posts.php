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
    private $table = '`42pmz96_posts`';
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    public function getWelcomeContent(){
        $getWelcomeContentQuery = $this->db->prepare(
            'SELECT `content`
            FROM ' . $this->table . ' AS `pos`
                LEFT JOIN `42pmz96_poststypes` AS `pot` ON `pos`.`id_42pmz96_postsTypes` = `pot`.`id`
                LEFT JOIN `42pmz96_users` AS `use` ON `pos`.`id_42pmz96_users` = `use`.`id`
                LEFT JOIN `42pmz96_universes` AS `uni` ON `pos`.`id_42pmz96_universes` = `uni`.`id`
            WHERE `name` = \'accueil\' AND `universe` = :universe'
        );
        $getWelcomeContentQuery->bindValue(':universe', $this->universe, PDO::PARAM_STR);
        $getWelcomeContentQuery->execute();
        $this->content = $getWelcomeContentQuery->fetch(PDO::FETCH_OBJ)->content;
    }
}