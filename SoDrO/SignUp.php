<?php
  session_start(); 
  require_once __DIR__. "/DataBase.php";
  require_once __DIR__. "/UserRepository.php";
  require_once __DIR__. "/SessionRepository.php";
  $db=getDbConn();
  $userRepo = new UserRepository($db);
  $sessionRepo = new SessionRepository($db);

  if($_SERVER['REQUEST_METHOD']==='POST'){
    if( $_SESSION["checkSI"]==='ok'){
       $_SESSION["checkSI"]=null;
       header("Location: SignIn.php");
       exit; 
    }
  }
  ?>
 <script type="text/javascript">
    
      function getPref(){
     const username=document.querySelector('#username').value;
    var password=document.querySelector('#password').value;
        var con_password=document.querySelector('#confirm_password').value;
    const email=document.querySelector('#email').value;

        const nutriqualIMP=document.querySelector('#nutriqualIMP');
        var nutriqual=nutriqualIMP.checked;
        
        const lowsaltIMP = document.querySelector('#lowsaltIMP');
        var lowsalt=lowsaltIMP.checked;
        
        const lowsugarsIMP=document.querySelector('#lowsugarsIMP');
        var lowsugars=lowsugarsIMP.checked;
        
        const lowfatsIMP = document.querySelector('#lowfatsIMP');
        var lowfats=lowfatsIMP.checked;
        
        const glutenIMP = document.querySelector('#glutenIMP');
        var gluten=glutenIMP.checked;
        
        const lactoseIMP = document.querySelector('#lactoseIMP');
        var lactose=lactoseIMP.checked;    
        const nutsIMP = document.querySelector('#nutsIMP');
        var nuts=nutsIMP.checked;
        
        const soybeansIMP = document.querySelector('#soybeansIMP');
        var soybeans=soybeansIMP.checked;
        
        const so2IMP = document.querySelector('#so2IMP');
        var so2=so2IMP.checked;
        
        var xml=new XMLHttpRequest();
        xml.onreadystatechange=function(){
          if(this.readyState==4 && this.status==200){
            console.log(this.responseText);
          }
        }
        xml.open("GET", "SelectedPreferences.php?name="+username+"&pass="+password+"&cpass="+con_password+"&mail="+email+"&nutriqual="+nutriqual+"&lowsalt="+lowsalt+"&lowsugars="+lowsugars+"&lowfats="+lowfats+"&gluten="+gluten+"&lactose="+lactose+"&nuts="+nuts+"&soybeans="+soybeans+"&so2="+so2, true);
xml.send();
         
      };
    </script> 
<!DOCTYPE html>
<html>
  <head>
    <link href="SIgnUpStyle.css" rel="stylesheet" type="text/css">
    <link href="BannerStyle.css" rel="stylesheet" type="text/css">
    <link href="Style.css" rel="stylesheet" type="text/css">
    </head>
  <body> 
    <?php
include_once('Banner.php');?>

    <div class="RegBackground"> 
      <div class="RegContainer">
        <div class="RegTitlu">
          Sign Up
        </div>
        <div class="error" style="margin-top:5%;"><?php echo $_SESSION["errorMsg"];?></div> 
        <div class="RegSignUpContainer">
          <form action="SignUp.php" method="post">
          <label for="userName"></label><br>
          <input type="text" class="formularBar" id="username" name="userName" placeholder="Username" minlength="3" maxlength="20" required><br><br>
          <input type="text" class="formularBar" id="email" name="email" placeholder="E-mail" required><br>
          <br>
          <input type="password" class="formularBar" id="password" name="password"  placeholder="Password" minlength="4" maxlength="20" required><br><br>
            <label for="confirm_password"></label><br>
          <input type="password" class="formularBar" id="confirm_password" name="confirm_password" placeholder="Confirm Password" minlength="4" maxlength="20" required><br>
  
        </div>
        <div class="RegContainer2">
          <div class="RegDrinkPreferences">
              Drink Preferences
            </div>
          <div class="RegCalitate">
          </div>
          <div class="row">
            <div class="RegNutriscoreimg">
              <img src='Images/nutriscore.png' height="80"     width="120">
            </div>
            <div class="RegNutriscoreContainer">
              Good nutritional quality
              <br>
              <label for="nutriqualNIMP">
                <input type="radio" id="nutriqualNIMP" name="nutriqual">Not Important
              </label>
              <label for="nutriqualIMP">
                <input type="radio" id="nutriqualIMP" name="nutriqual">Important
              </label>
            </div>
          </div>
          <div class="row">
            <div class="RegSaltimg">
              <img src="Images/salt.png"  height="80"     width="80">
            </div>
            <div class="RegSaltContainer">
              Low salt
              <br>
              <label for="lowsaltNIMP">
              <input type="radio" id="lowsaltNIMP" name="lowsalt">Not Important
              </label>
              <label for="lowsaltIMP">
              <input type="radio" id="lowsaltIMP" name="lowsalt">Important
              </label>
            </div>
          </div> 
          <div class="row">
            <div class="RegSugarimg">
              <img src="Images/sugar.png"  height="80"     width="80">
            </div>
            <div class="RegSugarContainer">
              Low sugars
              <br>
              <label for="lowsugarsNIMP">
              <input type="radio" id="lowsugarsNIMP" name="lowsugar">Not Important
              </label>
              <label for="lowsugarsIMP">
              <input type="radio" id="lowsugarsIMP" name="lowsugar">Important
              </label>
            </div>
          </div>
          <div class="row">
              <div class="RegFatImg">
                <img src="Images/fat.png" height="80"     width="80">
              </div>
              <div class="RegFatContainer">
                Low fats
                <br>
                <label for="lowfatsNIMP">
                <input type="radio" id="lowfatsNIMP" name="lowfats">Not Important
                </label>
                <label for="lowfatsIMP">
                <input type="radio" id="lowfatsIMP" name="lowfats">Important
                </label>
              </div>
          </div>

          <div class="RegContainer3">
            <div class="RegAlergeni">
              Allergens
            </div>
            <div class="row">
              <div class="RegGlutenimg">
                <img src='Images/gluten.png' height="80"     width="80">
              </div>
              <div class="RegGlutenContainer">
                Gluten
                <br>
                <label for="glutenIMP">
                <input type="radio" id="glutenIMP" name="gluten">Yes
                </label>                             
                <label for="glutenNIMP">
                <input type="radio" id="glutenNIMP" name="gluten">No
                </label>  
              </div>
            </div>
            <div class="row">
              <div class="RegLactoseimg">
                <img src='Images/milks.png' width="80" height="80">
              </div>
              <div class="RegLactoseContainer">
                Lactose
                <br>
                <label for="lactoseIMP">
                <input type="radio" id="lactoseIMP" name="lactose">Yes
                </label>                             
                <label for="lactoseNIMP">
                <input type="radio" id="lactoseNIMP" name="lactose">No
                </label>
              </div>
            </div>
            <div class="row">
              <div class="RegAlmondimg">
                <img src='Images/almond.png' width="80" height="80">
              </div>
              <div class="RegAlmondContainer">
                Nuts
                <br>
                <label for="nutsIMP">
                <input type="radio" id="nutsIMP" name="nuts">Yes
                </label>                             
                <label for="nutsNIMP">
                <input type="radio" id="nutsNIMP" name="nuts">No
                </label>
              </div>
            </div>
            <div class="row">
               <div class="RegSoybeansimg">
                <img src='Images/soybean.png' width="80" height="80">
              </div>
              <div class="RegSoybeansContainer">
                Soybeans
                <br>
                <label for="soybeansIMP">
                <input type="radio" id="soybeansIMP" name="soybeans">Yes
                </label>                             
                <label for="soybeansNIMP">
                <input type="radio" id="soybeansNIMP" name="soybeans">No
                </label>
              </div>
            </div>
          <div class="row">
            <div class="RegSO2img">
              <img src='Images/SO2.png' width="80" height="80">
            </div>
            <div class="RegSO2Container">
              Sulphur dioxide and sulphites
              <br>
              <label for="so2IMP">
              <input type="radio" id="so2IMP" name="Sulphur">Yes
              </label>                             
              <label for="so2NIMP">
              <input type="radio" id="so2NIMP" name="Sulphur">No
              </label>
            </div>
          </div>
        </div>
          <div class="RegContainer5">
            <input type="submit" onclick="getPref()" class="RegSubmitbtn" value="Sign Up">
            <div class="RegAlreadyreg">
              <h2>Already Registered?</h2>
              <a href="SignIn.php">Sign In!</a>
            </div>
          </div>
          </form><br><br><br>
      </div>
    </div>
  </body>
</html>
            