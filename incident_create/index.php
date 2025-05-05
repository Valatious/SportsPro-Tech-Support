<?php
// require files from the model folder for the general "database.php" 
// as well as the customer, product, and new "incident_db.php" files.
require('../model/database.php');
require('../model/incident_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'display_customer_get';
    }
}

//instantiate variable(s)
$email = '';

if ($action == 'display_customer_get') {
    include('customer_get.php'); // Only include 'customer_get.php'
} 
else if ($action == 'get_customer') {
    // Get email from login form  POST and save it to a the above instantiated variable.
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    
    if (empty($email) || $email == FALSE) {
        // If validation fails, create the error message and include the error.php.
        $error = "Please enter a valid email address.";
        include('error.php');
        exit();
    }
    
    // Call DB function 'get_customer_by_email($email)' and pass in the email address.
    $customer = get_customer_by_email($email);
    
    if ($customer == FALSE) {
        // No customer with the email found in the DB.
        $error = "No customer found with this email.";
        include('error.php');
        exit();
    } else {
        // Save the results to a variable.
        $products = get_products_by_customer($email);
        
        // Include the 'incident_create.php' page for incident creation.
        include('incident_create.php');
    }
    
} 
else if ($action == 'create_incident') {
    // Get 4 POST inputs: customer_id, product_code, title, and description.
    $customer_id = filter_input(INPUT_POST, 'customerID');
    $product_code = filter_input(INPUT_POST, 'productCode');
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    
    // Write validation to ensure all info is filled out.
    if (empty($product_code) || empty($title) || empty($description)) {
        $error = "Please fill in all fields.";
        include('error.php');
        exit();
    }
    
    $incident_added = add_incident($customer_id, $product_code, $title, $description);
    
    if (incident_added) {
        // Redirect back to index.php with query string.
        header("Location: index.php?action==success");
        exit();
    } else {
        $error = "There was an error creating the incident.";
        include('error.php');
        exit();
    }
} 
else if ($action == 'success') {
    // Create a sucssess $message.
    $message = "Incident created successfully.";
    include('incident_create.php');
}
?>