<?php
session_set_cookie_params(0);
session_start();
// require files from the model folder for the general database.php connection_aborted
// as well as the customer, product, and new registration_db.php files.
require('../model/database.php');
require('../model/registration_db.php');
require('../model/customer_db.php');
require('../model/product_db.php');

// Set up a default action
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        if (isset($_SESSION['customer'])) {
			$action = 'show_register_product';
		} else {
			$action = 'login_customer';
		}
    }
}

// Instantiate variable(s)
// Set up one empty string variable for $email
// This is so no error will be thrown on the customer_login page
$email = '';

// Handle actions
if ($action == 'login_customer') {
    // Default action should ONLY show 'include()' the customer_login.php page. No POST, No GET, No variables
    include('customer_login.php');
} 
else if ($action == 'get_customer') {
    $email = $_POST['email']; // Gets email from post.
    
    // Validate the email format.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
        include('../errors/error.php'); // Include the error page
        exit(); // Stops further execution..
    }
    
    // Call the db function to check if the customer exists by email.
    $customer = get_customer_by_email($email);
    
    // Check if the customer is found.
    if ($customer === NULL) {
        $error = "Customer doesn't exist. Please try again.";
        include('../errors/error.php');
        exit();
    }
	
	// Save customer data in the session.
	$_SESSION['customer'] = $customer;
	
	// Redirect to the show_register_product action.
	header("Location: index.php?action=show_register_product");
	exit();
}
else if ($action == 'show_register_product') {
	$customer = $_SESSION['customer'];
	
	// If the customer is found, get the product list.
    $products = get_products(); // Call the DB to get the product list.
    
    // Include the product_register page.
    include('product_register.php');
}
else if ($action == 'register_product') {
	$customer = $_SESSION['customer'];
    $customer_id = $customer['customer_id'];
    $product_code = $_POST['product_code'];
    
    // Validate the customer_id.
    if (!filter_var($customer_id, FILTER_VALIDATE_INT)) {
        $error = 'Invalid customer ID.';
        include('../errors/error.php');
        exit();
    }
    
    // Check if the product is already registered for this customer.
    $registration = get_registration($customer_id, $product_code);
    
    // If no active registration found, proceed to register the product.
    if ($registration == NULL) {
        // Register the product for the customer
        $result = add_registration($customer_id, $product_code);
        
        // Check if the product was successfully registered.
        if ($result) {
            // Redirect with success message.
            header("Location: index.php?action=success&product_code=$product_code");
            exit();
        } else {
            // If there was an issue registering the product, show an error.
            $error = "Could not register the product $product_code.";
            include('../errors/error.php');
            exit();
        }
    } else {
        // If the product is already registered for the customer, show an error.
        $error = "This product is already registered for this customer.";
        include('../errors/error.php');
        exit();
    }
} 
else if ($action == 'success') {
    // Grab product code from GET and assign to a variable
    $product_code = filter_input(INPUT_GET, 'product_code', FILTER_SANITIZE_STRING);

    // Create a success message
    $message = "The product with code $product_code has been successfully registered.";

    // Include the 'product_register.php' page with a success message
    include('product_register.php');
}
else if ($action == 'logout') {
	// Destroy the session
	session_unset();
	session_destroy();
	
	// Redirect to login page.
	header('Location: index.php?action=login_customer');
	exit();
}
?>