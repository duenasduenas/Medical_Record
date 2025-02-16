<?php include 'db.php'; ?>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $delete_patient  = filter_input(INPUT_POST, "delete_patient", FILTER_SANITIZE_SPECIAL_CHARS);
    $delete_query = "DELETE FROM medical_records WHERE patient_id = $1";
    $delete_result = pg_query_params($connection, $delete_query, array($delete_patient));

    if (!$delete_result) {
        echo "Error deleting patient: " . pg_last_error($connection);
    } else {
        echo "RECORD DELETED";
    }
}
?>