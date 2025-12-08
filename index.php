<?php
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Otika - Admin Dashboard Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <!-- Navbar start -->
      <?php include 'includes/navbar.php' ?>
      <!-- navbar end -->

      <!-- sidrbar start -->
      <?php include 'includes/leftsidebar.php' ?>
      <!-- sidebar end -->

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">

            <!-- Row of Cards -->
            <div class="row mb-4">
              <!-- Total Students Card -->
              <div class="col-md-4">
                <div class="card text-white bg-primary">
                  <div class="card-body">
                    <?php
                    $totalResult = mysqli_query($cn, "SELECT COUNT(*) as total FROM students");
                    $totalData = $totalResult ? mysqli_fetch_assoc($totalResult) : ['total' => 0];
                    ?>
                    <h5 class="card-title">Total Students</h5>
                    <h2 class="card-text"><?php echo $totalData['total']; ?></h2>
                  </div>
                </div>
              </div>

              <!-- Dropped Students Card -->
              <div class="col-md-4">
                <div class="card text-white bg-danger">
                  <div class="card-body">
                    <?php
                    $droppedResult = mysqli_query($cn, "SELECT COUNT(*) as dropped FROM students WHERE status='dropped'");
                    $droppedData = $droppedResult ? mysqli_fetch_assoc($droppedResult) : ['dropped' => 0];
                    ?>
                    <h5 class="card-title">Dropped Students</h5>
                    <h2 class="card-text"><?php echo $droppedData['dropped']; ?></h2>
                  </div>
                </div>
              </div>

              <!-- Active Students Card -->
              <div class="col-md-4">
                <div class="card text-white bg-success">
                  <div class="card-body">
                    <?php
                    $activeResult = mysqli_query($cn, "SELECT COUNT(*) as active FROM students WHERE status='active'");
                    $activeData = $activeResult ? mysqli_fetch_assoc($activeResult) : ['active' => 0];
                    ?>
                    <h5 class="card-title">Active Students</h5>
                    <h2 class="card-text"><?php echo $activeData['active']; ?></h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <!-- Card Title -->
                    <h4 class="card-title mb-0">Student Data Table</h4>

                    <!-- Buttons on the right -->
                    <div class="d-flex gap-2 mt-2">
                      <!-- Add New Student Button -->
                      <a href="form-validation.php" class="mx-2 btn btn-primary rounded">
                        + Add New Student
                      </a>

                      <!-- Import Bulk CSV Button triggers modal -->
                      <button type="button" class="btn btn-success rounded" data-bs-toggle="modal" data-bs-target="#importCsvModal">
                        Import Bulk CSV
                      </button>
                    </div>
                  </div>


                  <div class="card-body">


                    <!-- Table Responsive -->
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Class</th>
                            <th>Session</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>Student CNIC</th>
                            <th>Father CNIC</th>
                            <th>Address</th>
                            <th>Obtained Marka</th>
                            <th>Total Marks</th>
                            <th>Caste</th>
                            <th>Language</th>
                            <th>Phone #</th>
                            <th>Transport</th>
                            <th>Rent</th>
                            <th>Stop Point</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = "SELECT * FROM students ORDER BY id DESC";
                          $result = mysqli_query($cn, $query);
                          $count = 1;
                          while ($row = mysqli_fetch_assoc($result)) {
                            $statusBadge = $row['status'] == 'active' ?
                              "<span class='badge bg-success'>Active</span>" :
                              "<span class='badge bg-danger'>Inactive</span>";

                            echo "<tr>
                                        <td class='text-center'>{$count}</td>
                                        <td>{$row['student_name']}</td>
                                        <td>{$row['father_name']}</td>
                                        <td>{$row['class_name']}</td>
                                        <td>{$row['session_year']}</td>
                                        <td>{$row['dob']}</td>
                                        <td>{$row['gender']}</td>
                                        <td>{$row['student_cnic']}</td>
                                        <td>{$row['father_cnic']}</td>
                                        <td>{$row['address']}</td>
                                        <td>{$row['obtained_marks']}</td>
                                        <td>{$row['total_marks']}</td>
                                        <td>{$row['caste']}</td>
                                        <td>{$row['language']}</td>
                                        <td>{$row['phone']}</td>
                                        <td>{$row['transport']}</td>
                                        <td>{$row['rent']}</td>
                                        <td>{$row['stop_point']}</td>
                                        <td>
                                            <select class='form-select form-select-sm status-select' data-student='{$row['id']}'>
                                                <option value='active' " . ($row['status'] == 'active' ? 'selected' : '') . ">Active</option>
                                                <option value='inactive' " . ($row['status'] == 'inactive' ? 'selected' : '') . ">Inactive</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class='dropdown'>
                                                <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown'>
                                                    <i class='fas fa-ellipsis-v'></i>
                                                </button>
                                                <div class='dropdown-menu'>
                                                    <a class='dropdown-item' href='view_profile.php?id={$row['id']}'><i class='fas fa-eye'></i> View</a>
                                                    <a class='dropdown-item' href='form-validation.php?edit_id={$row['id']}'><i class='fas fa-edit'></i> Edit</a>
                                                    <a class='dropdown-item text-danger' href='delete_profile.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this record?')\"><i class='fas fa-trash-alt'></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                     </tr>";
                            $count++;
                          }
                          ?>
                        </tbody>

                      </table>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </section>
        <div class="settingSidebar">
          <?php include 'includes/rightsidebar.php' ?>
        </div>
      </div> <!-- end main section -->

      <!-- footer -->
      <footer class="main-footer">
        <div class="footer-left">
          <a href="templateshub.net">Templateshub</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer><!--end footer-->
    </div>
  </div>


  <!-- Import CSV Modal -->
  <div class="modal fade" id="importCsvModal" tabindex="-1" aria-labelledby="importCsvModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="importCsvModalLabel">Import CSV</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
          <label for="csvFile" class="form-label fw-bold">Choose CSV File</label>
          <input type="file" id="csvFile" class="form-control" accept=".csv">
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="uploadCsvBtn">Add Bulk</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/app.min.js"></script>

  <script>
    $(document).ready(function() {
      var table = $('#table-1').DataTable();

      // Delete confirmation using jQuery
      $('#table-1').on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        if (confirm('Are you sure you want to delete this student?')) {
          window.location.href = link;
        }
      });

      // Edit button works normally as it's just a link
    });
    document.getElementById('uploadCsvBtn').addEventListener('click', function() {
      const fileInput = document.getElementById('csvFile');
      if (!fileInput.files.length) {
        alert('Please select a CSV file first!');
        return;
      }

      const formData = new FormData();
      formData.append('students_csv', fileInput.files[0]);

      fetch('import_bulk.php', {
          method: 'POST',
          body: formData
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert('CSV imported successfully!');
            location.reload(); // refresh page to show new data
          } else {
            alert('Error: ' + (data.error || 'Something went wrong'));
          }
        })
        .catch(err => alert('Error: ' + err));
    });
  </script>

  <script>
    $(document).ready(function() {
      $('.status-select').change(function() {
        var studentId = $(this).data('student');
        var newStatus = $(this).val();

        $.ajax({
          url: 'form-validation-handler.php',
          type: 'POST',
          data: {
            status_update: 1,
            student_id: studentId,
            status: newStatus,
            ajax: 1
          },
          success: function(res) {
            var data = JSON.parse(res);
            if (data.success) {
              alert('Status updated to ' + data.status);
            } else {
              alert('Error updating status!');
            }
          },
          error: function() {
            alert('AJAX error!');
          }
        });
      });
    });
  </script>


  <!-- Page Specific JS File -->
  <script src="assets/bundles/datatables/datatables.min.js"></script>
  <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
  <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
  <script src="assets/js/page/datatables.js"></script>

  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>


</body>

</html>