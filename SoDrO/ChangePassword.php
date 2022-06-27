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
    if($userRepo->changePassword($user,$_POST['oldPassword'],$_POST['newPassword'],$_POST['confirmedPassword'] )==-1){
      $_SESSION["errorMsg"]="You have entered an incorrect password!";
    }
    else if($userRepo->changePassword($user,$_POST['oldPassword'],$_POST['newPassword'],$_POST['confirmedPassword'] )==-2){
      $_SESSION["errorMsg"]="New Password and Confirmed Password doesn't match!";
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
  <link href="Style.css" rel="stylesheet" type="text/css">
  <link href="ChangePassword.css" rel="stylesheet" type="text/css">
  <link href="BannerStyle.css" rel="stylesheet" type="text/css">
</head>
<body>
  <?php
include_once('Banner.php');
?>
<?php
$title = 'Edit';
$page = 'edit';
?>
  <div class="Passbackground">
    <div class="Passcontainer1">
      <div class="Passtitlu">
        Change Password
      </div>
      <form action="ChangePassword.php" method="POST">
        <label for="oldPassword"></label>
        <br>
        <input type="password" class="formularBar" id="oldPassword" name="oldPassword" placeholder="Old Password" minlength="4" maxlength="20" required>
        <br>
        <input type="password" class="formularBar" id="newPassword" name="newPassword" placeholder="New Password" minlength="4" maxlength="20" required>
        <br>
        <input type="password" class="formularBar" id="confirmPassword" name="confirmedPassword" placeholder="Confirm Password" minlength="4" maxlength="20" required>
        <div class="error" style="margin-top:5%;"><?php echo $_SESSION["errorMsg"];?></div> 
        <input type="submit" class="Passsubmitbtn" value="Confirm Changes">
      </form>
    </div>
  </div>
</body>
</html>