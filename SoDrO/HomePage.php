<?php
session_start();

require_once __DIR__. "/DataBase.php";
require_once __DIR__. "/ProductRepository.php";


$db=getDbConn();

$productRepo = new ProductRepository($db);

$products = $productRepo->getProducts();
?>

<!DOCTYPE html>

<html lang="en">
  <head> 
    <title> SoDrO - Home</title>
    <link href="Style.css" rel="stylesheet" type="text/css">
    <link href="HomePageStyle.css" rel="stylesheet" type="text/css">
    <link href="ProductsPageStyle.css" rel="stylesheet" type="text/css">
    <link href="BannerStyle.css" rel="stylesheet" type="text/css">
  </head>
    <body>
      <?php include_once('Banner.php');?>
      <div class='homeContainer'>
          <div class='titleBar1'><br><h2>Top 8 most popular drinks</h2></div>
            <ul class="list-group" id="productsList" >
            <?php 
              foreach ($products as $product) :?>
                <li>
                <button type="button" class="productBox" id="top" onclick="location.href='ProductPage.php?productId=<?php echo $product['id']?>'">
                <span class="circle"><?php echo $product['id']?></span>
                <div class="productPreview"  style="--background:url(<?php echo $product['image']?>);"></div>
                <div class="hSpecial"><?php echo $product['name']?></div>
                </button>
                </li>
               <?php endforeach ?>
            </ul>
          <div class='aboutUsContainer'> 
            <br>
            <div class='titleBar2'><br><h2>About Us</h2><br></div>
            <div class="hSpecial">This is a website, made by us, that helps you find the best soda drinks based on your preferences, and also for our dear clients, we offer 
the best oportunity to make a shopping list, this way the daily routine of shopping is easier and funnier :)</div>
          </div>
      </div>
    </body>
</html>