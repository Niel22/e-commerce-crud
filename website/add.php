<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ecommerce';

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection error" . $conn->connect_error);
}

if($_GET['title']){
    $stmt = $conn->prepare('SELECT * FROM products WHERE title = ?');
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
    <table class="table">
        <tr>
            <td>PRODUCTS</td>
            <td>NAME</td>
            <td>PRICE</td>
            <td></td>
        </tr>
        <?php
        while($product = $result->fetch_assoc()){
        ?>
        <tr class="">
            <td><img src="<?= $product['image'];?>" width="50px" alt="<?= $product['title'];?>"></td>
            <td><?= $product['title'];?></td>
            <td><?= $product['price'];?></td>
            <td>
            <a href="delete.php?title=<?= $product['title'];?>">
                <button type="button" class="btn btn-danger" data-toggle='modal' data-target='#details-1'>Remove item</button>
            </a>
            </td>
        </tr>
        <?php
        }
    }else{
        echo "<tr colspan='4'>Empty Cart</tr>";
    }
}
        ?>
    </table>
</body>
</html>