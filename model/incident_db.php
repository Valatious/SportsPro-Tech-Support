<?php
// Function to get customer by email
function get_customer_by_email($email) {
    global $db;
    $query = 'SELECT * FROM customers WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetchAll();
    $statement->closeCursor();
    
    if ($customer === FALSE) { // No email found for customer.
        return NULL;
    } else {
        return $customer;
    }
}

// Function to get products registered by a customer
function get_products_by_customer($customer_id) {
    global $db;
    // Correcting the placeholder to match the bind value
    $query = 'SELECT p.productCode, p.name
              FROM products p
              JOIN incidents i ON p.productCode = i.productCode
              WHERE i.customerID = :customer_id';
    $statement = $db->prepare($query);
    // Ensure the parameter name matches the placeholder
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

// Function to add a new incident to the database
function add_incident($customer_id, $product_code, $title, $description) {
    global $db;
    $query = 'INSERT INTO incidents (customerID, productCode, title, description, dateOpened)
              VALUES (:customer_id, :product_code, :title, :description, NOW())';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customer_id);
    $statement->bindValue(':productCode', $product_code);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}
?>