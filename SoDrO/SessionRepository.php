<?php
class SessionRepository {
  protected $db;
  
  public function __construct($db) {
    $this->db = $db;
  }

  public function generateSession($user) {
    $token = session_create_id();
    
    $statement = $this->db->prepare("INSERT INTO sessions (token, user_id) VALUES(:token,  :user_id)");
    $statement->bindParam(':token', $token, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
    $statement->execute();
    return $token;
   }

}
?>
