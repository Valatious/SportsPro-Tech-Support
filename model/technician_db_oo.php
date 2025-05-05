<?
class TechnicianDB {
    function get_technicians() {
        global $db;
        $query = 'SELECT * FROM technicians';
        $statement = $db->prepare($query);
        $statement->execute();
        $products = $statement->fetchAll();
        $statement->closeCursor();
        return $products;
    }
    function add_technician($firstName, $lastName, $email, $phone, $password) {
        global $db;
        $query = 'INSERT INTO technicians
                    (firstName, lastName, email, phone, password)
                    VALUES
                        (:firstName, :lastName, :email, :phone, :password)';
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $statement->closeCursor();
    }
    function delete_technicians($technician_id) {
        global $db;
        $query = 'DELETE FROM technicians WHERE techID=:technician_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':technician_id', $technician_id);
        $statement->execute();
        $statement->closeCursor();
    }
}
?>