<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// Show all error messages
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function pre_r( $array ) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    pre_r($_GET);
    echo '<h2>$_POST</h2>';
    pre_r($_POST);
    // echo '<h2>$_COOKIE</h2>';
    // pre_r($_COOKIE);
    // echo '<h2>$_SESSION</h2>';
    // pre_r($_SESSION);
}
whatIsHappening();

// Provide some products (you may overwrite the example)
$products = [
    ['name' => 'Panda Mug', 'price' => 12],
    ['name' => 'Seal Mug', 'price' => 12],
    ['name' => 'Unicorn Mug', 'price' => 13],
    ['name' => 'Cow Mug', 'price' => 12],
    ['name' => 'Beans Mug', 'price' => 11.5],
    ['name' => 'Chalk Mug', 'price' => 9],
    ['name' => 'Ctrl-Alt-Del Mugset', 'price' => 16],
    ['name' => 'Anti Theft Mug', 'price' => 8.5],
];

$totalValue = 0;

function validate()
{
    // This function will send a list of invalid fields back
    $invalidFields = [];

    if (empty($_POST["email"])) {
        array_push($invalidFields, "email");
    }
    if (empty($_POST["street"])) {
        array_push($invalidFields, "street");
    }
    if (empty($_POST["streetnumber"])) {
        array_push($invalidFields, "streetnumber");
    }
    if (empty($_POST["city"])) {
        array_push($invalidFields, "city");
    }
    if (empty($_POST["zipcode"])) {
        array_push($invalidFields, "zipcode");
    }
    if (empty($_POST["products"])) {
        array_push($invalidFields, "products");
    }
    // pre_r($invalidFields);
    // return the updated array with all invalid fields 
    return $invalidFields;
    
}

function handleForm()
{
    // TODO: form related tasks (step 1)

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
        foreach ($invalidFields as $field) {
            if ($field === "products") {
                echo    
                    '<div class="alert alert-danger" role="alert">
                    Please select at least 1 product!
                    </div> ';
            } else {
            echo
                "<div class='alert alert-danger' role='alert'>
                Please enter your $field !
                </div> ";
            }
            
        }
    } else {
        // TODO: handle successful submission
        echo "<div class='alert alert-success' role='alert'>
                Your order has been successfully submitted <br>";
        foreach ($_POST as $field) {
            if (is_array($field)){
                echo "Your order: <br>";
                yourProducts();
            } else {
                echo "Your $field <br>";
            }
        };
        echo "</div>";
    }
}

function yourProducts() {
    global $products;

    foreach ($_POST['products'] as $i => $mug) {
        if ($mug === "1") {
            echo "* " . $products[$i]['name'] . "<br>";
        }
    }
}

// TODO: replace this if by an actual check
// $formSubmitted = false;
// if (!empty($_POST)) {
//     handleForm();
// }

require 'form-view.php';