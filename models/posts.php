<?php
class posts {
    public $id = 0;
    public $title = '';
    public $image = '';
    public $content = '';
    public $postDate = '';
    public $lastEditDate = '';
    public $id_42pmz96_universes = '';
    public $id_42pmz96_users = '';
    public $id_42pmz96_postsTypes = '';
    private $db = NULL;
    private $table = '`42pmz96_posts`';
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    /**
     * Vérifie l'existance d'un article selon son id
     *
     * @return bool
     */
    public function checkPostExist(){
        $checkPostExist = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isExist`
            FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $checkPostExist->bindValue(':id', $this->id, PDO::PARAM_INT);
        $checkPostExist->execute();
        return $checkPostExist->fetch(PDO::FETCH_OBJ)->isExist;
    }
    public function getWelcomeContent(){
        $getWelcomeContentQuery = $this->db->prepare(
            'SELECT `content`
            FROM ' . $this->table . ' AS `pos`
                INNER JOIN `42pmz96_poststypes` AS `pot` ON `pos`.`id_42pmz96_postsTypes` = `pot`.`id`
                INNER JOIN `42pmz96_users` AS `use` ON `pos`.`id_42pmz96_users` = `use`.`id`
                INNER JOIN `42pmz96_universes` AS `uni` ON `pos`.`id_42pmz96_universes` = `uni`.`id`
            WHERE `name` = \'accueil\' AND `id_42pmz96_universes` = :id_42pmz96_universes'
        );
        $getWelcomeContentQuery->bindValue(':id_42pmz96_universes', $this->id_42pmz96_universes, PDO::PARAM_STR);
        $getWelcomeContentQuery->execute();
        $this->content = $getWelcomeContentQuery->fetch(PDO::FETCH_OBJ)->content;
    }
    /**
     * Récupére les informations propre à un Article
     *
     * @return object
     */
    public function getPostInfo(){
        $getPostInfo = $this->db->prepare(
            'SELECT `pos`.`id` AS `postId`, `title`, `pos`.`image` AS `postImg`, `content`, `lastEditDate`, `username`, `name`, `universe`
            FROM ' . $this->table . ' AS `pos`
                INNER JOIN `42pmz96_poststypes` AS `pot` ON `pos`.`id_42pmz96_postsTypes` = `pot`.`id`
                INNER JOIN `42pmz96_users` AS `use` ON `pos`.`id_42pmz96_users` = `use`.`id`
                INNER JOIN `42pmz96_universes` AS `uni` ON `pos`.`id_42pmz96_universes` = `uni`.`id`
            WHERE `pos`.`id` = :id'
        );
        $getPostInfo->bindValue(':id', $this->id, PDO::PARAM_INT);
        $getPostInfo->execute();
        return $getPostInfo->fetch(PDO::FETCH_OBJ);
    }
    /**
     * Fonction récupérant une liste de producteur
     *
     * @param [array] $searchArray tableau assoc propre à la recherche
     * @param array $pageArray tableau assoc propre à la pagination
     * @return array
     */
    public function getPostsList($searchArray, $pageArray = array()){
        $where = '';
        if(!empty($searchArray)){
            $where = ' WHERE ';
            $whereArray = array();
            foreach($searchArray as $fieldName => $value){
                if($fieldName == 'title' || $fieldName == 'username'){
                    $whereArray[$fieldName] = ' `' . $fieldName . '` LIKE :' . $fieldName;
                }
                if($fieldName == 'lastEditDate'){
                    $whereArray[$fieldName] =  '`lastEditDate` < :lastEditDate ';
                }
                if($fieldName == 'id_42pmz96_postsTypes' || $fieldName == 'id_42pmz96_universes'){
                    $whereArray[$fieldName] = ' `' . $fieldName . '` = :' . $fieldName;
                }
            }
            $where .= implode(' AND ', $whereArray);
        }
        $getPostsList = $this->db->prepare(
            'SELECT `post`.`id` AS `postId`, `title`, `lastEditDate`, `typ`.`name`AS `categorie`, `universe`, `username`
            FROM ' . $this->table . ' AS `post`
                INNER JOIN `42pmz96_postsTypes` AS `typ` ON `id_42pmz96_postsTypes` = `typ`.`id`
                INNER JOIN `42pmz96_universes` AS `uni` ON `id_42pmz96_universes` = `uni`.`id`
                INNER JOIN `42pmz96_users` AS `use` ON `id_42pmz96_users` = `use`.`id`'
            . $where . ' '
            . (count($pageArray) == 2 ? 'LIMIT :limit OFFSET :offset' : '')
        );
        foreach($searchArray as $fieldName => $value){
            if($fieldName == 'id_42pmz96_postsTypes' || $fieldName == 'id_42pmz96_universes'){
                $getPostsList->bindValue(':' . $fieldName, $value, PDO::PARAM_INT);
            }else {
                $getPostsList->bindValue(':' . $fieldName, $value, PDO::PARAM_STR);
            }
        }
        if (count($pageArray) == 2){
            $getPostsList->bindvalue(':limit', $pageArray['limit'], PDO::PARAM_INT);
            $getPostsList->bindvalue(':offset', $pageArray['offset'], PDO::PARAM_INT);
        }
        $getPostsList->execute();
        return $getPostsList->fetchAll(PDO::FETCH_OBJ);
    }
    /**
     * Ajoute un article
     *
     * @return bool
     */
    public function addPost(){
        $addPost = $this->db->prepare(
            'INSERT INTO ' . $this->table . ' (`title`, `image`, `content`, `postDate`, `lastEditDate`, `id_42pmz96_users`, `id_42pmz96_postsTypes`, `id_42pmz96_universes`)
            VALUES (:title, :image, :content, :postDate, :lastEditDate, :id_42pmz96_users, :id_42pmz96_postsTypes , :id_42pmz96_universes)'
        );
        $addPost->bindValue(':title', $this->title, PDO::PARAM_STR);
        $addPost->bindValue(':image', $this->image, PDO::PARAM_STR);
        $addPost->bindValue(':content', $this->content, PDO::PARAM_STR);
        $addPost->bindValue(':postDate', $this->postDate, PDO::PARAM_STR);
        $addPost->bindValue(':lastEditDate', $this->lastEditDate, PDO::PARAM_STR);
        $addPost->bindValue(':id_42pmz96_users', $this->id_42pmz96_users, PDO::PARAM_INT);
        $addPost->bindValue(':id_42pmz96_postsTypes', $this->id_42pmz96_postsTypes, PDO::PARAM_INT);
        $addPost->bindValue(':id_42pmz96_universes', $this->id_42pmz96_universes, PDO::PARAM_INT);
        return $addPost->execute();
    }
    /**
     * Modifie les informations de l'Article
     *
     * @return bool
     */
    public function updatePost(){
        $updatePost = $this->db->prepare(
            'UPDATE ' . $this->table .
            ' SET `title` = :title, `image` = :image, `content` = :content, `lastEditDate` = :lastEditDate, `id_42pmz96_universes` = :id_42pmz96_universes, `id_42pmz96_postsTypes` = :id_42pmz96_postsTypes, `id_42pmz96_users` = :id_42pmz96_users
            WHERE `id` = :id'
        );
        $updatePost->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updatePost->bindValue(':title', $this->title, PDO::PARAM_STR);
        $updatePost->bindValue(':image', $this->image, PDO::PARAM_STR);
        $updatePost->bindValue(':content', $this->content, PDO::PARAM_STR);
        $updatePost->bindValue(':lastEditDate', $this->lastEditDate, PDO::PARAM_STR);
        $updatePost->bindValue(':id_42pmz96_universes', $this->id_42pmz96_universes, PDO::PARAM_INT);
        $updatePost->bindValue(':id_42pmz96_postsTypes', $this->id_42pmz96_postsTypes, PDO::PARAM_INT);
        $updatePost->bindValue(':id_42pmz96_users', $this->id_42pmz96_users, PDO::PARAM_INT);
        return $updatePost->execute();
    }
    /**
     * Supprime un article
     *
     * @return bool
     */
    public function deletePost(){
        $deletePost = $this->db->prepare(
            'DELETE FROM ' . $this->table .
            ' WHERE `id` = :id'
        );
        $deletePost->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deletePost->execute();
    }
}