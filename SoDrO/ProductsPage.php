<?php
include_once('Banner.php');

require_once __DIR__. "/DataBase.php";
require_once __DIR__. "/ProductRepository.php";


$db=getDbConn();

$productRepo = new ProductRepository($db);

$products = $productRepo->getProducts();
?>

<!DOCTYPE html>

<html lang="en">
    <head>
      <title>SoDrO - Products </title>
      <link href="Style.css" rel="stylesheet" type="text/css">
      <link href="ProductsPageStyle.css" rel="stylesheet" type="text/css">
      <link href="BannerStyle.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script>
function showSuggestions(string) {
  
  if(string.length>0){
    //AJAX
    var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
      if(this.readyState==4 && this.status==200){
console.log(this.responseText);
        document.getElementById('suggestions').innerHTML=this.responseText;
      }
    }
xml.open("GET", "ProductsNameSuggestions.php?name="+string, true);
xml.send();
  }
  else{
    document.getElementById('suggestions').innerHTML='';
  }
}

 function filter(){  
    var category=document.getElementById("category").value;
    var minPrice=document.getElementById("minPrice").value;
    var maxPrice=document.getElementById("maxPrice").value; 
    <?php if($_SESSION['token']!="none"):?>
  
      var prefferences=document.getElementById("checkboxPreff").checked;
    if(category=="Select" && prefferences==false && minPrice==0 && maxPrice==999){
    }
   else{
    if(category=="Select")
      category="All";
    var xml=new XMLHttpRequest();
      xml.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
          console.log(this.responseText);
          document.getElementById('productslist').innerHTML=this.responseText;
        }
      }
      xml.open("GET", "FilterProducts.php?category="+category+"&minPrice="+minPrice+"&maxPrice="+maxPrice+"&prefferences="+prefferences, true);
xml.send();
    }
   <?php else:?>
    if(category=="Select"&& minPrice==0 && maxPrice==999){
    }
   else{
    if(category=="Select")
      category="All";
    var xml=new XMLHttpRequest();
      xml.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
          console.log(this.responseText);
          document.getElementById('productslist').innerHTML=this.responseText;
        }
      }
      xml.open("GET", "FilterProducts.php?category="+category+"&minPrice="+minPrice+"&maxPrice="+maxPrice, true);
xml.send();
    }
    <?php endif?>
  }

  function search(){  
     
    var searchedProd=document.getElementById("searchedProduct").value;   
    if(searchedProd==null){
    }
    else{
      var xml=new XMLHttpRequest();
      xml.onreadystatechange=function(){
      if(this.readyState==4 && this.status==200){
        console.log(this.responseText);
        document.getElementById('productslist').innerHTML=this.responseText;
      }
    }
    xml.open("GET", "SearchedProducts.php?searchedProd="+searchedProd, true);
    xml.send();
    }
  }

</script>
    </head>
    <body>
        <div class='productsContainer'>
          <div class='titleBar1'><br><h2>Products</h2></div>

          <div class='filterANDsearchContainer'>
            <ul id='filterAndSearch'>
          <li>
            <ul id='filter'>
            <li><ul id='filterTitle'>
              <li><span class="material-icons" style="margin-top:1px;">filter_alt</span></li>
            <li><h3>Filter by:</h3></li>
            </ul></li>
         <li> <ul id="filterBody">
            <?php if($_SESSION['token']!='none'):?>
           <li>
             
              <label for="prefferences">Prefferences:</label>
             
              <label class="checkbox-inline">
                <input type="checkbox" id="checkboxPreff" value="" style="margin-right:5px;">
              </label>
              
            </li>
  <?php endif ?>
            <li>
              <label for="category">Category:</label>

              <select name="category" id="category">  
              <option value="Select">Select</option> 
              <option value="All">All</option> 
              <option value="Juice" >Juice</option>  
              <option value="Coffee" >Coffee</option>  
              <option value="Sweetened beverages">Sweetened beverages</option>  
              </select>   
            </li>
            <li>
              <div class="priceRange">
                 <label for="Price">Price:</label>
                <div class="field">
                <span style="font-size:14px; margin-top:1px">&nbsp;Min&nbsp;</span>
                <input type="number"id="minPrice" value="0">
                </div>
                <span>&nbsp;-&nbsp;</span>
                <div class="field">
                <span style="font-size:14px; margin-top:1px">Max&nbsp;</span>
                <input type="number" id="maxPrice" value="999">
                </div>
              </div>
            </li>
          </ul></li> 
          <li>
            <button class="filterButton" type="button" onclick="filter()">
                      <h4>Filter</h4>
            </button>
          </li>
          </ul></li>

              <li> 
                <div class="searchBar">
                  <input type="text" style="margin-left:20px;" style="background:#BCC9D8;" id="searchedProduct" name="searchedProduct" placeholder="&nbsp;Search" min="4" maxlength="30" required onkeyup="showSuggestions(this.value)">
                  <button class="searchButton" type="button" onclick="search()">
                    <h4>Search</h4>
                  </button>
                </div>
                <p id="suggestionsTitle"> Suggestions:<span id="suggestions"></span></p> 
              </li>
            </ul>
          </div>
          <div class="products" id="productslist">
            <ul class="list-group" id="productsList" >
            <?php foreach ($products as $product):?>
             <li><button type="button" class="productBox" onclick="location.href='ProductPage.php?productId=<?php echo $product['id']?>'">
             <span class="circle" style="background:#FFC268"><?php echo $product['id']?></span>
             <div class="productPreview" style="--background:url(<?php echo $product['image']?>);"></div>
              <div class="hSpecial"><?php echo $product['name']?></div>
            </button></li>
             
             <?php endforeach ?>
            </ul>
          </div>
        </div>
        
    </body>
</html>
