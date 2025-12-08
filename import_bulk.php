<?php
include('includes/config.php');

$response = ['success' => false];

if (isset($_FILES['students_csv']) && $_FILES['students_csv']['error'] === 0) {

    $file = $_FILES['students_csv']['tmp_name'];
    $handle = fopen($file, "r");

    if ($handle !== false) {
        $row = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $row++;

            // Skip header row
            if ($row == 1) continue;

            // Map CSV columns to variables
            // Remove ID from CSV. Adjust indexes according to your CSV columns
            $student_name   = $data[1];
            $father_name    = $data[2];
            $class_name     = $data[3];
            $session_year   = $data[4];
            $dob            = $data[5];
            $gender         = $data[6];
            $student_cnic   = $data[7];
            $father_cnic    = $data[8];
            $address        = $data[9];
            $caste          = $data[10];
            $language       = $data[11];
            $phone          = $data[12];
            $transport      = $data[13];
            $rent           = $data[14];
            $stop_point     = $data[15];
            $status         = $data[16] ?? 'active'; // default status if not in CSV

            // Prepare insert query
            $stmt = $cn->prepare("INSERT INTO students (student_name, father_name, class_name, session_year, dob, gender, student_cnic, father_cnic, address, caste, language, phone, transport, rent, stop_point, status) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssssssssss", $student_name, $father_name, $class_name, $session_year, $dob, $gender, $student_cnic, $father_cnic, $address, $caste, $language, $phone, $transport, $rent, $stop_point, $status);
            $stmt->execute();
        }
        fclose($handle);

        $response['success'] = true;
    } else {
        $response['error'] = "Failed to open CSV file.";
    }

} else {
    $response['error'] = "No file uploaded or upload error.";
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
