<?php
function getDbConn(){
  try{
    $db=new PDO('sqlite:SoDrO.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $db;
  }catch(PDOException $e){
    echo $e->getMessage();
  }
}

function initDb($db){
  $db->exec(
    "
    CREATE TABLE IF NOT EXISTS users(
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      name TEXT NOT NULL UNIQUE,
      password TEXT NOT NULL,
      e_mail TEXT NOT NULL
    );

    CREATE TABLE IF NOT EXISTS userPreferences(
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      id_user INTEGER UNIQUE NOT NULL,
      good_nutrition_quality TEXT,
      low_salt TEXT,
      low_sugars TEXT,
      low_fats TEXT,
      gluten TEXT,
      lactose TEXT,
      nuts TEXT,
      soybeans TEXT,
      so2 TEXT,
      CONSTRAINT fk_id_user FOREIGN KEY (id_user) REFERENCES users (id)
    );

    CREATE TABLE IF NOT EXISTS sessions(
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      user_id INTEGER, 
      token TEXT,
      FOREIGN KEY (user_id) REFERENCES users (id)
    );


    CREATE TABLE IF NOT EXISTS products(
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      name TEXT UNIQUE,  
      image TEXT UNIQUE,
      capacity INTEGER,
      price REAL DEFAULT 0,
      ingredients TEXT DEFAULT 'NOTHING',
      category TEXT,
      nutri_score TEXT
    );

    CREATE TABLE IF NOT EXISTS productRestrictions(
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      id_prod INTEGER NOT NULL UNIQUE,
      gluten BOOLEAN NOT NULL CHECK (gluten IN (0, 1)) DEFAULT 0,
      lactose BOOLEAN NOT NULL CHECK (lactose IN (0, 1)) DEFAULT 0,
      nuts BOOLEAN NOT NULL CHECK (nuts IN (0, 1)) DEFAULT 0,
      soybeans BOOLEAN NOT NULL CHECK (soybeans IN (0, 1)) DEFAULT 0,
      so2 BOOLEAN NOT NULL CHECK (so2 IN (0, 1)) DEFAULT 0,

      CONSTRAINT fk_id_prod FOREIGN KEY (id_prod) REFERENCES products (id)
    );

    CREATE TABLE IF NOT EXISTS nutritionFacts(
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      id_product INTEGER UNIQUE,      
      energy_100 REAL DEFAULT 0,
      fat_100 REAL DEFAULT 0,
      saturated_fat_100 REAL DEFAULT 0,
      carbohydrates_100 REAL DEFAULT 0,
      sugars_100 REAL DEFAULT 0,
      proteins_100 REAL DEFAULT 0,
      fibers_100 REAL DEFAULT 0,
      salt_100 REAL DEFAULT 0,
      fruits_vegetable_nuts_100 REAL DEFAULT 0,
      energy_serv REAL DEFAULT 0,
      fat_serv REAL DEFAULT 0,
      saturated_fat_serv REAL DEFAULT 0,
      carbohydrates_serv REAL DEFAULT 0,
      sugars_serv REAL DEFAULT 0,
      proteins_serv REAL DEFAULT 0,
      fibers_serv REAL DEFAULT 0,
      salt_serv REAL DEFAULT 0,
      fruits_vegetable_nuts_serv REAL DEFAULT 0,
      CONSTRAINT fk_id_product FOREIGN KEY (id_product) REFERENCES products (id)
    );
    

    CREATE TABLE IF NOT EXISTS lists(
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      id_user INTEGER,
      name TEXT,
      CONSTRAINT fk_id_user FOREIGN KEY (id_user) REFERENCES users (id)
    );

    CREATE TABLE IF NOT EXISTS list_items(
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      id_list INTEGER,
      name TEXT,
      CONSTRAINT fk_id_list FOREIGN KEY (id_list) REFERENCES lists (id)
    );

    CREATE TABLE IF NOT EXISTS list_members(
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      id_list INTEGER,
      id_user INTEGER,
      CONSTRAINT fk_id_list FOREIGN KEY (id_list) REFERENCES lists (id),
      CONSTRAINT fk_id_user FOREIGN KEY (id_user) REFERENCES users (id)

    );
    "
  );
}


function insertProducts($db){
  $db->exec(
    "
    /*Inseram useri*/
    INSERT OR IGNORE INTO users (name,password,e_mail) VALUES('cristi','1234','cristi@gmail.com');
    INSERT OR IGNORE INTO users (name,password,e_mail) VALUES('dan','1111','dan@gmail.com');
    INSERT OR IGNORE INTO users (name,password,e_mail) VALUES('cristian','4321','cristian@gmail.com');


    /*Inseram produse in baza de date*/
    INSERT OR IGNORE INTO products (name , image , ingredients, capacity, price, category, nutri_score)         VALUES('CocaCola','TopImages/cocacola.png','carbonated water, sugar, coloring, acidifier, phosphoric acid, natural flavours (plant extract, caffeine)', 330, 2.95, 'Beverages, Sweetened beverages', 'E'); 

    INSERT OR IGNORE INTO products (name , image , ingredients, capacity, price, category, nutri_score)         VALUES('Schweppes','TopImages/sveps.png','Carbonated Water, Sugar, Citric Acid, Flavourings Including Quinine, Sweetener (Sodium Saccharin)', 330, 3.05, 'Beverages, Sweetened beverages', 'D');

    INSERT OR IGNORE INTO products (name , image , ingredients, capacity, price, category, nutri_score)         VALUES('RedBull','TopImages/redbull.png','Water, sucrose, glucose, citric citric acid, carbonic acid, taurine (400 mg / 100ml), acidity regulator (sodium carbonate, magnesium carbonate), caffeine (32 mg / 100ml), vitamins (niacin, pantothenic acid, B6, B12), flavoring, coloring (sugar co , Riboflavin)', 335, 7.10, ' Beverages, Non-Alcoholic beverages, Energy drinks, Sweetened beverages', 'D');

    INSERT OR IGNORE INTO products (name , image , ingredients, capacity, price, category, nutri_score)         VALUES('PepsiCola','TopImages/pepsicola.png','carbonated water, sugar, dye: caramel (e150d), acidifying (e333), aromas including caffeine and natural plant extracts', 330, 2.65, 'Beverages, Carbonated drinks, Artificially sweetened beverages, Sodas, Non-Alcoholic beverages, Colas, Sweetened beverages', 'E');

    INSERT OR IGNORE INTO products (name , image , ingredients, capacity, price, category, nutri_score)         VALUES('Lipton','TopImages/lipton.png','water, sugar frictose, acidity regulators (citric acid, malic acid), extract of the black (1.4 g/), peach juice based on concentrate (0,1%), an acidity regulator, (trisodium citrate, flavourings, antioxidant (ascorbic acid) sweetener (steviol glycosides)', 330, 3.15, ' Beverages, Iced teas', 'B');

    INSERT OR IGNORE INTO products (name , image , ingredients, capacity, price, category, nutri_score)         VALUES('Sprite','TopImages/sprite.png','carbonated water, high fructose corn syrup, citric acid, natural flavors, sodium citrate, sodium benzoate (to protect taste)', 355, 2.80, 'Beverages, Carbonated drinks, Sodas, Sweetened beverages', 'E');

    INSERT OR IGNORE INTO products (name , image , ingredients, capacity, price, category, nutri_score) VALUES('St. caramel macchiato','TopImages/starbucks.png','milk (contains 1.8% fat) 75%, starbucks arabica coffee® (water, coffee extract) 20%, sugar, caramel flavor (contains milk), acidity corrector (potassium carbonates), stabilizers (carrageenans, guar gum), emulsifiers (mono and diglycerides of fatty acids of vegetable origin)', 220, 12, 'Beverages, Dairies, Dairy drinks, Flavoured milks, Sweetened beverages', 'B');

    INSERT OR IGNORE INTO products (name , image , ingredients, capacity, price, category, nutri_score)         VALUES('Orange Juice','TopImages/suc.png','orange juice with pulp', 150, 5.3, 'Plant-based foods and beverages, Beverages, Plant-based beverages, Fruit-based beverages, Juices and nectars, Fruit juices, Non-Alcoholic beverages, Orange juices, Squeezed juices, Squeezed orange juices, Juices', 'A');



    /*Inseram nutrition facts pentru tabel*/
    INSERT OR IGNORE INTO nutritionFacts (id_product,  energy_100,fat_100,saturated_fat_100,carbohydrates_100,sugars_100,proteins_100,fibers_100,salt_100,fruits_vegetable_nuts_100,energy_serv,fat_serv,saturated_fat_serv,carbohydrates_serv,sugars_serv,proteins_serv,fibers_serv,salt_serv,fruits_vegetable_nuts_serv) VALUES (1,  13,0,0,10.6,10.6,0,0,0,0,  44,0,0,35,35,0,0,0,0);

    INSERT OR IGNORE INTO nutritionFacts (id_product,  energy_100,fat_100,saturated_fat_100,carbohydrates_100,sugars_100,proteins_100,fibers_100,salt_100,fruits_vegetable_nuts_100,energy_serv,fat_serv,saturated_fat_serv,carbohydrates_serv,sugars_serv,proteins_serv,fibers_serv,salt_serv,fruits_vegetable_nuts_serv) VALUES (2,  21,0,0,4.9,4.9,0,0,0,0,  120,0,0,31,28,0,0,0,0);

    INSERT OR IGNORE INTO nutritionFacts (id_product,  energy_100,fat_100,saturated_fat_100,carbohydrates_100,sugars_100,proteins_100,fibers_100,salt_100,fruits_vegetable_nuts_100,energy_serv,fat_serv,saturated_fat_serv,carbohydrates_serv,sugars_serv,proteins_serv,fibers_serv,salt_serv,fruits_vegetable_nuts_serv) VALUES (3,  46,0,0,11,11,0,0,0.1,0,  160,0,0,42,38,0,0,0.3,0);

    INSERT OR IGNORE INTO nutritionFacts (id_product,  energy_100,fat_100,saturated_fat_100,carbohydrates_100,sugars_100,proteins_100,fibers_100,salt_100,fruits_vegetable_nuts_100,energy_serv,fat_serv,saturated_fat_serv,carbohydrates_serv,sugars_serv,proteins_serv,fibers_serv,salt_serv,fruits_vegetable_nuts_serv) VALUES (4,  28,0,0,7,7,0,0,0.01,0,  92,0,0,23.1,23.1,0,0,0.033,0);

    INSERT OR IGNORE INTO nutritionFacts (id_product,  energy_100,fat_100,saturated_fat_100,carbohydrates_100,sugars_100,proteins_100,fibers_100,salt_100,fruits_vegetable_nuts_100,energy_serv,fat_serv,saturated_fat_serv,carbohydrates_serv,sugars_serv,proteins_serv,fibers_serv,salt_serv,fruits_vegetable_nuts_serv) VALUES (5,  20,0,0,4.6,4.5,0,0,0.01,0.1,  66,0,0,15.2,14.8,0,0,0.033,0.1);
    
    INSERT OR IGNORE INTO nutritionFacts (id_product,  energy_100,fat_100,saturated_fat_100,carbohydrates_100,sugars_100,proteins_100,fibers_100,salt_100,fruits_vegetable_nuts_100,energy_serv,fat_serv,saturated_fat_serv,carbohydrates_serv,sugars_serv,proteins_serv,fibers_serv,salt_serv,fruits_vegetable_nuts_serv) VALUES (6,  140,0,0,38,38,0,0,0.0162,0,  497,0,0,135,135,0,0,0.0557,0);

    INSERT OR IGNORE INTO nutritionFacts (id_product,  energy_100,fat_100,saturated_fat_100,carbohydrates_100,sugars_100,proteins_100,fibers_100,salt_100,fruits_vegetable_nuts_100,energy_serv,fat_serv,saturated_fat_serv,carbohydrates_serv,sugars_serv,proteins_serv,fibers_serv,salt_serv,fruits_vegetable_nuts_serv) VALUES (7,  62,1.9,1,9,8.6,0,2.9,0.09,0,  136,4.18,2.2,19.8,18.9,0,6.38,0.198,0);

    INSERT OR IGNORE INTO nutritionFacts (id_product,  energy_100,fat_100,saturated_fat_100,carbohydrates_100,sugars_100,proteins_100,fibers_100,salt_100,fruits_vegetable_nuts_100,energy_serv,fat_serv,saturated_fat_serv,carbohydrates_serv,sugars_serv,proteins_serv,fibers_serv,salt_serv,fruits_vegetable_nuts_serv) VALUES (8,  42,0,0,8.6,8.6,0.8,0.8,0,98,  63,0,0,12.9,12.9,1.2,1.2,0,98);


    /*Inseram restrictiile pentru producte*/
    INSERT OR IGNORE INTO productRestrictions(id_prod,so2) VALUES (1,1);
    INSERT OR IGNORE INTO productRestrictions(id_prod,so2) VALUES (2,1);
    INSERT OR IGNORE INTO productRestrictions(id_prod,so2) VALUES (3,1);
    INSERT OR IGNORE INTO productRestrictions(id_prod,so2) VALUES (4,1);
    INSERT OR IGNORE INTO productRestrictions(id_prod) VALUES (5);
    INSERT OR IGNORE INTO productRestrictions(id_prod,so2) VALUES (6,1);
    INSERT OR IGNORE INTO productRestrictions(id_prod,lactose) VALUES (7,1);
    INSERT OR IGNORE INTO productRestrictions(id_prod) VALUES (8);

"
  );
}

?>