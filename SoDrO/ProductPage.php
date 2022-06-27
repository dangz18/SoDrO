<?php 
  session_start();
  require_once __DIR__. "/DataBase.php";
  require_once __DIR__. "/UserRepository.php";
  require_once __DIR__. "/ListRepository.php";
  require_once __DIR__. "/ProductRepository.php";
$productId=$_GET['productId'];
$db=getDbConn();
$productRepo = new ProductRepository($db);
  $product=$productRepo->getProductById($productId);
  $nutritionFacts=$productRepo->getProductNutritionFactsById($productId);
  switch($product['nutri_score']){
  case "A" : $nutri_score="Nutri-Scores/nutri-scoreA.png";break;
  case "B" : $nutri_score="Nutri-Scores/nutri-scoreB.png";break;
  case "C" : $nutri_score="Nutri-Scores/nutri-scoreC.png";break;
  case "D" : $nutri_score="Nutri-Scores/nutri-scoreD.png";break;
  case "E" : $nutri_score="Nutri-Scores/nutri-scoreE.png";break;
}
$restrictions=$productRepo->getRestrictionsByProductId($productId);
  $userRepo = new UserRepository($db);
  $listRepo = new ListRepository($db);
  if($_SESSION['token']!="none"){
        $user = $userRepo->getUserFromToken($_SESSION['token']);
        $lists=$listRepo->getUserListsByUserId($user->id);
  }
   
?>
<!DOCTYPE html>
<html>
  <head> 
      <link href="Style.css" rel="stylesheet" type="text/css">
      <link href="ProductPageStyle.css" rel="stylesheet" type="text/css">
      <link href="BannerStyle.css" rel="stylesheet" type="text/css">
      <link href="ListStyle.css" rel="stylesheet" type="text/css">
  </head>
  <body> 
    
    <?php include_once 'Banner.php';?>

    <div class="row">  <!-- Prima linie -->
      <button class="backButton" type="button" onclick="history.back()">
        <img src="Buttons/back.png" class="backBt">
      </button>
      <div class='titleBar3'><br><h2><?php echo $product['name']?> 
<?php echo $product['capacity']?>ml</h2></div>
         <?php if($_SESSION['token']!="none"):?>
      <button id="addToListBtn" class="addButton" type="button">
        <img src="Buttons/add.png" class="addBt">
      </button>

      <?php if($lists!=-1):?>
      <div class="popup" id="popupAddToList">
        <div class="popup-content">
          <div class="row">
            <p id="selectList">Select the list where you want to add the product:</p>
          </div>
          <div id="addProdToListCont" class='listOfTitlesCont'>
            <h2 id="MyLists">My Lists</h2>
            <div class="listsBody" style="height:130px;">
              <?php 
                foreach ($lists as $list) {
                  echo '<p>';
                  echo '<label class="checkbox-inline">';
                  echo  '<input type="checkbox" value="" style="margin-right: 5px;">'.$list['name'].'</p>';
                  echo '</label>';
                }
              ?>
            </div> 
          </div>
              
          <div class="row">
            <button id="confirm" class="decisionBtn" type="button">
              <p2>Confirm</p2>
            </button>
            <button id="cancel" class="decisionBtn" type="button">
              <p2>Cancel</p2>
            </button>
          </div>
        </div>
      </div>
        <?php else:?>
    <div class="popup" id="popupAddToList">
        <div class="popup-content">
          <div class="row">
            <p id="selectList">In order to add a product to the shopping list, it is necessary to create at liste one list first at the lists section!</p>
          </div>
         <div class="row">
            <button id="signIn" class="decisionBtn" type="button">
              <p2>Go to Lists</p2>
            </button>
            <button id="cancel" class="decisionBtn" type="button">
              <p2>Cancel</p2>
            </button>
          </div>
      </div>
    </div>
          <?php endif?>
              <?php endif?>


    </div>
    <div class="row"> <!-- A doua linie -->
      <div class='productImageCont'><br><div class="drinkProdImage" style="--background: url(<?php echo $product['image'];?>);"></div></div>
      <div class='productInfoCont'>
          <div class="nutri_score" style="--background:url(<?php echo $nutri_score?>)"></div>
          <div class="nutrient_lvl">
            <h2>Nutrient levels for 100g</h2>
            <p><?php echo $nutritionFacts['fat_100'];?>g Fat in low quantity</p>
            <p><?php echo $nutritionFacts['saturated_fat_100'];?>g Saturated Fat in low quantity</p>
            <p><?php echo $nutritionFacts['sugars_100'];?>g Sugars in high quantity</p>
            <p><?php echo $nutritionFacts['salt_100'];?>g Salt in low quantity</p>
            <p></p>
          </div>
          <div class="productPriceCont"><h2>Price:<?php echo $product['price']?>RON</h2></div>
      </div>   
    </div>
    <div class='productNutrientTableCont'> <!-- A treia linie -->
      <div class="row">
        <div class="ingredients">
          <h2>Ingredient List :</h2>
          <p><?php echo $product['ingredients'];?></p>
        </div>
        <div class="category">
          <h2>Categories:</h2>
          <p><?php echo $product['category'];?></p>
        </div>
      </div>
        
      <div class="nutrient_table">
        <table>
          <tr> <!-- linie -->
            <th>Nutrition Facts</th>
            <th>As sold for 100g/100ml</th>
            <th>As sold per serving(330ml)</th>
          </tr>
          <tr>
            <th>Energy</th>
            <th><?php echo $nutritionFacts['energy_100'];?>kcal</th>
            <th><?php echo $nutritionFacts['energy_serv'];?>kcal</th>
          </tr>
          <tr>
            <th>Fat</th>
            <th><?php echo $nutritionFacts['fat_100'];?>g</th>
            <th><?php echo $nutritionFacts['fat_serv'];?>g</th>
          </tr>
          <tr>
            <th>Saturated Fat</th>
            <th><?php echo $nutritionFacts['saturated_fat_100'];?>g</th>
            <th><?php echo $nutritionFacts['saturated_fat_serv'];?>g</th>
          </tr>
          <tr>
            <th>Carbohydrates</th>
            <th><?php echo $nutritionFacts['carbohydrates_100'];?>g</th>
            <th><?php echo $nutritionFacts['carbohydrates_serv'];?>g</th>
          </tr>
          <tr>
            <th>Sugars</th>
            <th><?php echo $nutritionFacts['sugars_100'];?>g</th>
            <th><?php echo $nutritionFacts['sugars_serv'];?>g</th>
          </tr>
          <tr>
            <th>Fibers</th>
            <th><?php echo $nutritionFacts['fibers_100'];?></th>
            <th><?php echo $nutritionFacts['fibers_serv'];?></th>
          </tr>
          <tr>
            <th>Proteins</th>
            <th><?php echo $nutritionFacts['proteins_100'];?>g</th>
            <th><?php echo $nutritionFacts['proteins_serv'];?>g</th>
          </tr>
          <tr>
            <th>Salt</th>
            <th><?php echo $nutritionFacts['salt_100'];?>g</th>
            <th><?php echo $nutritionFacts['salt_serv'];?>g</th>
          </tr>
          <tr>
            <th>Fruits, vegetable, nuts</th>
            <th><?php echo $nutritionFacts['fruits_vegetable_nuts_100'];?>%</th>
            <th><?php echo $nutritionFacts['fruits_vegetable_nuts_serv'];?>%</th>
          </tr>
        </table>
      </div>
      <div class="row">
        <div class="restrictions">
          <img src='Images/danger.png' width="40" height="40">
          <h2>Restrictions:</h2>
          <p><?php echo $restrictions?></p>
        </div>
      </div>
      
    </div>
    <script>     
    <?php if($_SESSION['token']!="none"):?>
      <?php if($lists!=-1):?>
      var popupAddToListWindow = document.getElementById("popupAddToList");
      
      // Get the button that opens the popup for create new List
      var addToListBtn = document.getElementById("addToListBtn");
      
      // Get the <span> element that closes the popup
      
      var cancel =  document.getElementById("cancel");
      var confirm =  document.getElementById("confirm");
      cancel.onclick = function() {
        popupAddToListWindow.style.display = "none";
      }
      confirm.onclick = function() {
        popupAddToListWindow.style.display = "none";    

      }
      
      // When the user clicks the button, open the popup 
      addToListBtn.onclick = function() {
        popupAddToListWindow.style.display = "block";
      }
      
      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == popupAddToListWindow) {
          popupAddToListWindow.style.display = "none";
        }
          
      }
      <?php else:?>
          var popupAddToListWindow = document.getElementById("popupAddToList");
      
      // Get the button that opens the popup for create new List
      var addToListBtn = document.getElementById("addToListBtn");
      
      // Get the <span> element that closes the popup
      
      var cancel =  document.getElementById("cancel");
      var goSignIn =  document.getElementById("signIn");
      cancel.onclick = function() {
        popupAddToListWindow.style.display = "none";
      }
      goSignIn.onclick = function() {
        popupAddToListWindow.style.display = "none";   
        location.href='List.php';
      }
      
      // When the user clicks the button, open the popup 
      addToListBtn.onclick = function() {
        popupAddToListWindow.style.display = "block";
      }
      
      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == popupAddToListWindow) {
          popupAddToListWindow.style.display = "none";
        }
          
      }
    <?php endif?>
  <?php endif?>
    </script>
  </body>
</html>>