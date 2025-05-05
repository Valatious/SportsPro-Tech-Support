<?php
function get_all_countries() {
    global $db;
    $query = 'SELECT countryCode, countryName FROM countries ORDER BY countryName';
    $statement = $db->prepare($query);
    $statement->execute();
    $countries = $statement->fetchAll();
    $statement->closeCursor();
    return $countries;
}
?>