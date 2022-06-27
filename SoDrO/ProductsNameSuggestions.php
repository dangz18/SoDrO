<?php

require_once __DIR__. "/DataBase.php";
require_once __DIR__. "/ProductRepository.php";


$db=getDbConn();

$productRepo = new ProductRepository($db);

$name=$_REQUEST['name'];
$suggestion="";

if($name !== ""){
  $name=strtolower($name);
  $products = $productRepo->getProductsNameSuggestion($name);
  if($products!=-1){
    foreach($products as $product){
      if($suggestion===""){
        $suggestion=$product['name'];
      }
      else{
        $suggestion.=", ";
        $suggestion.=$product['name'];
      }
    }
  }
  echo $suggestion === "" ? "No Suggestions" : $suggestion;
}
?>

