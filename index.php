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

if (!empty($_POST)) {
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["street"] = $_POST["street"];
    $_SESSION["streetnumber"] = $_POST["streetnumber"];
    $_SESSION["city"] = $_POST["city"];
    $_SESSION["zipcode"] = $_POST["zipcode"];
}

// Use this function when you need to need an overview of these variables
function pre_r( $array ) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function whatIsHappening() {
    // echo '<h2>$_GET</h2>';
    // pre_r($_GET);
    // echo '<h2>$_POST</h2>';
    // pre_r($_POST);
    // echo '<h2>$_COOKIE</h2>';
    // pre_r($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    pre_r($_SESSION);
}
// whatIsHappening();

// Provide some products (you may overwrite the example)
$products = [
    ['name' => 'Panda Mug', 'price' => 12, 'image' => './images/Panda-Mug.jpg'],
    ['name' => 'Seal Mug', 'price' => 12, 'image' => './images/Seal-Mug.jpg'],
    ['name' => 'Unicorn Mug', 'price' => 13, 'image' => './images/Unicorn-Mug.jpg'],
    ['name' => 'Cow Mug', 'price' => 12, 'image' => './images/Cow-Mug.jpg'],
    ['name' => 'Beans Mug', 'price' => 11.5, 'image' => './images/Beans-Mug.jpg'],
    ['name' => 'Chalk Mug', 'price' => 9, 'image' => './images/Chalk-Mug.jpg'],
    ['name' => 'Ctrl-Alt-Del Mugset', 'price' => 16, 'image' => './images/CtrlAltDel-Mugs.jpg'],
    ['name' => 'Anti Theft Mug', 'price' => 8.5, 'image' => './images/Anti-Theft-Mug.jpg'],
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

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function handleForm($products)
{
    // TODO: form related tasks (step 1)
    echo "<br/>";
    // Validation (step 2)
    $invalidFields = validate();

    $email = test_input($_POST["email"]);

    if (!empty($invalidFields)) {
        // TODO: handle errors
        $message = '<div class="alert alert-danger text-center" role="alert">';
        foreach ($invalidFields as $field) {
            if ($field === "products") {
                $message .= "Please select at least 1 product! <br/>";
            } else {
                $message .= "Please enter your $field <br/>";
            }
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message .= "Invalid email format ";
        }
        $message .= '</div>';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<div class="alert alert-danger text-center" role="alert">
            Invalid email format 
            </div>';
    }
    else {
        // TODO: handle successful submission
        $message = "<div class='alert alert-info text-center' role='alert'>
                <h2>Your order has been successfully submitted</h2>";
        foreach ($_POST as $x => $field) {
            // pre_r($_POST);
            // pre_r($x);
            // pre_r($field);
            if (is_array($field)){
                $message .= "<br><h4>Your order: </h4>";
                $message .= yourProducts($products);
            } else {
                // setcookie($x, $field, time() + (60*60*60), "/");
                $message .= "Your $x : <i>$field</i> <br>";
            }
        }
        $message .= "</div>";
    }
    return $message;
}

function yourProducts($products) {
    $orderedProductList = '';
    foreach ($_POST['products'] as $i) {
        $orderedProductList .= "* " . $products[$i]['name'] . "<br>";
    }
    return $orderedProductList;
}

function calculateTotalPrice($products) {
    $totalPrice = 0;
    if (!empty($_POST['products'])) {
        
        foreach ($_POST['products'] as $i) {
            $totalPrice += $products[$i]['price'];
        }
    }
    return $totalPrice;
}
// TODO: replace this if by an actual check
$formSubmitted = !empty($_POST);
if ($formSubmitted) {
    $message = handleForm($products);
}

require 'form-view.php';