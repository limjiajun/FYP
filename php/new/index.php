<?php
$servername = "localhost";
$username = "jiajunco_cms";
$password = "6G+]EJ+x14Qz";
$dbname = "jiajunco_cmd_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve data from user profile table
    $sqlUserProfile = "SELECT `user_id`, `Image`, `First_name`, `Last_name`, `Gender`, `Email`, `Password`, `Phone_Number`, `Home_Address`, `otp`, `status`, `resettoken`, `resettokenexp`, `user_type` FROM `user_profile` WHERE 1";
    $stmtUserProfile = $conn->prepare($sqlUserProfile);
    $stmtUserProfile->execute();
    $rowsUserProfile = $stmtUserProfile->fetchAll();

    // Get the total count of users
    $totalCount = count($rowsUserProfile);

    // Get the count of admin profiles
    $sqlAdminCount = "SELECT COUNT(*) AS adminCount FROM `user_profile` WHERE `user_type` = 'admin'";
    $stmtAdminCount = $conn->prepare($sqlAdminCount);
    $stmtAdminCount->execute();
    $adminCount = $stmtAdminCount->fetchColumn();

    // Get the count of user profiles
    $sqlUserCount = "SELECT COUNT(*) AS userCount FROM `user_profile` WHERE `user_type` = 'user'";
    $stmtUserCount = $conn->prepare($sqlUserCount);
    $stmtUserCount->execute();
    $UserCount = $stmtUserCount->fetchColumn();

    // Retrieve data from cemetery record table
    $sqlCemeteryRecord = "SELECT `Grave_ID`, `Image`, `Name_Deceased`, `Years_of_Born`, `Years_of_Died`, `Location`, `Section`, `Years_Buried` FROM `cemeteryrecord`";
    $stmtCemeteryRecord = $conn->prepare($sqlCemeteryRecord);
    $stmtCemeteryRecord->execute();
    $rowsCemeteryRecord = $stmtCemeteryRecord->fetchAll();

    // Get the total count of cemetery records
    $totalCountCemetery = count($rowsCemeteryRecord);

    // Get the count for each section
    $sectionCounts = array();
    $sectionLetters = ['A', 'B', 'C', 'D'];
   

    foreach ($sectionLetters as $letter) {
        $sqlSectionCount = "SELECT COUNT(*) AS sectionCount FROM `cemeteryrecord` WHERE `Section` = :section";
        $stmtSectionCount = $conn->prepare($sqlSectionCount);
        $stmtSectionCount->bindParam(':section', $letter);
        $stmtSectionCount->execute();
        $sectionCounts[$letter] = $stmtSectionCount->fetchColumn();
    }

    $conn = null; // Close the database connection
} catch (PDOException $e) {
    echo $sqlUserProfile . "<br>" . $e->getMessage();
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Frontendfunn - Bootstrap 5 Admin Dashboard Template</title>
  </head>
  <body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="#"
          >Frontendfunn</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
            <div class="input-group">
              
              
            </div>
          </form>
          <ul class="navbar-nav">
          <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="#"
          >Welcome</a
        >
            <li class="nav-item dropdown">
           
              <a
                class="nav-link dropdown-toggle ms-2"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
              
                <i class="bi bi-person-fill"></i>
                
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <a class="dropdown-item" href="#">Something else here</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3">
                CORE
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Interface
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#layouts"
              >
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Layouts</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Dashboard</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-book-fill"></i></span>
                <span>Pages</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Addons
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                <span>Charts</span>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Tables</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Dashboard</h4>
          </div>
        </div>
        <div class="row">
        <div class="col-md-3 mb-3">
  <div class="card bg-primary text-white h-100">
    <div class="card-body py-5">Total: <?php echo $totalCount; ?>
  <br>Admins: <?php echo $adminCount; ?>  
  <br>Users: <?php echo $UserCount; ?>
</div>
<div class="card-footer d-flex">
  <a href="details.php" class="text-white">View Details</a>
  <span class="ms-auto">
    <a href="details.php" class="text-white">
      <i class="bi bi-chevron-right"></i>
    </a>
  </span>
</div>

  </div>
</div>
<div class="col-md-3 mb-3">
<div class="card bg-warning text-white h-100">
        <div class="card-body py-5">Total<br><?php
            foreach ($sectionCounts as $section => $count) {
                echo "$section: $count<br>";
            }
        ?></div>
        <div class="card-footer d-flex">
            View Details
            <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
            </span>
        </div>
    </div>
</div>

          <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
              <div class="card-body py-5">Success Card</div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white h-100">
              <div class="card-body py-5">Danger Card</div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        
      <div class="row">
  <div class="col-md-12 mb-3">
    <div class="d-flex justify-content-end">
      <form method="POST" action="process_user.php">
        <button type="submit" class="btn btn-primary">Add User</button>
      </form>
    </div>
  </div>
</div>



        <div class="row">
  <div class="col-md-12 mb-3">
    <div class="card">
      <div class="card-header">
        <span><i class="bi bi-table me-2"></i></span> Data Table
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="example" class="table table-striped data-table" style="width: 100%">
            <thead>
              <tr>
                <th>User ID</th>
                <th>Image</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Password</th>
                <th>Phone Number</th>
                <th>Home Address</th>
                <th>OTP</th>
                <th>Status</th>
                <th>Reset Token</th>
                <th>Reset Token Expiration</th>
                <th>User Type</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
$counter = 1;
foreach ($rowsUserProfile as $rowUserProfile): ?>
    <tr>
        <td><?php echo $counter++; ?></td>
       <a href="<?php echo $rowUserProfile['Image']; ?>" data-lightbox="cemetery-image">
        <?php echo $rowUserProfile['Image']; ?>
    </a>
        <td><?php echo $rowUserProfile['First_name']; ?></td>
        <td><?php echo $rowUserProfile['Last_name']; ?></td>
        <td><?php echo $rowUserProfile['Gender']; ?></td>
        <td><?php echo $rowUserProfile['Email']; ?></td>
        <td><?php echo $rowUserProfile['Password']; ?></td>
        <td><?php echo $rowUserProfile['Phone_Number']; ?></td>
        <td><?php echo $rowUserProfile['Home_Address']; ?></td>
        <td><?php echo $rowUserProfile['otp']; ?></td>
        <td><?php echo $rowUserProfile['status']; ?></td>
        <td><?php echo $rowUserProfile['resettoken']; ?></td>
        <td><?php echo $rowUserProfile['resettokenexp']; ?></td>
        <td><?php echo $rowUserProfile['user_type']; ?></td>
        <td>
            <form method="POST">
                <input type="hidden" name="userId" value="<?php echo $rowUserProfile['user_id']; ?>">
                <select name="status" onchange="this.form.submit()">
                    <option value="Active" <?php echo $rowUserProfile['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                    <option value="Inactive" <?php echo $rowUserProfile['status'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </form>
        </td>
    </tr>
<?php endforeach; ?>

            </tbody>
            <tfoot>
              <tr>
                <th>User ID</th>
                <th>Image</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Password</th>
                <th>Phone Number</th>
                <th>Home Address</th>
                <th>OTP</th>
                <th>Status</th>
                <th>Reset Token</th>
                <th>Reset Token Expiration</th>
                <th>User Type</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
       

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    
  </body>
</html>
