<?php
include('includes/config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'] ?? null;

    // ---------------------------
    // BULK CSV UPLOAD HANDLER
    // ---------------------------
    if (isset($_FILES['students_csv']) && $_FILES['students_csv']['size'] > 0) {

        $file = fopen($_FILES['students_csv']['tmp_name'], 'r');
        fgetcsv($file); // skip header

        while (($row = fgetcsv($file)) !== FALSE) {

            $student_name = $row[0] ?? '';
            $father_name  = $row[1] ?? '';
            $class_name   = $row[2] ?? '';
            $session_year = $row[3] ?? '';
            $dob          = $row[4] ?? '';
            $gender       = $row[5] ?? '';
            $student_cnic = $row[6] ?? '';
            $father_cnic  = $row[7] ?? '';
            $address      = $row[8] ?? '';
            $obtained_marks = $row[9] ?? '';
            $total_marks = $row[10] ?? '';
            $caste        = $row[11] ?? '';
            $language     = $row[12] ?? '';
            $phone        = $row[13] ?? '';
            $transport    = $row[14] ?? '';
            $rent         = $row[15] ?? '';
            $stop_point   = $row[16] ?? '';
            $status       = $row[17] ?? 'active'; // default active
            $picture_path = ''; // no pictures in bulk CSV

            $query = "INSERT INTO students 
                (student_name, father_name, class_name, session_year, dob, gender,student_cnic, father_cnic, address, obtained_marks, total_marks, caste, language, phone, transport, rent, stop_point, picture, status)
                VALUES 
                ('$student_name','$father_name','$class_name','$session_year','$dob','$gender','$student_cnic','$father_cnic','$address', '$obtained_marks', '$total_marks', '$caste','$language','$phone','$transport','$rent','$stop_point','$picture_path', '$status')";

            mysqli_query($cn, $query);
        }

        fclose($file);

        header("Location: index.php?bulk_success=1");
        exit();
    }

    // ---------------------------
    // SINGLE STUDENT INSERT/UPDATE
    // ---------------------------
    $student_name = $_POST['student_name'] ?? '';
    $father_name = $_POST['father_name'] ?? '';
    $class_name = $_POST['class_name'] ?? '';
    $session_year = $_POST['session_year'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $student_cnic = $_POST['student_cnic'] ?? '';
    $father_cnic = $_POST['father_cnic'] ?? '';
    $address = $_POST['address'] ?? '';
    $obtained_marks = $_POST['obtained_marks'] ?? '';
    $total_marks = $_POST['total_marks'] ?? '';
    $caste = $_POST['caste'] ?? '';
    $language = $_POST['language'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $transport = $_POST['transport'] ?? '';
    $rent = $_POST['rent'] ?? '';
    $stop_point = $_POST['stop_point'] ?? '';
    $status = $_POST['status'] ?? 'active'; // default active

    // ---------------------------
    // IMAGE UPLOAD
    // ---------------------------
    $picture_path = "";
    if (!empty($_FILES['student_picture']['name'])) {
        $img_name = time() . "_" . $_FILES['student_picture']['name'];
        $img_tmp = $_FILES['student_picture']['tmp_name'];
        $folder = "uploads/" . $img_name;
        move_uploaded_file($img_tmp, $folder);
        $picture_path = $img_name;
    }
    
    // ---------------------------
    // STATUS UPDATE HANDLER (AJAX or FORM)
    // ---------------------------
    if (isset($_POST['status_update']) && isset($_POST['student_id'])) {
        $student_id = (int)$_POST['student_id'];
        $status_new = $_POST['status'] === 'active' ? 'active' : 'inactive';
        $query = "UPDATE students SET status='$status_new' WHERE id=$student_id";
        mysqli_query($cn, $query);

        // JSON response for AJAX
        if (isset($_POST['ajax']) && $_POST['ajax'] == 1) {
            echo json_encode(['success' => true, 'status' => $status_new]);
            exit;
        }
        header("Location: index.php");
        exit;
    }

    // ---------------------------
    // INSERT OR UPDATE LOGIC
    // ---------------------------
    if ($id) {
        // UPDATE QUERY
        $query = "UPDATE students SET 
            student_name='$student_name',
            father_name='$father_name',
            class_name='$class_name',
            session_year='$session_year',
            dob='$dob',
            gender='$gender',
            student_cnic= '$student_cnic',
            father_cnic='$father_cnic',
            address='$address',
            obtained_marks= '$obtained_marks',
            total_marks= '$total_marks',
            caste='$caste',
            language='$language',
            phone='$phone',
            transport='$transport',
            rent='$rent',
            stop_point='$stop_point',
            status= '$status'";

        if ($picture_path != "") {
            $query .= ", picture='$picture_path'";
        }

        $query .= " WHERE id=$id";

        mysqli_query($cn, $query);
        header("Location: form-validation.php?updated=1");
        exit();
    } else {
        // INSERT QUERY
        $query = "INSERT INTO students 
            (student_name, father_name, class_name, session_year, dob, gender,student_cnic, father_cnic, address, obtained_marks, total_marks, caste, language, phone, transport, rent, stop_point, picture, status)
            VALUES 
            ('$student_name','$father_name','$class_name','$session_year','$dob','$gender','$student_cnic','$father_cnic','$address', '$obtained_marks', '$total_marks', '$caste','$language','$phone','$transport','$rent','$stop_point','$picture_path', '$status')";

        mysqli_query($cn, $query);
        header("Location: index.php?success=1");
        exit();
    }
}
?>
