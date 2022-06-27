<?php
class User{
  public $id;
  public $name;
  public $e_mail;
  public $password;

  public function __construct( $id,  $name, $password, $email){
    $this->id = $id;
    $this->name = $name;
    $this->e_mail = $email;
    $this->password = $password;
  }

};
class UserRepository{
  protected $db;

  public function __construct($db){
    $this->db=$db;
  }
   public function findUserByName($userName){
    $query=$this->db->prepare('SELECT * FROM users WHERE name=:name');
    $query->bindValue(':name', $userName, PDO::PARAM_STR);
    try{
      $query->execute();
      $user=$query->fetch();
      if($user)
        return $user;
      return null;
    }catch(PDOException $e){
    echo $e->getMessage();
    }
  }
  
  public function addUser($user,$db){
    $userRepo=new UserRepository($db);
    if(($userRepo->findUserByName($user->name))!=null)
      return -1;

    $sql = "INSERT INTO users (name,e_mail,password) VALUES (?,?,?)";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([$user->name,$user->e_mail,$user->password]);
    return 1;
  }
   
  public function findUserById($userId){
    $query=$this->db->prepare('SELECT * FROM users WHERE id=:id');
    $query->bindValue(':id', $userId, PDO::PARAM_INT);
    try{
      $query->execute();
      $user=$query->fetch();
      return $user;
    }catch(PDOException $e){
    echo $e->getMessage();
    }
  }
  
  public function getUserPreferences($userId){
    $query=$this->db->prepare('SELECT * FROM userPreferences WHERE id_user=:id');
    $query->bindValue(':id', $userId, PDO::PARAM_INT);
    try{
      $query->execute();
      $preferences=$query->fetchAll();
      return $preferences;
  
    }catch(PDOException $e){
    echo $e->getMessage();
    }
  }

  public function getUserFromToken($token) {
      if($token!="none"){
         $statement = $this->db->prepare("SELECT users.id, users.name, users.e_mail, users.password FROM users INNER JOIN sessions on users.id=sessions.user_id WHERE sessions.token = :token LIMIT 1");
    $statement->bindParam(':token', $token, PDO::PARAM_STR);
    $statement->execute();
    $row = $statement->fetch();
    if ($row) {
      return new User(
        $row['id'],
        $row['name'],
        $row['password'],
        $row['e_mail'],
      );
    } else {
      throw new  ErrorException("User not found for $token");
    }
    }
      return null;
   }
  
  public function checkUserExistence($username, $password){
    $query=$this->db->prepare('SELECT * FROM users WHERE name=:name');
    $query->bindValue(':name', $username, PDO::PARAM_STR);
    try{
      $query->execute();
      $row=$query->fetch();
    }catch(PDOException $e){
    echo $e->getMessage();
    }
    if($row==null){
      return -1;
    }
    else{
        $user = new User(
        $row['id'],
        $row['name'],
        $row['password'],
        $row['e_mail'],
      );
      if(password_verify($password, $user->password)!=1){
        return -1;
      }
    }
      return $user;
  }

  public function changeUsername($user, $db, $newUsername){
    $userRepo=new UserRepository($db);
    if(($userRepo->findUserByName($newUsername))!=null)
      return -1;

    $sql = "UPDATE users SET name = ? WHERE id=?";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([$newUsername, $user->id]);
    return 1;
    
  }

  public function changeEmail($user, $newEmail, $confirmedEmail){
    if($newEmail!=$confirmedEmail)
      return -1;

    $sql = "UPDATE users SET e_mail = ? WHERE id=?";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([$newEmail, $user->id]);
    return 1;
  }
  
  public function changePassword($user, $oldPassword, $newPassword, $confirmedPassword){
    if(password_verify($oldPassword, $user->password)!=1)
      return -1;
    
    if($newPassword!=$confirmedPassword)
      return -2;

    $sql = "UPDATE users SET password = ? WHERE id=?";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([password_hash($newPassword, PASSWORD_BCRYPT), $user->id]);
    return 1;
  }

  public function addUserPref($userId, $nutriqual, $lowsalt, $lowsugars, $lowfats, $gluten, $lactose, $nuts, $soybeans, $so2){
    $sql = "INSERT INTO userPreferences (id_user,good_nutrition_quality,low_salt,low_sugars,low_fats,gluten,lactose,nuts,soybeans,so2) VALUES (?,?,?,?,?,?,?,?,?,?)";
    
    $stmt = $this->db->prepare($sql);

    $stmt->execute([$userId, $nutriqual, $lowsalt, $lowsugars, $lowfats, $gluten, $lactose, $nuts, $soybeans, $so2]);
    return 1;
    
  }

   public function changeUserPref($userId, $nutriqual, $lowsalt, $lowsugars, $lowfats, $gluten, $lactose, $nuts, $soybeans, $so2){
    
    $sql = "UPDATE userPreferences SET good_nutrition_quality=?, low_salt=?, low_sugars=?, low_fats=?, gluten=?, lactose=?, nuts=?, soybeans=?, so2=? WHERE id_user=?";
    
    $stmt = $this->db->prepare($sql);

    $stmt->execute([$nutriqual, $lowsalt, $lowsugars, $lowfats, $gluten, $lactose, $nuts, $soybeans, $so2, $userId]);
    return 1;
    
  }
  
}

?>