<?php include "db.php" ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical History</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
        <label for="">Patient Name</label>
        <input type="text" name="patient_name" required>

        <label for="">Subjective</label>
        <input type="text" name="subjective" required>

        <label for="">Objective</label>
        <input type="text" name="objective" required>

        <label for="">Assessment</label>
        <input type="text" name="assessment" required>

        <label for="">Plan</label>
        <input type="text" name="plan" required>

        <label for="">Date</label>
        <input type="date" name="date" required>

        <input type="submit">
    </form>
</body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = filter_input(INPUT_POST, "patient_name",FILTER_SANITIZE_SPECIAL_CHARS );
    $subjective = filter_input(INPUT_POST, "subjective", FILTER_SANITIZE_SPECIAL_CHARS);
    $objective = filter_input(INPUT_POST, "objective",FILTER_SANITIZE_SPECIAL_CHARS );
    $assessment = filter_input(INPUT_POST, "assessment", FILTER_SANITIZE_SPECIAL_CHARS);
    $plan = filter_input(INPUT_POST, "plan", FILTER_SANITIZE_SPECIAL_CHARS);
    $date = filter_input(INPUT_POST, "date", FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$connection) {
        echo "ERROR: Database connection failed";
    } else {
        $query = "INSERT INTO medical_records(patient_data,date) VALUES ($1, $2)";

        if (!empty($patient_name) && !empty($date) && !empty($objective) && !empty($assessment) && !empty($plan)) {
            $patient_data = json_encode(['info' => $patient_name, 'objective' => $objective, 'subjective' => $subjective, 'plan' => $plan]);
            $result = pg_query_params($connection, $query, array($patient_data, $date));

            if (!$result) {
                echo "ERROR: Data insertion failed";
            } else {
                echo "Data inserted successfully";
            }
        } else {
            echo "Please fill all fields";
        }
    }
}



?>