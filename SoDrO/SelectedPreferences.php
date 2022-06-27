<?php
session_start(); 
require_once __DIR__. "/DataBase.php";
require_once __DIR__. "/UserRepository.php";
$db=getDbConn();
$userRepo = new UserRepository($db);
$name=$_REQUEST['name'];
$pass=$_REQUEST['pass'];
$cpass=$_REQUEST['cpass'];

$mail=$_REQUEST['mail'];

$nutriqual=$_REQUEST['nutriqual'];
$lowsalt=$_REQUEST['lowsalt'];
$lowsugars=$_REQUEST['lowsugars'];
$lowfats=$_REQUEST['lowfats'];
$gluten=$_REQUEST['gluten'];
$lactose=$_REQUEST['lactose'];
$nuts=$_REQUEST['nuts'];
$soybeans=$_REQUEST['soybeans'];
$so2=$_REQUEST['so2'];

if(isset($name)&&isset($pass)&&isset($cpass)&&isset($mail)&&isset($nutriqual)&&isset($lowsalt)&&isset($lowsalt)&&isset($lowsugars)&&isset($lowfats)&&isset($gluten)&&isset($lactose)&&isset($nuts)&&isset($soybeans)&&isset($so2)){  
    if($pass===$cpass){
       $tryuser=new User(0,$name,password_hash($pass, PASSWORD_BCRYPT),$mail);
      if($userRepo->addUser($tryuser,$db)==-1){
        $_SESSION["errorMsg"]="Username already used";
      }
      else{
        $user = $userRepo->findUserByName($name);
        if(isset( $user)){
          $_SESSION["errorMsg"]=null;
          $user=$userRepo->addUserPref($user['id'], $nutriqual, $lowsalt, $lowsugars, $lowfats, $gluten, $lactose, $nuts, $soybeans, $so2);
          $_SESSION['checkSI']='ok';
        }
      
      }
    } 
  
  else{
    $_SESSION["errorMsg"]="Confirm Password does not match password.";
  }
}
?>