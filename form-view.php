<?php // This file is mostly containing things for your view / html ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
        rel="stylesheet"/>
    <title>Mugsly</title>
</head>
<body>
<div class="container">
    <?php if ($formSubmitted) {
            handleForm($products);
            } ?>
    <h1>Place your order</h1>
    <?php // Navigation for when you need it ?>
    <?php /*
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    */ ?>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Example@example.com"
                value="<?php if (isset($_SESSION["email"])) {echo $_SESSION["email"];}?>"/>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" placeholder="Lafayette street"
                    value="<?php if (isset($_SESSION["street"])) {echo $_SESSION["street"];}?>"/>

                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" placeholder="123"
                    value="<?php if (isset($_SESSION["streetnumber"])) {echo $_SESSION["streetnumber"];}?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" placeholder="Ghent"
                    value="<?php if (isset($_SESSION["city"])) {echo $_SESSION["city"];}?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" placeholder="9000"
                    value="<?php if (isset($_SESSION["zipcode"])) {echo $_SESSION["zipcode"];}?>">
                </div>
            </div>
        </fieldset>

        <fieldset class="productsSection">
            <legend class="productLegend">Products</legend>
            <?php foreach ($products as $i => $product): ?>
                <label>
                    <input type="checkbox" value="<?= $i ?>" name="products[<?= $i ?>]"/>
                    <img class="mugImages" src="<?= $product['image'] ?>">
                    <?= $product['name'] ?> <br>
                    &euro; <?= number_format($product['price'], 2) ?> 
                    
                </label>
            <?php endforeach; ?>
        </fieldset>

        <button type="submit" class="btn btn-primary submitBtn">Order!</button>
    </form>

    
</div>
<footer>You have only ordered for <strong>&euro; <?= calculateTotalPrice($products) ?></strong> in cups. You really think that's enough?</footer>
<style>
    body {
        background-color: #E5E3C9;
    }
    .productsSection {
        text-align: center;
        padding: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fill, 200px);
        background-color: #B4CFB0;
        border-radius: 20px;
    }
    .productLegend {
        padding-top: 40px;
    }

    .mugImages {
        width:150px;
        height:160px;
        border-radius: 10px;
    }
    .submitBtn {
        margin: 20px 0px;
    }
    footer {
        background-color: #789395;
        text-align: center;
        padding: 20px;
    }
</style>
</body>
</html>