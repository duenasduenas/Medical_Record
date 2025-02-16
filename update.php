<?php include 'db.php';
?>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update_patient = filter_input(INPUT_POST,'update_patient', FILTER_SANITIZE_NUMBER_INT);
    $update_name = filter_input(INPUT_POST, "update_name",FILTER_SANITIZE_SPECIAL_CHARS );
    $update_sub = filter_input(INPUT_POST, "update_sub", FILTER_SANITIZE_SPECIAL_CHARS);
    $update_obj = filter_input(INPUT_POST, "update_obj",FILTER_SANITIZE_SPECIAL_CHARS );
    $update_ass= filter_input(INPUT_POST, "update_ass", FILTER_SANITIZE_SPECIAL_CHARS);
    $update_plan = filter_input(INPUT_POST, "update_plan", FILTER_SANITIZE_SPECIAL_CHARS);
    $update_date = filter_input(INPUT_POST, "update_date", FILTER_SANITIZE_SPECIAL_CHARS);

    // Ensure the connection is established
    if (!$connection) {
        echo "ERROR: Database connection failed";// Stop execution if connection fails
    } else {
        // Prepare the update query
        $update_query = "UPDATE medical_records SET patient_data = $1 WHERE patient_id = $2";
        pg_prepare($connection, "update_patient_query", $update_query); // Prepare the statement

        if (!empty($update_name) &&  !empty($update_sub) &&  !empty($update_date) && !empty($update_obj) && !empty($update_ass) && !empty($update_plan)) {
            $patient_data = json_encode(['info' => $update_name, 'subjective' => $update_sub, 'objective' => $update_obj, 'assessment' => $update_ass, 'plan' => $update_plan, 'date' => $update_date]);
            
            // Execute the statement
            $result = pg_execute($connection, "update_patient_query", array($patient_data, $update_patient));
            if ($result) {
                echo "Record updated successfully.";
            } else {
                echo "ERROR: Could not execute query: $update_query. " . pg_last_error($connection);
            }
        }
    }
}
?>