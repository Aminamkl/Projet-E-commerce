<?php
 
 try{
    $pdo = new PDO( "mysql:host=localhost;dbname=boutique","root","");

    $content = file_get_contents("./products.json");
    $initial_products = json_decode($content);

    foreach($initial_products as $product){
        $id = $product->sku;
        $name = $product->name;
        $description = $product->description;
        $price = $product->price;
        $image = $product->image;
        $sql= "INSERT INTO products VALUES(:id, :name, :description, :price, :image)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id'=> $id,
            'name'=> $name,
            'description'=>$description,
            'price'=>$price,
            'image'=>$image
        ]);
    }

    echo "Done";
 } catch(PDOException $e){
     echo $e->getMessage();
 }

?>