<?php
  session_start(); 
  require_once __DIR__. "/DataBase.php";
  require_once __DIR__. "/UserRepository.php";
  require_once __DIR__. "/SessionRepository.php";
  $db=getDbConn();
  $userRepo = new UserRepository($db);
  $sessionRepo = new SessionRepository($db);
if($_SERVER['REQUEST_METHOD']==='GET'){
  if($_SESSION['token']!="none")
    $user = $userRepo->getUserFromToken($_SESSION['token']);
  else{
      header("Location: SignIn.php");
      exit;
  }
  }
  
  if($_SERVER['REQUEST_METHOD']==='POST'){
    header("Location: MyProfile.php");
    exit;
  }
  
?>  
<!DOCTYPE html>
<html>
  <head>
    <link href="Style.css" rel="stylesheet" type="text/css">
    <link href="EditDrinkPreferences.css" rel="stylesheet" type="text/css">
    <link href="SIgnUpStyle.css" rel="stylesheet" type="text/css">
    <link href="BannerStyle.css" rel="stylesheet" type="text/css">
  </head>
  <body> 
    <?php include_once('Banner.php');?>
    <div class="EditBackground"> 
      <div class="RegContainer">
        <div class="RegTitlu">
          Edit Preferences
        </div>
          <div class="error" style="margin-top:5%;"><?php echo $_SESSION["errorMsg"];?></div> 
            <form action="MyProfile.php" method="post">
  
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
              <label for="nutriqualNIMPEdit">
                <input type="radio" id="nutriqualNIMPEdit" name="nutriqual">Not Important
              </label>
              <label for="nutriqualIMPEdit">
                <input type="radio" id="nutriqualIMPEdit" name="nutriqual">Important
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
              <label for="lowsaltNIMPEdit">
              <input type="radio" id="lowsaltNIMPEdit" name="lowsalt">Not Important
              </label>
              <label for="lowsaltIMPEdit">
              <input type="radio" id="lowsaltIMPEdit" name="lowsalt">Important
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
              <label for="lowsugarsNIMPEdit">
              <input type="radio" id="lowsugarsNIMPEdit" name="lowsugar">Not Important
              </label>
              <label for="lowsugarsIMPEdit">
              <input type="radio" id="lowsugarsIMPEdit" name="lowsugar">Important
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
                <label for="lowfatsNIMPEdit">
                <input type="radio" id="lowfatsNIMPEdit" name="lowfats">Not Important
                </label>
                <label for="lowfatsIMPEdit">
                <input type="radio" id="lowfatsIMPEdit" name="lowfats">Important
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
                <label for="glutenIMPEdit">
                <input type="radio" id="glutenIMPEdit" name="gluten">Yes
                </label>                             
                <label for="glutenNIMPEdit">
                <input type="radio" id="glutenNIMPEdit" name="gluten">No
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
                <label for="lactoseIMPEdit">
                <input type="radio" id="lactoseIMPEdit" name="lactose">Yes
                </label>                             
                <label for="lactoseNIMPEdit">
                <input type="radio" id="lactoseNIMPEdit" name="lactose">No
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
                <label for="nutsIMPEdit">
                <input type="radio" id="nutsIMPEdit" name="nuts">Yes
                </label>                             
                <label for="nutsNIMP">
                <input type="radio" id="nutsNIMPEdit" name="nuts">No
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
                <label for="soybeansIMPEdit">
                <input type="radio" id="soybeansIMPEdit" name="soybeans">Yes
                </label>                             
                <label for="soybeansNIMPEdit">
                <input type="radio" id="soybeansNIMPEdit" name="soybeans">No
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
              <label for="so2IMPEdit">
              <input type="radio" id="so2IMPEdit" name="Sulphur">Yes
              </label>                             
              <label for="so2NIMPEdit">
              <input type="radio" id="so2NIMPEdit" name="Sulphur">No
              </label>
            </div>
          </div>
        </div>
          <div class="RegContainer5">
            <input type="submit" onclick="getPref()" class="RegSubmitbtn" value="Edit">
          </div>
        </form><br><br><br>
      </div>
    </div>
   <script type="text/javascript">
    
      function getPref(){
        const nutriqualIMP=document.querySelector('#nutriqualIMPEdit');
        var nutriqual=nutriqualIMP.checked;
        
        const lowsaltIMP = document.querySelector('#lowsaltIMPEdit');
        var lowsalt=lowsaltIMP.checked;
        
        const lowsugarsIMP=document.querySelector('#lowsugarsIMPEdit');
        var lowsugars=lowsugarsIMP.checked;
        
        const lowfatsIMP = document.querySelector('#lowfatsIMPEdit');
        var lowfats=lowfatsIMP.checked;
        
        const glutenIMP = document.querySelector('#glutenIMPEdit');
        var gluten=glutenIMP.checked;
        
        const lactoseIMP = document.querySelector('#lactoseIMPEdit');
        var lactose=lactoseIMP.checked;    
        const nutsIMP = document.querySelector('#nutsIMPEdit');
        var nuts=nutsIMP.checked;
        
        const soybeansIMP = document.querySelector('#soybeansIMPEdit');
        var soybeans=soybeansIMP.checked;
        
        const so2IMP = document.querySelector('#so2IMPEdit');
        var so2=so2IMP.checked;
        
        var xml=new XMLHttpRequest();
        xml.onreadystatechange=function(){
          if(this.readyState==4 && this.status==200){
            console.log(this.responseText);
          }
        }
        xml.open("GET", "EditSelectedPreferences.php?nutriqual="+nutriqual+"&lowsalt="+lowsalt+"&lowsugars="+lowsugars+"&lowfats="+lowfats+"&gluten="+gluten+"&lactose="+lactose+"&nuts="+nuts+"&soybeans="+soybeans+"&so2="+so2, true);
xml.send();
         
      };
    </script> 
  </body>
</html>
