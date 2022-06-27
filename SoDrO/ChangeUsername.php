<?php
  session_start(); 
  require_once __DIR__. "/DataBase.php";
  require_once __DIR__. "/UserRepository.php";
  require_once __DIR__. "/SessionRepository.php";
  $db=getDbConn();
  $userRepo = new UserRepository($db);
  $sessionRepo = new SessionRepository($db);
  if($_SESSION['token']!="none")
    $user = $userRepo->getUserFromToken($_SESSION['token']);
  else{
      header("Location: SignIn.php");
      exit;
  }
  if($_SERVER['REQUEST_METHOD']==='POST'){
    $user = $userRepo->getUserFromToken($_SESSION['token']);
    if($userRepo->changeUsername($user,$db,$_POST['newUsername'])==-1){
      $_SESSION["errorMsg"]="Username already used";
    }
    else{
      $_SESSION["errorMsg"]=null;
      header("Location: MyProfile.php");
      exit;
    }
  }
?>
<!DOCTYPE html>
<html>
<head> 
  <link href="ChangeUsername.css" rel="stylesheet" type="text/css">
  <link href="Style.css" rel="stylesheet" type="text/css">
  <link href="BannerStyle.css" rel="stylesheet" type="text/css">
</head>
<body>
  <?php
include_once('Banner.php');

$title = 'Edit';
$page = 'edit';
?>
  <div class="Userbackground">
    <div class="Usercontainer1">
      <div class="Usertitlu">
        Change Username
      </div>
      <form action="ChangeUsername.php" method="POST">
        <label for="newUsername"></label><br>
        <input type="text" class="formularBar" id="newUser" name="newUsername" placeholder="New Username" minlength="3" maxlength="20" required>
        <div class="error" style="margin-top:5%;"><?php echo $_SESSION["errorMsg"];?></div> 
        <input type="submit" class="Usersubmitbtn" value="Confirm Changes">
      </form>
    </div>
  </div>
</body>
</html>