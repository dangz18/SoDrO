<?php
class ProductRepository{
  protected $db;

  public function __construct($db){
    $this->db=$db;
  }
  
  public function getProducts(){
    $products=$this->db->query("SELECT * FROM products")->fetchALL();
    return $products;
  }
  public function getTopProducts(){
    return null;
  }
  public function getProductsNameSuggestion($name){
    $query=$this->db->prepare("SELECT name FROM products WHERE name LIKE '$name%' LIMIT 2");
    $query->execute();
    $products=$query->fetchAll();
    return $products;
  }
  public function getProductNutritionFactsById($idProd){
    $query=$this->db->prepare('SELECT * FROM nutritionFacts WHERE id_product=:id');
    $query->bindValue(':id', $idProd, PDO::PARAM_INT);
    $query->execute();
    $nutritionFacts=$query->fetch();
    return $nutritionFacts;
  }

  
  public function getProductByUserPreferences($id, $prefferences, $category, $minPrice, $maxPrice){
    if($prefferences=='false'){
       if($category=="All"){
       $query=$this->db->prepare("SELECT * FROM products WHERE price>'$minPrice' and price<'$maxPrice' ");
    }
    else{
       $query=$this->db->prepare("SELECT * FROM products WHERE category LIKE '%$category%' and (price>'$minPrice' and price<'$maxPrice')"); 
    }
       $query->execute();
    $products=$query->fetchAll();
    if($products)
      return $products;
    return -1;
    }else{
      $query1=$this->db->prepare("SELECT * FROM userPreferences WHERE id_user= '$id' ");
       $query1->execute();
      $pref=$query1->fetch();
      if($pref){
        if($category=="All"){
           $query2=$this->db->prepare("SELECT * FROM products JOIN nutritionFacts on products.id=nutritionFacts.id_product JOIN productRestrictions on products.id=productRestrictions.id_prod WHERE price>'$minPrice' and price<'$maxPrice'");
        }else{
            $query2=$this->db->prepare("SELECT * FROM products JOIN nutritionFacts on products.id=nutritionFacts.id_product JOIN productRestrictions on products.id=productRestrictions.id_prod WHERE category LIKE '%$category%' and (price>'$minPrice' and price<'$maxPrice')");
        }
       $query2->execute();
      $productsInfo=$query2->fetchAll();
      $result=[];
      foreach($productsInfo as $product){
        $check=1;

        if($pref['good_nutrition_quality']=='true'){
        if($product['nutri_score']=='E' || $product['nutri_score']=='C' || $product['nutri_score']=='D'){   
          $check=0;
        }
      }
        if($pref['low_salt']=='true'){
        if($product['salt_100']>5){

         $check=0;
        }
      }
        if($pref['low_sugars']=='true'){
        if($product['sugars_100']>10){
          $check=0;
        }
      }
         if($pref['low_fats']=='true'){
        if($product['fat_100']>5){
          $check=0;
        }
      }
        if($pref['gluten']=='true'){
        if($product['gluten']==1){

          $check=0;
        }
      }
        if($pref['lactose']=='true'){
        if($product['lactose']==0){

          $check=0;
        }
      }
         if($pref['nuts']=='true'){
        if($product['nuts']==1){

          $check=0;
        }
      }
        if($pref['soybeans']=='true'){
        if($product['soybeans']==1){

          $check=0;
        }
      }
        if($pref['so2']=='true'){
        if($product['so2']==1){

          $check=0;
        }
      }
        if($check==1){
           $query3=$this->db->prepare('SELECT * FROM products WHERE name=:name');
    $query3->bindValue(':name', $product['name'], PDO::PARAM_STR);
    $query3->execute();
    $product=$query3->fetch();
          array_push($result,$product);
        }
      }
        if(sizeof($result)>0){
      return $result;
    }
        return-1;
  }
}
}
  public function getProductsByFilter($category,$minPrice,$maxPrice){
      if($category=="All"){
       $query=$this->db->prepare("SELECT * FROM products WHERE price>'$minPrice' and price<'$maxPrice' ");
    }
    else{
       $query=$this->db->prepare("SELECT * FROM products WHERE category LIKE '%$category%' and (price>'$minPrice' and price<'$maxPrice')"); 
    }
    $query->execute();
    $products=$query->fetchAll();
    if($products)
      return $products;
    return -1;
  }
  public function getProductsBySearch($name){
    $query=$this->db->prepare("SELECT * FROM products WHERE name LIKE '%$name%'");
    $query->execute();
    $products=$query->fetchAll();
    if($products)
      return $products;
    return -1;
  }
    
  public function getProductById($idProd){
    $query=$this->db->prepare('SELECT * FROM products WHERE id=:id');
    $query->bindValue(':id', $idProd, PDO::PARAM_INT);
    $query->execute();
    $product=$query->fetch();
    return $product;
  }


  public function getRestrictionsByProductId($productId){
    $query=$this->db->prepare('SELECT * FROM productRestrictions WHERE id_prod=:id');
    $query->bindValue(':id', $productId, PDO::PARAM_INT);
    $query->execute();
    $restrictions=$query->fetch();
      $rest="ATTENTION! This product contains: ";
      if($restrictions['gluten']==1){
        $rest.="gluten ";
      }
      if($restrictions['lactose']==1){
        $rest.="lactose ";
      }
      if($restrictions['nuts']==1){
        $rest.="nuts ";
      }
      if($restrictions['soybeanse']==1){
        $rest.="soybeanse ";
      }
      if($restrictions['so2']==1){
        $rest.="sulphur dioxide and sulphites ";
      }

    if(strlen($rest)>strlen("ATTENTION! This product contains: "))
      return $rest;
    return "No Restrictions";
  }
}
?>