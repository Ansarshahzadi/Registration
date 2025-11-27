<?php
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'] ?? null;

    // ---------------------------
    // BULK CSV UPLOAD HANDLER
    // ---------------------------
    if (isset($_FILES['students_csv']) && $_FILES['students_csv']['size'] > 0) {

        $file = fopen($_FILES['students_csv']['tmp_name'], 'r');

        // Optional: skip header row if your CSV has headers
        fgetcsv($file);

        while (($row = fgetcsv($file)) !== FALSE) {

            $student_name = $row[0] ?? '';
            $father_name  = $row[1] ?? '';
            $class_name   = $row[2] ?? '';
            $session_year = $row[3] ?? '';
            $dob          = $row[4] ?? '';
            $gender       = $row[5] ?? '';
            $student_cnic  = $row[6] ?? '';
            $father_cnic  = $row[6] ?? '';
            $address      = $row[7] ?? '';
            $caste        = $row[8] ?? '';
            $language     = $row[9] ?? '';
            $phone        = $row[10] ?? '';
            $transport    = $row[11] ?? '';
            $rent         = $row[12] ?? '';
            $stop_point   = $row[13] ?? '';
            $picture_path = ''; // No pictures in bulk CSV

            $query = "INSERT INTO students 
                (student_name, father_name, class_name, session_year, dob, gender,student_cnic, father_cnic, address, caste, language, phone, transport, rent, stop_point, picture)
                VALUES 
                ('$student_name','$father_name','$class_name','$session_year','$dob','$gender',$student_cnic,'$father_cnic','$address','$caste','$language','$phone','$transport','$rent','$stop_point','$picture_path')";
            
            mysqli_query($cn, $query);
        }

        fclose($file);

        header("Location: index.php?bulk_success=1");
        exit();
    }

    // ---------------------------
    // SINGLE STUDENT INSERT/UPDATE
    // ---------------------------
    $student_name = $_POST['student_name'];
    $father_name = $_POST['father_name'];
    $class_name = $_POST['class_name'];
    $session_year = $_POST['session_year'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $student_cnic=$_POST['student_cnic'];
    $father_cnic = $_POST['father_cnic'];
    $address = $_POST['address'];
    $caste = $_POST['caste'];
    $language = $_POST['language'];
    $phone = $_POST['phone'];
    $transport = $_POST['transport'];
    $rent = $_POST['rent'];
    $stop_point = $_POST['stop_point'];

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
            student_cnic='$student_cnic',
            father_cnic='$father_cnic',
            address='$address',
            caste='$caste',
            language='$language',
            phone='$phone',
            transport='$transport',
            rent='$rent',
            stop_point='$stop_point'";

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
            (student_name, father_name, class_name, session_year, dob, gender,student_cnic, father_cnic, address, caste, language, phone, transport, rent, stop_point, picture)
            VALUES 
            ('$student_name','$father_name','$class_name','$session_year','$dob','$gender','$student_cnic','$father_cnic','$address','$caste','$language','$phone','$transport','$rent','$stop_point','$picture_path')";

        mysqli_query($cn, $query);
        header("Location: index.php?success=1");
        exit();
    }
}
?>
