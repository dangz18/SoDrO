<?php 
session_start();
?>
<?php
require_once __DIR__. "/DataBase.php";
require_once __DIR__. "/UserRepository.php";
require_once __DIR__. "/ProductRepository.php";

$db=getDbConn();
initDb($db);
try{
insertProducts($db);
}catch(PDOException $e){
  echo $e->getMessage();
}
$userRepo = new UserRepository($db);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <title>SoDrO - Home</title>
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
    </head>
    <body>
      <?php $_SESSION["token"]="none"; $_SESSION["errorMsg"]=null; ?>
       <?php include 'HomePage.php';?>
    </body>
</html>