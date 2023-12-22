<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ecommerce';

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection error" . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechBuy</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">TechBuy.com</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mb-2 mb-lg-2">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Products
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="category.php?category=Laptop">Laptop</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="category.php?category=Phone">Phones</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="col-md-2"></div>

<div class="col-md-8">
    <h2 class="text-center">Top Products</h2><br>
    <div class="row">
        <?php
            while($product = $result->fetch_assoc()){
        ?>
        <div class="col-md-5">
            <h4><?= $product['title']; ?></h4>
            <img src="<?= $product['image']; ?>" alt="<?= $product['title']; ?>" class="img-fluid">
            <p class="lprice">NGN <?= $product['price'];?></p>
            <a href="details.php?title=<?= $product['title'];?>">
                <button type="button" class="btn btn-success" data-toggle='modal' data-target='#details-1'>More</button>
            </a>
            <a href="add.php?title=<?= $product['title'];?>">
                <button type="button" class="btn btn-info" data-toggle='modal' data-target='#details-1'>Add to cart</button>
            </a>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>


</body>
</html>