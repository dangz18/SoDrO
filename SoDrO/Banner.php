<?php 
session_start();
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title> SoDrO </title>
  <link href="BannerStyle.css" rel="stylesheet" type="text/css">
  <link href="Style.css" rel="stylesheet" type="text/css">
</head>  
  <body>
    <div class='banner'>
      <div class="logo"></div>
      <div class="navigation">
        <ul>
      <li>
         <button onclick="location.href='HomePage.php'" type="button"><h4>Home</h4></button>
      </li>
        <li>
          <button onclick="location.href='ProductsPage.php'" type="button"><h4>Products</h4></button>
      </li>
        <li>
          <button onclick="location.href='Graphs.php'" type="button"><h4>Graph</h4></button>
      </li>
         <?php if($_SESSION["token"]==="none"):?>
         <li>
         <button type="button" onclick="location.href='SignIn.php'">
          <h4>Sign In</h4></button></li>
        <?php else:?>
          <li>
          <button onclick="location.href='List.php'" type="button"><img src="Buttons/list.png" alt="Lists" class="listBt"></button>
        </li>
          <li>
        <button type="button" onclick="location.href='MyProfile.php'">
        <img src="Buttons/user.png" alt="MyProfile"  class="userBt"></h4></button></li>
        
      <?php endif ?>
      </ul>
      </div>
    </div>
  </body>
</html>