<?php
session_start(); 
require_once __DIR__. "/DataBase.php";
require_once __DIR__. "/UserRepository.php";
require_once __DIR__. "/SessionRepository.php";
$db=getDbConn();
$userRepo = new UserRepository($db);
$sessionRepo = new SessionRepository($db);


$nutriqual=$_REQUEST['nutriqual'];
$lowsalt=$_REQUEST['lowsalt'];
$lowsugars=$_REQUEST['lowsugars'];
$lowfats=$_REQUEST['lowfats'];
$gluten=$_REQUEST['gluten'];
$lactose=$_REQUEST['lactose'];
$nuts=$_REQUEST['nuts'];
$soybeans=$_REQUEST['soybeans'];
$so2=$_REQUEST['so2'];

if(isset($nutriqual)&&isset($lowsalt)&&isset($lowsalt)&&isset($lowsugars)&&isset($lowfats)&&isset($gluten)&&isset($lactose)&&isset($nuts)&&isset($soybeans)&&isset($so2)){
  $user = $userRepo->getUserFromToken($_SESSION['token']);
        if(isset( $user)){
          echo $nutriqual;
          $userRepo->changeUserPref($user->id, $nutriqual, $lowsalt, $lowsugars, $lowfats, $gluten, $lactose, $nuts, $soybeans, $so2);
        }
 }
?>