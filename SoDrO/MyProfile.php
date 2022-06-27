<?php
session_start(); 
require_once __DIR__. "/DataBase.php";
require_once __DIR__. "/UserRepository.php";
require_once __DIR__. "/SessionRepository.php";
$userRepo = new UserRepository($db);
$sessionRepo = new SessionRepository($db);

$db=getDbConn();
$userRepo = new UserRepository($db);
  if($_SESSION['token']!="none"){
    $user = $userRepo->getUserFromToken($_SESSION['token']);
  }
  else{
      header("Location: SignIn.php");
      exit;
  }
?>
<!DOCTYPE html>
<html>
  <head> 
    <link href="MyProfile.css" rel="stylesheet" type="text/css">
    <link href="Style.css" rel="stylesheet" type="text/css">
    <link href="BannerStyle.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <?php include_once('Banner.php');?>
    <div class="ProfBackground">
      <div class="ProfContainer1">
        <div class="ProfTitlu">
          My Profile
        </div>
        <div class="ProfImagine">
          <img src="Buttons/user.png">
        </div>
        <div class="ContainerUsername">
          <div class="username"><?php echo $user->name;?></div>
        </div>
        <a href="ChangeUsername.php">Change Username!</a>
        <br><br>
        <div class="ContainerEmail">
          <div class="email"><?php echo $user->e_mail;?></div>
        </div>
        <br>
        <a href="ChangeEmail.php">Change E-mail!</a>
        <div class="ProfContainer2">
          <button onclick="location.href='HomePage.php'" type="button" class="LogOutButton" >Log Out</button>
          <br>
          <a href="ChangePassword.php">Change Password!</a>
          <br>
          <a href="EditDrinkPreferences.php">Edit Preferences!</a>
        </div>
      </div>
    </div>
  </body>
</html>