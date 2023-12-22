<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ecommerce';

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection error" . $conn->connect_error);
}


$stmt = $conn->prepare("SELECT * FROM products WHERE title = ?");
$stmt->bind_param('s', $_GET['title']);
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
<div class="col-md-2"></div>

<div class="col-md-8">
    <h2 class="text-center">Product Details</h2><br>
    <div class="row">
        <?php
            while($product = $result->fetch_assoc()){
        ?>
        <div class="col-md-5">
            <h4><?= $product['title']; ?></h4>
            <img src="<?= $product['image']; ?>" alt="<?= $product['title']; ?>" class="img-fluid">
            <p class="lprice"><b>NGN <?= $product['price'];?></b></p>
            <p class="desc"> <?= $product['description'];?></p>
            <p class="brand"> <?= $product['brandname'];?></p>
        </div>
        <?php
            }
        }
        ?>
    </div>
    </body>