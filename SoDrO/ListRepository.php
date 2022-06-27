<?php

class ListRepository{
  protected $db;

  public function __construct($db){
    $this->db=$db;
  }
  public function addList($idUser, $name){
    $sql = "INSERT INTO lists (id_user,name) VALUES (?,?)";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([$idUser,$name]);
  }
  
  public function getUserListsByUserId($userId){
    $statement=$this->db->prepare("SELECT * FROM lists WHERE id_user=:id_user");
    $statement->bindParam(':id_user', $userId, PDO::PARAM_INT);
    $statement->execute();
    $rows = $statement->fetchAll();
    if ($rows) {
      return $rows;
    } else {
      return -1;
    }
  }
  public function getListById($listId){
    $statement=$this->db->prepare("SELECT * FROM lists WHERE id=:id");
    $statement->bindParam(':id', $listId, PDO::PARAM_INT);
    $statement->execute();
    $rows = $statement->fetch();
    if ($rows) {
      return $rows;
    } else {
      return -1;
    }
  }
  public function  getListItemsByListId($listId){
  $statement=$this->db->prepare("SELECT * FROM list_items WHERE id_list=:id_list");
    $statement->bindParam(':id_list', $listId, PDO::PARAM_INT);
    $statement->execute();
    $rows = $statement->fetchAll();
    if ($rows) {
      return $rows;
    } else {
      return -1;
    }
  }

}

?>