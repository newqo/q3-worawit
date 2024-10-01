<?php include "connect.php" ?>
<?php
    $stmt = $pdo->prepare("UPDATE product SET pname=?,pdetail=?,price=?,pImage=? WHERE pid = ?");
    $stmt->bindParam(1,$_POST["pname"]);
    $stmt->bindParam(2,$_POST["pdetail"]);
    $stmt->bindParam(3,$_POST["price"]);
    $ImageFile = file_get_contents($_FILES['productImage']['tmp_name']);
    $stmt->bindParam(4,$ImageFile,PDO::PARAM_LOB);
    $stmt->bindParam(5,$_POST["pid"]);

    if($stmt->execute()){
        header("location: All_Product.php");
    }
?>