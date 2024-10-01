<?php include "connect.php" ?>
<?php
    $stmt = $pdo->prepare("INSERT INTO product (pname, pdetail, price,pImage,product_quantity) VALUES (?, ?, ?, ?,?)");
    $stmt->bindParam(1,$_POST["pname"]);
    $stmt->bindParam(2,$_POST["pdetail"]);
    $stmt->bindParam(3,$_POST["price"]);
    $ImageFile = file_get_contents($_FILES['image_upload']['tmp_name']);
    $stmt->bindParam(4,$ImageFile,PDO::PARAM_LOB);
    $stmt->bindParam(5,$_POST["qty"]);
    $pid = $pdo->lastInsertId();
    
    if($stmt->execute()){
        header("location: All_Product.php");
    }
?>