<?php
function validate_text($input, $required = true, $min = 1, $max = 255) {
    if ($required && empty($input)) {
        return "This field is required.";
    }
    $length = strlen($input);
    if ($length < $min || $length > $max) {
        return "Must be between $min and $max characters.";
    }
    return '';
}

function validate_phone($phone) {
    if (!preg_match('/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/', $phone)) {
        return "Invalid phone format. Expected format: 123-456-7890";
    }
    return '';
}

function validate_email($email) {
    if (!preg_match('/^[\w\.-]+@[\w\.-]+\.\w{2,6}$/', $email)) {
        return "Invalid email address.";
    }
    return '';
}
?>