<html>
  <head>
    <?php include 'Banner.php';?>
  </head>
  <body>
    <div class="background"> 
      <div class="container">
        <div class="titlu">
          Sign Up
        </div>
        <div class="SignUpContainer">
        <form action="SoDrO/HomePage.php" method="POST">
        <label for="userName"></label><br>
        <input type="text" class="formularBar" id="username" name="username" placeholder="Username" required><br><br>
        <input type="text" class="formularBar" id="mail" name="mail" placeholder="E-mail" required><br>
        <br>
        <input type="password" class="formularBar" id="password" name="password"  placeholder="Password" required><br><br>
        <input type="password" class="formularBar" id="password" name="password" placeholder="Confirm Password" required><br>
      </form><br><br><br>
      </div>
        <div class="prefs">
          Drink Preferences
        </div>
        <div class="container2">
          <div class="calitate">
          </div>
          <div class="nutriscoreimg">
          <img src='SoDrO/Images/nutriscore.png'>
          </div>
          <div class="SignUpContainer">
            <form>
              Good nutritional quality
              <br>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Not Important
              </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Important
              </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Very Important
              </label>
            </form>
          </div>
            <div class="saltimg">
            <img src="SoDrO/Images/salt.png">
            </div>
          <div class="SignUpContainer">
              <form>
              Low salt
              <br>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Not Important
              </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Important
              </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Very Important
              </label>
              </div>
            </form>
            <div class="sugarimg">
              <img src="SoDrO/Images/sugar.png">
            </div>
            <div class="SignUpContainer">
            <form>
              Low sugars
              <br>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Not Important
              </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Important
              </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Very Important
              </label>
            </form>
            </div>
              <div class="fatImg">
                <img src="SoDrO/Images/fat.png">
              </div>
            <div class="SignUpContainer">
                <form>
              Low fats
              <br>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Not Important
              </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Important
              </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Very Important
              </label>
            </form>
            </div>
        </div>
        <div class="container3">
          <div class="alergeni">
            Allergens
          </div>
          <div class="glutenimg">
          <img src='SoDrO/Images/gluten.png'>
          </div>
          <div class="SignUpContainer">
            <form>
              Gluten
              <br>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Yes
              </label>                             
              <label class="checkbox-inline">
              <input type="checkbox" value="">No
              </label>
            </form>
          </div>
          <div class="lactoseimg">
          <img src='SoDrO/Images/milks.png' width="100" height="100">
          </div>
          <div class="SignUpContainer">
            <form>
              Lactose
              <br>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Yes
              </label>                             
              <label class="checkbox-inline">
              <input type="checkbox" value="">No
              </label>
            </form></div>
          <div class="almondimg">
          <img src='SoDrO/Images/almond.png' width="100" height="100">
          </div>
            <div class="SignUpContainer">
            <form>
              Nuts
              <br>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Yes
              </label>                             
              <label class="checkbox-inline">
              <input type="checkbox" value="">No
              </label>
            </form></div>
           <div class="soybeansimg">
          <img src='SoDrO/Images/soybean.png' width="100" height="100">
          </div>
          <div class="SignUpContainer">
            <form>
              Soybeans
              <br>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Yes
              </label>                             
              <label class="checkbox-inline">
              <input type="checkbox" value="">No
              </label>
            </form></div>
           <div class="SO2img">
          <img src='SoDrO/Images/SO2.png' width="100" height="100">
          </div>
          <div class="SignUpContainer">
            <form>
              Sulphur dioxide and sulphites
              <br>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Yes
              </label>                             
              <label class="checkbox-inline">
              <input type="checkbox" value="">No
              </label>
            </form></div>
        </div>
        <div class="container4">
          <div class="ingrediente">
            Ingredients
          </div>
          <div class="organicimg">
          <img src='SoDrO/Images/organic.png' weight="100" height="100">
          </div>
          <div class="SignUpContainer">
            <form>
              Organic
              <br>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Yes
              </label>                             
              <label class="checkbox-inline">
              <input type="checkbox" value="">No
              </label>
            </form></div>
          <div class="veganimg">
          <img src='SoDrO/Images/vegan.png' weight="100" height="100">
          </div>
          <div class="SignUpContainer">
            <form>
              Vegan
              <br>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Yes
              </label>                             
              <label class="checkbox-inline">
              <input type="checkbox" value="">No
              </label>
            </form></div>
           <div class="vegetarianimg">
          <img src='SoDrO/Images/vegetarian.png' weight="100" height="100">
          </div>
        <div class="SignUpContainer">
            <form>
              Vegetarian
              <br>
              <label class="checkbox-inline">
              <input type="checkbox" value="">Yes
              </label>                             
              <label class="checkbox-inline">
              <input type="checkbox" value="">No
              </label><br><br><br>
              <input type="submit" class="submitbtn" value="Sign Up">
            </form></div>
          <div class="alreadyreg">
          <h2>Already Registered?</h2>
            <a href="#">Sign In!</a>
          </div>
      </div>
    </div>
  </body>
</html>