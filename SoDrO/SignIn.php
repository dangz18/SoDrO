<?php 
  session_start(); 
  require_once __DIR__. "/DataBase.php";
  require_once __DIR__. "/UserRepository.php";
  require_once __DIR__. "/SessionRepository.php";
  $db=getDbConn();
  $userRepo = new UserRepository($db);
  $sessionRepo = new SessionRepository($db);
  if($_SERVER['REQUEST_METHOD']==='POST'){
    $user=$userRepo->checkUserExistence($_POST['username'], $_POST['password']);
    if($user==-1){
      $_SESSION["errorMsgSI"]="Username or password incorrect!";
    }else{
      $token = $sessionRepo->generateSession($user);
      $_SESSION["errorMsgSI"]=null;
      $_SESSION["token"]=$token;
    }
  }
    if ($_SESSION['token']!="none") {
    header("Location: HomePage.php");
    exit;
  }  
?>

<!DOCTYPE html>

<html lang="en">
    <head> 
    <title> SoDrO - SignIn</title>

    <link href="BannerStyle.css" rel="stylesheet" type="text/css">
    <link href="SignInStyle.css" rel="stylesheet" type="text/css">
    <link href="Style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <?php include_once('Banner.php'); ?>
    <div class='signInContainer'>
      <h1>Sign In</h1>
      <form action="SignIn.php" method='post'>
        <label for="username"></label><br>
        <input type="text" class="formularBar" id="username" name="username" placeholder="Username" minlength="3" maxlength="20" required><br><br>
        <input type="password" class="formularBar" id="password" name="password" placeholder="Password" minlength="4" maxlength="20" required><br>
              <div class="error" style="margin-top:5%;"><?php echo $_SESSION["errorMsgSI"];?></div>
          <input type="submit" class="Submit" value="Sign In">
      </form><br><br><br>
      <h2>Not registred yet?</h2>
      <a href='SignUp.php'>Sign Up!</a>
    </div>
    </body>
</html>

