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
  <div class="loader"></div>
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
            <div class="row">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Student Data Table</h4>
                  </div>
                  <div class="card-body">
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
                            <th>Faher CNIC</th>
                            <th>Address</th>
                            <th>Caste</th>
                            <th>Language</th>
                            <th>Phone #</th>
                            <th>Transport</th>
                            <th>Rent</th>
                            <th>Stop Point</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = "SELECT * FROM students ORDER BY id DESC";
                          $result = mysqli_query($cn, $query);
                          $count = 1;
                          while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td class='text-center'>{$count}</td>
                                    <td>{$row['student_name']}</td>
                                    <td>{$row['father_name']}</td>
                                    <td>{$row['class_name']}</td>
                                    <td>{$row['session_year']}</td>
                                    <td>{$row['dob']}</td>
                                    <td>{$row['gender']}</td>
                                    <td>{$row['father_cnic']}</td>
                                    <td>{$row['address']}</td>
                                    <td>{$row['caste']}</td>
                                    <td>{$row['language']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['transport']}</td>
                                    <td>{$row['rent']}</td>
                                    <td>{$row['stop_point']}</td>
                                    <td>

                                      <div class='dropdown'>
                                          <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-toggle='dropdown'>
                                              <i class='fas fa-ellipsis-v'></i>
                                          </button>
                                          <div class='dropdown-menu'>
                                              <a class='dropdown-item' href='view_profile.php?id={$row['id']}'>
                                                  <i class='fas fa-eye'></i> View
                                              </a>
                                              <a class='dropdown-item' href='edit_profile.php?edit_id={$row['id']}'>
                                                  <i class='fas fa-edit'></i> Edit
                                              </a>
                                              <a class='dropdown-item text-danger' href='delete_profile.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this record?')\">
                                                  <i class='fas fa-trash-alt'></i> Delete
                                              </a>
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
  <!-- General JS Scripts -->
  <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>

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
  </script>



  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
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


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->

</html>