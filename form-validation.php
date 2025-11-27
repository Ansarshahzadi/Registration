<!DOCTYPE html>
<html lang="en">


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Otika - Admin Dashboard Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
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
                <div class="d-flex justify-content-end mb-3">
                  <label class="btn btn-primary">
                    Import Bulk CSV
                    <input type="file" name="students_csv" accept=".csv" hidden onchange="this.form.submit()">
                  </label>
                </div>

                <div class="card-header text-center">
                  <h4 class="card-title">Student Registration Form </h4>

                </div>
                <div class="card-body">
                  <div class="d-flex mb-3 justify-content-around align-items-center position-relative mx-auto">
                    <h3 class="school-title fs-2 fw-bold text-center">Amina Girls High School</h3>
                    <div class="dropdown" style="width: 100px; height: 100px;">
                      <div style="width: 100%; height: 100%; border-radius: 50%; border: 1px solid grey; cursor: pointer; display: flex; justify-content: center; align-items: center;"
                        data-bs-toggle="dropdown">
                        <img src="student-pic.png" alt="Student Picture" id="previewImg" name="picture"
                          class="img-fluid w-100 h-100 rounded rounded-circle border" style="object-fit: contain;" />
                      </div>

                      <ul class="dropdown-menu w-100 m-3">
                        <li>
                          <a class="dropdown-item mb-2 p-3 " href="#" data-bs-toggle="modal" data-bs-target="#cameraModal">
                            📷 Capture from Camera
                          </a>
                        </li>
                        <li>
                          <label class="dropdown-item px-4">
                            Upload File
                            <input type="file" class="form-control mt-1" accept="image/*" onchange="previewFile(this)">
                          </label>
                        </li>
                      </ul>
                    </div>

                  </div>

                  <?php
                  include('includes/config.php');

                  $editData = null;
                  if (isset($_GET['edit_id']) && is_numeric($_GET['edit_id'])) {
                    $edit_id = (int)$_GET['edit_id'];
                    $result = mysqli_query($cn, "SELECT * FROM students WHERE id = $edit_id");
                    if ($result && mysqli_num_rows($result) > 0) {
                      $editData = mysqli_fetch_assoc($result);
                    }
                  }
                  ?>



                  <form method="POST" action="form-validation-handler.php" class="row g-3" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
                    <!-- Hidden input to store image base64 -->
                    <input type="hidden" name="captured_image" id="studentPicture">

                    <!-- Name -->
                    <div class="col-md-4 mb-3">
                      <label>Name</label>
                      <input type="text" class="form-control" name="student_name"
                        value="<?= $editData['student_name'] ?? '' ?>" required>
                    </div>

                    <!-- Father Name -->
                    <div class="col-md-4 mb-3">
                      <label>Father Name</label>
                      <input type="text" class="form-control" name="father_name"
                        value="<?= $editData['father_name'] ?? '' ?>" required>
                    </div>

                    <!-- Class -->
                    <div class="col-md-4 mb-3">
                      <label>Class</label>
                      <select name="class_name" class="form-select form-control" required>
                        <option value="">Choose one...</option>
                        <option value="KG-1" <?= ($editData && $editData['class_name'] == 'KG-1') ? 'selected' : '' ?>>KG-1</option>
                        <option value="KG-2" <?= ($editData && $editData['class_name'] == 'KG-2') ? 'selected' : '' ?>>KG-2</option>
                        <option value="KG-3" <?= ($editData && $editData['class_name'] == 'KG-3') ? 'selected' : '' ?>>KG-3</option>
                        <option value="One" <?= ($editData && $editData['class_name'] == 'One') ? 'selected' : '' ?>>One</option>
                        <option value="Two" <?= ($editData && $editData['class_name'] == 'Two') ? 'selected' : '' ?>>Two</option>
                        <option value="Three" <?= ($editData && $editData['class_name'] == 'Three') ? 'selected' : '' ?>>Three</option>
                        <option value="Four" <?= ($editData && $editData['class_name'] == 'Four') ? 'selected' : '' ?>>Four</option>
                        <option value="Five" <?= ($editData && $editData['class_name'] == 'Five') ? 'selected' : '' ?>>Five</option>
                        <option value="Six" <?= ($editData && $editData['class_name'] == 'Six') ? 'selected' : '' ?>>Six</option>
                        <option value="Seven" <?= ($editData && $editData['class_name'] == 'Seven') ? 'selected' : '' ?>>Seven</option>
                        <option value="Eight" <?= ($editData && $editData['class_name'] == 'Eight') ? 'selected' : '' ?>>Eight</option>
                        <option value="Nine" <?= ($editData && $editData['class_name'] == 'Nine') ? 'selected' : '' ?>>Nine</option>
                        <option value="Ten" <?= ($editData && $editData['class_name'] == 'Ten') ? 'selected' : '' ?>>Ten</option>
                      </select>
                    </div>

                    <!-- Session -->
                    <div class="col-md-4 mb-3">
                      <label>Session</label>
                      <input type="text" class="form-control" name="session_year" id="session"
                        value="<?= $editData['session_year'] ?? '' ?>" required placeholder="XXXX-XXXX">
                    </div>

                    <!-- DOB -->
                    <div class="col-md-4 mb-3">
                      <label>DOB</label>
                      <input type="date" class="form-control" name="dob"
                        value="<?= $editData['dob'] ?? '' ?>" required>
                    </div>

                    <!-- Gender -->
                    <div class="col-md-4 mb-3">
                      <label>Gender</label>
                      <select name="gender" class="form-select form-control" required>
                        <option value="">Choose...</option>
                        <option <?= ($editData && $editData['gender'] == "Male") ? "selected" : "" ?> value="Male">Male</option>
                        <option <?= ($editData && $editData['gender'] == "Female") ? "selected" : "" ?> value="Female">Female</option>
                      </select>
                    </div>

                    <!-- Student CNIC -->
                    <div class="col-md-4 mb-3">
                      <label>Student CNIC</label>
                      <input type="text" class="form-control" name="student_cnic" id="cnic"
                        value="<?= $editData['student_cnic'] ?? '' ?>" required placeholder="XXXXX-XXXXXXX-X">
                    </div>

                    <!-- Father CNIC -->
                    <div class="col-md-4 mb-3">
                      <label>Father CNIC</label>
                      <input type="text" class="form-control" name="father_cnic" id="cnic"
                        value="<?= $editData['father_cnic'] ?? '' ?>" required placeholder="XXXXX-XXXXXXX-X">
                    </div>

                    <!-- Address -->
                    <div class="col-md-4 mb-3">
                      <label>Address</label>
                      <input type="text" class="form-control" name="address"
                        value="<?= $editData['address'] ?? '' ?>" required>
                    </div>

                    <!-- Caste -->
                    <div class="col-md-4 mb-3">
                      <label>Caste</label>
                      <input type="text" class="form-control" name="caste"
                        value="<?= $editData['caste'] ?? '' ?>" required>
                    </div>

                    <!-- Language -->
                    <div class="col-md-4 mb-3">
                      <label>Language</label>
                      <input type="text" class="form-control" name="language"
                        value="<?= $editData['language'] ?? '' ?>" required>
                    </div>

                    <!-- Mobile -->
                    <div class="col-md-4 mb-3">
                      <label>Mobile No</label>
                      <input type="text" class="form-control" name="phone" id="mobile"
                        value="<?= $editData['phone'] ?? '' ?>" required placeholder="03XXXXXXXXX">
                    </div>

                    <!-- Transport -->
                    <div class="col-md-4 mb-3">
                      <label>Transport</label>
                      <select name="transport" class="form-select form-control" required>
                        <option value="">Choose...</option>
                        <option value="Coaster" <?= ($editData && $editData['transport'] == 'Coaster') ? 'selected' : '' ?>>Coaster</option>
                        <option value="Bolan" <?= ($editData && $editData['transport'] == 'Bolan') ? 'selected' : '' ?>>Bolan</option>
                        <option value="Rikshaw" <?= ($editData && $editData['transport'] == 'Rikshaw') ? 'selected' : '' ?>>Rikshaw</option>
                        <option value="Byself" <?= ($editData && $editData['transport'] == 'Byself') ? 'selected' : '' ?>>Byself</option>
                      </select>
                    </div>

                    <!-- Rent, Stop-point, Fees -->
                    <div class="col-md-4 mb-3">
                      <label>Rent</label>
                      <input type="number" class="form-control" name="rent" value="<?= $editData['rent'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label>Stop-Point</label>
                      <input type="text" class="form-control" name="stop_point" value="<?= $editData['stop_point'] ?? '' ?>" required>
                    </div>

                    <div class="col-12 form-check mt-3">
                      <input class="form-check-input" type="checkbox" name="confirmSubmit" id="confirmSubmit" required>
                      <label class="form-check-label text-dark fw-bold" for="confirmSubmit">
                        Are you sure you want to submit this data?
                      </label>
                    </div>


                    <div class="col-12 my-3">
                      <button type="submit" name="user-login-btn" class="btn btn-primary">
                        <?= $editData ? 'Update' : 'Submit' ?>
                      </button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </section>
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
  <!-- Camera Modal -->
  <div class="modal fade" id="cameraModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Capture Photo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <video id="cameraStream" width="100%" autoplay></video>
          <canvas id="cameraCanvas" class="d-none"></canvas>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary" id="captureBtn">Capture</button>
        </div>
      </div>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/masking/jquery.inputmask.bundle.js"></script>
  <script>
    Inputmask("99999-9999999-9").mask("#cnic");
    Inputmask("2099-2099").mask("#session");
    Inputmask("03-999999999").mask("#mobile");

    // File upload preview + store
    function previewFile(input) {
      const file = input.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = e => {
          $('#previewImg').attr('src', e.target.result);
          $('#studentPicture').val(e.target.result);
        };
        reader.readAsDataURL(file);
      }
    }

    // Camera
    const video = document.getElementById('cameraStream');
    const canvas = document.getElementById('cameraCanvas');
    const captureBtn = document.getElementById('captureBtn');
    const cameraModal = document.getElementById('cameraModal');

    cameraModal.addEventListener('shown.bs.modal', async () => {
      const stream = await navigator.mediaDevices.getUserMedia({
        video: true
      });
      video.srcObject = stream;
      video.play();
    });

    cameraModal.addEventListener('hidden.bs.modal', () => {
      const stream = video.srcObject;
      if (stream) stream.getTracks().forEach(track => track.stop());
    });

    captureBtn.onclick = () => {
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      canvas.getContext('2d').drawImage(video, 0, 0);
      const dataURL = canvas.toDataURL('image/png');
      $('#previewImg').attr('src', dataURL);
      $('#studentPicture').val(dataURL);
      bootstrap.Modal.getInstance(cameraModal).hide();
    };
  </script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->

</html>