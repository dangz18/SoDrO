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
    if($userRepo->changeEmail($user,$_POST['newEmail'],$_POST['confirmedEmail'] )==-1){
      $_SESSION["errorMsg"]="E-mails doesn't match";
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
  <link href="ChangeEmail.css" rel="stylesheet" type="text/css">
  <link href="Style.css" rel="stylesheet" type="text/css">
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
  <div class="Emailbackground">
    <div class="Emailcontainer1">
      <div class="Emailtitlu">
        Change E-Mail
      </div>
      <form action="ChangeEmail.php" method="POST">
        <label for="newUsername"></label><br>
        <input type="text" class="formularBar" id="newMail" name="newEmail" placeholder="New E-Mail" required>
        <br>
        <input type="text" class="formularBar" id="confirmMail" name="confirmedEmail" placeholder="Confirm E-Mail" required>
        <div class="error" style="margin-top:5%;"><?php echo $_SESSION["errorMsg"];?></div> 
        <input type="submit" class="Emailsubmitbtn" value="Confirm Changes">
      </form>
    </div>
  </div>
</body>
</html>