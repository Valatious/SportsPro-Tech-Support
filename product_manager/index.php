<?php
require('../model/database.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_products';
    }
}

if ($action == 'under_construction') {
    include('../under_construction.php');
}
else if ($action == 'list_products') {
    $products = get_products();
    include('product_list.php');
}
else if ($action == 'show_add_form') {
    // Display the add product page.
    include('product_add.php');
}
else if ($action == 'add_product') {
    $code = filter_input(INPUT_POST, 'productCode');
    $name = filter_input(INPUT_POST, 'name');
    $version = filter_input(INPUT_POST, 'version', FILTER_VALIDATE_FLOAT);
    $release_date = filter_input(INPUT_POST, 'releaseDate');
    
    if ( empty($code) || empty($name) || empty($version) || $version == FALSE || empty($release_date)) {
        $error = "Invalid product data. Please check fields and try again.";
        include('../errors/error.php');
    }else{
		try {
			$date = new DateTime($release_date);
			$formattedReleaseDate = $date->format('Y-m-d');
		} catch (Exception $e) {
			$error = "Invalid date format. Please use a valid date format.";
			include('../errors/error.php');
			exit;
		}
		
		add_product($code, $name, $version, $formattedReleaseDate);
		header("Location: .");
    }
}
else if ($action == 'delete_product') {
    $code = filter_input(INPUT_POST, 'productCode');
            
    if (empty($code)) {
        $error = "Invalid product data. Check all fields and try again";
        include('../errors/error.php');
    }else{
        delete_products($code);
        header("Location: .");
    }
}
?>