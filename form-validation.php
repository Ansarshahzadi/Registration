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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Otika - Admin Dashboard Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar bg-white sticky">
        <?php include 'includes/navbar.php' ?>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <?php include 'includes/leftsidebar.php' ?>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-xl-12">

                <div class="card-header text-center">
                  <h4 class="card-title">Student Registration Form </h4>
                </div>

                <div class="card-body">
                  <div class="d-flex mb-3 justify-content-around align-items-center position-relative mx-auto">
                    <h3 class="school-title fs-2 fw-bold text-center">Amina Girls High School</h3>
                    <div class="dropdown" style="width: 100px; height: 100px;">
                      <button class="btn dropdown-toggle p-0 border-0 rounded-circle" type="button"
                        id="imageDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                        style="width:100%; height:100%; display:flex; justify-content:center; align-items:center;">
                        <img src="<?= $editData['picture'] ?? 'student-pic.png' ?>" alt="Student Picture" id="previewImg"
                          name="picture" class="img-fluid w-100 h-100 rounded-circle border"
                          style="object-fit: contain;" />
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="imageDropdown">
                        <li>
                          <a class="dropdown-item mb-2 p-3" href="#" data-bs-toggle="modal" data-bs-target="#cameraModal">
                            📷 Capture from Camera
                          </a>
                        </li>
                        <li>
                          <label class="dropdown-item px-4 mb-0">
                            Upload File
                            <input type="file" class="form-control mt-1" accept="image/*" onchange="previewFile(this)">
                          </label>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <form method="POST" action="form-validation-handler.php" class="row g-3" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
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
                        <?php
                        $classes = ['KG-1','KG-2','KG-3','One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten'];
                        foreach ($classes as $c) {
                            $selected = ($editData && $editData['class_name'] == $c) ? 'selected' : '';
                            echo "<option value='$c' $selected>$c</option>";
                        }
                        ?>
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

                    <!-- Obtained Marks -->
                    <div class="col-md-4 mb-3">
                      <label for="obtained_marks" class="form-label fw-bold">Last Year Obtained Marks</label>
                      <input type="number" class="form-control" id="obtained_marks" name="obtained_marks"
                        value="<?= $editData['obtained_marks'] ?? '' ?>" min="0" placeholder="Enter obtained marks">
                    </div>

                    <!-- Total Marks -->
                    <div class="col-md-4 mb-3">
                      <label for="total_marks" class="form-label fw-bold">Last Year Total Marks</label>
                      <input type="number" class="form-control" id="total_marks" name="total_marks"
                        value="<?= $editData['total_marks'] ?? '' ?>" min="0" placeholder="Enter total marks">
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
                        <?php
                        $transports = ['Coaster','Bolan','Rikshaw','Byself'];
                        foreach ($transports as $t) {
                            $selected = ($editData && $editData['transport']==$t)?'selected':'';
                            echo "<option value='$t' $selected>$t</option>";
                        }
                        ?>
                      </select>
                    </div>

                    <!-- Rent & Stop-Point -->
                    <div class="col-md-4 mb-3">
                      <label>Rent</label>
                      <input type="number" class="form-control" name="rent" value="<?= $editData['rent'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label>Stop-Point</label>
                      <input type="text" class="form-control" name="stop_point" value="<?= $editData['stop_point'] ?? '' ?>" required>
                    </div>

                    <!-- Status -->
                    <div class="col-md-4 mb-3">
                      <label>Status</label>
                      <select id="status" name="status" class="form-select form-control">
                        <option value="active" <?= ($editData && $editData['status']=='active')?'selected':'' ?>>Active</option>
                        <option value="inactive" <?= ($editData && $editData['status']=='inactive')?'selected':'' ?>>Inactive</option>
                      </select>
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
      </div>

      <!-- footer -->
      <footer class="main-footer">
        <div class="footer-left"><a href="templateshub.net">Templateshub</a></div>
        <div class="footer-right"></div>
      </footer>
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

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/masking/jquery.inputmask.bundle.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script>
    Inputmask("99999-9999999-9").mask("#cnic");
    Inputmask("2099-2099").mask("#session");
    Inputmask("03999999999").mask("#mobile");

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

    const video = document.getElementById('cameraStream');
    const canvas = document.getElementById('cameraCanvas');
    const captureBtn = document.getElementById('captureBtn');
    const cameraModal = document.getElementById('cameraModal');

    cameraModal.addEventListener('shown.bs.modal', async () => {
      const stream = await navigator.mediaDevices.getUserMedia({ video: true });
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
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>
