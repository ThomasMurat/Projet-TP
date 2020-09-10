<?php
class transaction {
    private $db = NULL;
    public function __construct(){
        $this->db = dataBase::getInstance();
    }
    public function beginTransaction(){
        return $this->db->beginTransaction();
    }
    public function rollBack(){
        return $this->db->rollBack();
    }
    public function getLastInsertId(){
        return $this->db->lastInsertId();
    }
    public function commit(){
        return $this->db->commit();
    }
}