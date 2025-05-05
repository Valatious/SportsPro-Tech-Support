<?php
require('../model/database.php');
require('../model/customer_db.php');
require('../model/countries_db.php');
require('validation.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
	$action = filter_input(INPUT_GET, 'action');
	if ($action === NULL) {
		$action = 'search_customers';
    }
}
$last_name = '';
$customers = NULL;

switch ($action) {
    case 'search_customers':
	include('customer_search.php');
	break;
    case 'display_customers':
	$last_name = filter_input(INPUT_POST, 'last_name');
	if (empty($last_name)) {
		$message = 'Last name required. Please try again.';
	} else {
            $customers = get_customers_by_last_name($last_name);
	}
            include('customer_search.php');
            break;

    case 'display_customer':
		$customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
		$customer = get_customer($customerID);
		$countries = get_all_countries(); // Gets countries for the dropdown menu.
		include('customer_display.php');
		break;
	
    case 'update_customer':
		$customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
		$first_name = filter_input(INPUT_POST, 'first_name');
		$last_name = filter_input(INPUT_POST, 'last_name');
		$address = filter_input(INPUT_POST, 'address');
		$city = filter_input(INPUT_POST, 'city');
		$state = filter_input(INPUT_POST, 'state');
		$postal_code = filter_input(INPUT_POST, 'postal_code');
		$country_code = filter_input(INPUT_POST, 'country_code');
		$phone = filter_input(INPUT_POST, 'phone');
		$email = filter_input(INPUT_POST, 'email');
		$password = filter_input(INPUT_POST, 'password');

		// Validation
		$error_messages = [];
		$error_messages['first_name'] = validate_text($first_name, true, 1, 50);
		$error_messages['last_name'] = validate_text($last_name, true, 1, 50);
		$error_messages['address'] = validate_text($address, true, 1, 100);
		$error_messages['city'] = validate_text($city, true, 1, 50);
		$error_messages['state'] = validate_text($state, true, 2, 2);
		$error_messages['postal_code'] = validate_text($postal_code, true, 5, 10);
		$error_messages['phone'] = validate_phone($phone);
		$error_messages['email'] = validate_email($email);
		$error_messages['password'] = validate_text($password, true, 6, 255);

		$has_errors = false;
		foreach ($error_messages as $error) {
			if (!empty($error)) {
				$has_errors = true;
				break;
			}
		}

		if ($has_errors) {
			$customer = [
				'customerID' => $customerID,
                'firstName' => $first_name,
                'lastName' => $last_name,
                'address' => $address,
                'city' => $city,
                'state' => $state,
                'postalCode' => $postal_code,
                'countryCode' => $country_code,
                'phone' => $phone,
                'email' => $email,
                'password' => $password
			];
			$countries = get_all_countries();
			include('customer_display.php');
		} else {
			update_customer($customerID, $first_name, $last_name, $address, $city,
					$state, $postal_code, $country_code, $phone, $email, $password);
    
			header("Location: .");
		}
		break;
		
    default:
	include('customer_search.php');
	break;
}
?>