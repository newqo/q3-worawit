<?php include "connect.php";
  session_start();
  // ตรวจสอบว่ามีชื่อใน session หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
  if (empty($_SESSION["username"]) ) { 
      header("location: login.php");
  }
?>
<?php
        $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ?");
        $stmt->bindParam(1, $_GET["username"]);
        $stmt->execute();
        $row = $stmt->fetch();
?>
<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="pagestyle.css" rel="stylesheet" type="text/css" />
    <script src="mpage.js"></script>
  </head>
  <body>

    <header>
      <div class="logo">
        <img src="cslogo.jpg" width="200" alt="Site Logo">
      </div>
      <div class="search">
        <form>
          <input type="search" placeholder="Search the site...">
          <button>Search</button>
        </form>
      </div>
      <div class="login-box">
        <?php
            echo "<a ";
            if (empty($_SESSION["username"]) ) { 
              echo "href='login.php' class='login-bt'> login";
            }
            else{
              echo "href='logout.php' class='logout-bt'>".$_SESSION["username"];
            }
            echo "</a>";
        ?>
      </div>
    </header>

    <div class="mobile_bar">
      <a href="#"><img src="responsive-demo-home.gif" alt="Home"></a>
      <a href="#" onClick='toggle_visibility("menu"); return false;'><img src="responsive-demo-menu.gif" alt="Menu"></a>
    </div>

    <main>
      <article>
        <h1>ข้อมูลสมาชิกของ <?=$row["name"]?></h1>
        <div class="member-data">
            <div class="member-Profile">
                <?php if (!empty($row["ProfileImage"])) {
                            $Profile = base64_encode($row["ProfileImage"]);
                            echo "<img src='data:image/jpeg;base64," . $Profile . "' width='100' class=''><br>";
                        } else {
                            echo "<p class=''>No image available.</p><br>"; 
                        }
                ?>
            </div>
            <div class="member-detail">
                <p><b>Username : </b><?=$row["username"]?></p>
                <p><b>Password : </b><?=$row["password"]?></p>
                <p><b>Name : </b><?=$row["name"]?></p>
                <p><b>Address : </b><?=$row["address"]?></p>
                <p><b>Mobile : </b><?=$row["mobile"]?></p>
                <p><b>Email :</b><?=$row["email"]?></p>
                <div class="edit-delete-bt">
                <?php
                    echo "<a href='Edit_Member_form.php?username=" . $row["username"] . "' class='edit-bt'>แก้ไข</a>";
                    echo "<a href='#' onclick=\"confirm_delete_member('{$row["username"]}')\" class='delete-bt'>ลบ</a>";
                ?>
                </div>
            </div>
        </div>
      </article>
      <nav id="menu">
        <h2>Navigation</h2>
        <ul class="menu">
            <li class="dead"><a href="mpage.php">Home</a></li>
          <li><a href="All_Product.php">All Products</a></li>
          <li><a href="Product_Table_list.php">Table of All Products</a></li>
          <li><a href="All_Member.php">All Member</a></li>
          <li><a href="Add_Product_form.php">Add Product</a></li>
          <li><a href="Add_Member_form.php">Add Member</a></li>
          <li><a href="cart/cart.php">Cart</a></li>
        </ul>
      </nav>
    </main>
    <footer>
      <a href="#">Sitemap</a>
      <a href="#">Contact</a>
      <a href="#">Privacy</a>
    </footer>
  </body>
</html>
