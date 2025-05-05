<?php
require('../model/database.php');
require('../model/technician_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_technicians';
    }
}

switch ($action) {
	case 'under_construction':
		include('../under_construction.php');
		break;
	case 'list_technicians':
		$technicians = get_technicians();
		include('technician_list.php');
		break;
	case 'show_add_form':
		// Display the add technician page.
		include('technician_add.php');
		break;

	case 'add_technician':
		$firstName = filter_input(INPUT_POST, 'firstName');
		$lastName = filter_input(INPUT_POST, 'lastName');
		$email = filter_input(INPUT_POST, 'email');
		$phone = filter_input(INPUT_POST, 'phone');
		$password = filter_input(INPUT_POST, 'password');
    
		if ( empty($firstName) || empty($lastName) || empty($email) || $email == FALSE || empty($phone) || empty($password)) {
			$error = "Invalid technician data. Please check feilds and try again.";
			include('../errors/error.php');
		}else{
		add_technician($firstName, $lastName, $email, $phone, $password);
		header("Location: .");
		}
		break;

	case 'delete_technician':
		$firstName = filter_input(INPUT_POST, 'firstName');
            
		if (empty($firstName)) {
			$error = "Invalid technician data. Check all feilds and try again";
			include('../errors/error.php');
		}else{
			delete_technician($firstName);
			header("Location: .");
		}
		break;
	default:
		include('under_construction.php');
		break;
}
?>