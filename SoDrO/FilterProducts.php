<?php
session_start(); 
require_once __DIR__. "/DataBase.php";
require_once __DIR__. "/ProductRepository.php";
require_once __DIR__. "/UserRepository.php";

 $db=getDbConn();
 $productRepo = new ProductRepository($db);
$prefferences=$_REQUEST['prefferences'];
$category=$_REQUEST['category'];
$minPrice=$_REQUEST['minPrice'];
$maxPrice=$_REQUEST['maxPrice'];
$searchedProduct=$_REQUEST['searched'];

 '<link href="Style.css" rel="stylesheet" type="text/css">
 <link href="ProductsPageStyle.css" rel="stylesheet" type="text/css">';
if(isset($category)&&isset($minPrice)&&isset($maxPrice) ){
  if(isset($prefferences)){
     $userRepo = new UserRepository($db);
     $user=$userRepo->getUserFromToken($_SESSION['token']);
    $products=$productRepo->getProductByUserPreferences($user->id,$prefferences,$category,$minPrice,$maxPrice);
  }else{
     $products=$productRepo->getProductsByFilter($category,$minPrice,$maxPrice);
  }
}


if(isset($products)):?>
 <?php if($products==-1):?>
     <h2>No product found accorting to your filter.</h2>
  <?php else:?>
   <ul class="list-group" id="productsList" >
   <?php foreach ($products as $product):?>
             <li><button type="button" class="productBox" onclick="location.href='ProductPage.php?productId=<?php echo $product['id'];?>'">
             <span class="circle" style="background:#FFC268"><?php echo $product['id'];?></span>
             <div class="productPreview" style="--background:url(<?php echo $product['image'];?>);"></div>
              <div class="hSpecial"><?php echo $product['name'];?></div>
            </button></li>
             
             <?php endforeach ?>
   </ul>
  <?php endif ?>
 <?php endif ?>
