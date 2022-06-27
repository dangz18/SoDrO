<?php

require_once __DIR__. "/DataBase.php";
require_once __DIR__. "/ProductRepository.php";
$db=getDbConn();
$productRepo = new ProductRepository($db);
$searchedProd=$_REQUEST['searchedProd'];

 '<link href="Style.css" rel="stylesheet" type="text/css">
 <link href="ProductsPageStyle.css" rel="stylesheet" type="text/css">';
if(isset($searchedProd)){
 $products=$productRepo->getProductsBySearch($searchedProd);
}


if(isset($products)):?>
 <?php if($products==-1):?>
     <h2>No product found accorting to your search.</h2>
  <?php else:?>
   <ul class="list-group" id="productsList" >
     <?php foreach ($products as $product):?>
      <li>
        <button type="button" class="productBox" onclick="location.href='ProductPage.php?productId=<?php echo $product['id']?>'">
          <span class="circle" style="background:#FFC268"><?php echo $product['id']?></span>
          <div class="productPreview" style="--background:url(<?php echo $product['image']?>);"></div>
          <div class="hSpecial"><?php echo $product['name']?></div>
        </button>
      </li>         
    <?php endforeach ?>
   </ul>
  <?php endif ?>
 <?php endif ?>

