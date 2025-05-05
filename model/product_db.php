<?php
function get_products() {
    global $db;
    $query = 'SELECT * FROM products';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}
function add_product(string $code, string $name, float $version, string $release_date) {
    global $db;
    $query = 'INSERT INTO products
                (productCode, name, version, releaseDate)
                VALUES
                    (:code, :name, :version, :release_date)';
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':release_date', $release_date);
    $statement->execute();
    $statement->closeCursor();
}

function update_product(string $code, string $name, float $version, string $release_date) {
    global $db;
    $query = 'UPDATE products
              SET name = :name,
                  version = :version,
                  releaseDate = :release_date
              WHERE productCode = :product_code';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':release_date', $release_date);
    $statement->bindValue(':product_code', $code);
    $statement->execute();
    $statement->closeCursor();
}

function delete_products($code) {
    global $db;
    $query = 'DELETE FROM products WHERE productCode=:code';
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->execute();
    $statement->closeCursor();
}

function get_products_by_customer($customer_id) {
    global $db;
    $query = 'SELECT p.productCode, p.name
            FROM products p
            JOIN registration r ON p.productCode = r.productCode
            WHERE r.customerID = :customer_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customer_id);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}
?>