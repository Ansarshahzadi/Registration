<?php
include('includes/config.php');

$id = $_GET['id'] ?? 0;

$query = "SELECT * FROM students WHERE id = $id";
$result = mysqli_query($cn, $query);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    echo "Student not found!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Student</title>
  <link rel="stylesheet" href="assets/css/app.min.css">
</head>
<body>
  <div class="container mt-4">
    <h2>View Student Profile</h2>
    <table class="table table-bordered">
      <?php foreach($student as $key => $value): ?>
        <tr>
          <th><?php echo ucwords(str_replace('_',' ',$key)); ?></th>
          <td><?php echo $value; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <a href="index.php" class="btn btn-primary">Back</a>
  </div>
</body>
</html>
