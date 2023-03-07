<?php
    //var_dump($_COOKIE['cards']);
    $setProducts = $_COOKIE['cards'];
    json_decode($setProducts, true);
    var_dump($setProducts);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
<?php
foreach ($setProducts as $index => $product) {
    ?>
    <h5 class="card-title"><?php echo $product["name"]; ?></h5>
    <p class="card-text">$<?php echo $product["price"]; ?></p>
    <br><br>
    <?php
}
?>
</body>
</html>
