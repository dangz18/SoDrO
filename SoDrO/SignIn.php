<html>
    <head> 
    <?php include 'Banner.php';?>
    </head>
    <body>
    <div class='signInContainer'>
      <h1>Sign In</h1>
      <form action="SoDrO/HomePage.php" method="POST">
        <label for="userName"></label><br>
        <input type="text" class="formularBar" id="username" name="username" placeholder="Username" min="4" maxlength="20" required><br>
        <br>
        <input type="password" class="formularBar" id="password" name="password" placeholder="Password" min="4" maxlength="20" required><br>
          <input type="submit" class="Submit" value="Sign In">
      </form><br><br><br>
      <h2>Not registred yet?</h2>
      <a href="#">Sign Up!</a>
    </div>  
    </body>
</html>