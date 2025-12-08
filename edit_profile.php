<?php
include('includes/config.php');

$id = $_GET['edit_id'] ?? 0;

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
  <title>Edit Student</title>
  <link rel="stylesheet" href="assets/css/app.min.css">
</head>
<body>
  <div class="container mt-4">
    <h2>Edit Student</h2>
    <form action="form-validation-handler.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
      <div class="mb-3 col-4">
        <label>Student Name</label>
        <input type="text" name="student_name" value="<?php echo $student['student_name']; ?>" class="form-control">
      </div>
      <div class="mb-3 col-4">
        <label>Father Name</label>
        <input type="text" name="father_name" value="<?php echo $student['father_name']; ?>" class="form-control">
      </div>
      <!-- Add other fields similarly -->
      <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
          <option value="active" <?php echo $student['status']=='active'?'selected':''; ?>>Active</option>
          <option value="inactive" <?php echo $student['status']=='inactive'?'selected':''; ?>>Inactive</option>
        </select>
      </div>
      <button type="submit" class="btn btn-success">Update</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>
</html>
