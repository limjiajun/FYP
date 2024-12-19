<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jiajunco_cmd_db2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
 
}
?>
<?php
try {
    
     session_start();
 $Email = $_SESSION["Email"];
 $user_id = $_SESSION["user_id"];
    // Retrieve data from user profile table
    $sqlUserProfile = "SELECT `user_id`, `Image`, `First_name`, `Last_name`, `Gender`, `Email`, `Password`, `Phone_Number`, `Home_Address`, `otp`, `status`, `resettoken`, `resettokenexp`, `user_type` FROM `user_profile` ";
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


// Get the count of graves
$sqlGraveCount = "SELECT COUNT(*) AS graveCount FROM `cemeteryrecord`";
$stmtGraveCount = $conn->prepare($sqlGraveCount);
$stmtGraveCount->execute();
$GraveCount = $stmtGraveCount->fetchColumn();

$sqlBlockCount1 = "SELECT COUNT(*) AS blockCount 
FROM `cemeteryrecord` as cr
INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`
WHERE a.`Block_id` = 1";

$stmtBlockCount1 = $conn->prepare($sqlBlockCount1);
$stmtBlockCount1->execute();
$BlockCount1 = $stmtBlockCount1->fetchColumn();


$sqlBlockCount2 = "SELECT COUNT(*) AS blockCount 
FROM `cemeteryrecord` as cr
INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`
WHERE a.`Block_id` = 2";

$stmtBlockCount2 = $conn->prepare($sqlBlockCount2);
$stmtBlockCount2->execute();
$BlockCount2 = $stmtBlockCount2->fetchColumn();

$sqlBlockCount3 = "SELECT COUNT(*) AS blockCount 
FROM `cemeteryrecord` as cr
INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`
WHERE a.`Block_id` = 3";

$stmtBlockCount3 = $conn->prepare($sqlBlockCount3);
$stmtBlockCount3->execute();
$BlockCount3 = $stmtBlockCount3->fetchColumn();


$sqlBlockCount4 = "SELECT COUNT(*) AS blockCount 
FROM `cemeteryrecord` as cr
INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`
WHERE a.`Block_id` = 4";

$stmtBlockCount4 = $conn->prepare($sqlBlockCount4);
$stmtBlockCount4->execute();
$BlockCount4 = $stmtBlockCount4->fetchColumn();



//Avaiable
$sqlBlockCount1A = "SELECT COUNT(*) AS blockCount 
FROM `cemeteryrecord` as cr
INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`
WHERE a.`Block_id` = 1 AND a.`Status` = 'Available'";

$stmtBlockCount1A = $conn->prepare($sqlBlockCount1A);
$stmtBlockCount1A->execute();
$BlockCount1A = $stmtBlockCount1A->fetchColumn();


$sqlBlockCount2A = "SELECT COUNT(*) AS blockCount 
FROM `cemeteryrecord` as cr
INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`
WHERE a.`Block_id` = 2 AND a.`Status` = 'Available'";

$stmtBlockCount2A = $conn->prepare($sqlBlockCount2A);
$stmtBlockCount2A->execute();
$BlockCount2A = $stmtBlockCount2A->fetchColumn();


$sqlBlockCount3A = "SELECT COUNT(*) AS blockCount 
FROM `cemeteryrecord` as cr
INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`
WHERE a.`Block_id` = 3 AND a.`Status` = 'Available'";

$stmtBlockCount3A = $conn->prepare($sqlBlockCount3A);
$stmtBlockCount3A->execute();
$BlockCount3A = $stmtBlockCount3A->fetchColumn();


$sqlBlockCount4A = "SELECT COUNT(*) AS blockCount 
FROM `cemeteryrecord` as cr
INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`
WHERE a.`Block_id` = 4 AND a.`Status` = 'Available'";

$stmtBlockCount4A = $conn->prepare($sqlBlockCount4A);
$stmtBlockCount4A->execute();
$BlockCount4A = $stmtBlockCount4A->fetchColumn();


//
//unavaiable
$sqlBlockCount1U = "SELECT COUNT(*) AS blockCount 
FROM `cemeteryrecord` as cr
INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`
WHERE a.`Block_id` = 1 AND a.`Status` = 'unavailable'";

$stmtBlockCount1U = $conn->prepare($sqlBlockCount1U);
$stmtBlockCount1U->execute();
$BlockCount1U = $stmtBlockCount1U->fetchColumn();


$sqlBlockCount2U = "SELECT COUNT(*) AS blockCount 
FROM `cemeteryrecord` as cr
INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`
WHERE a.`Block_id` = 2 AND a.`Status` = 'unavailable'";

$stmtBlockCount2U = $conn->prepare($sqlBlockCount2U);
$stmtBlockCount2U->execute();
$BlockCount2U = $stmtBlockCount2U->fetchColumn();


$sqlBlockCount3U = "SELECT COUNT(*) AS blockCount 
FROM `cemeteryrecord` as cr
INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`
WHERE a.`Block_id` = 3 AND a.`Status` = 'unavailable'";

$stmtBlockCount3U = $conn->prepare($sqlBlockCount3U);
$stmtBlockCount3U->execute();
$BlockCount3U = $stmtBlockCount3U->fetchColumn();


$sqlBlockCount4U = "SELECT COUNT(*) AS blockCount 
FROM `cemeteryrecord` as cr
INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`
WHERE a.`Block_id` = 4 AND a.`Status` = 'unavailable'";

$stmtBlockCount4U = $conn->prepare($sqlBlockCount4U);
$stmtBlockCount4U->execute();
$BlockCount4U = $stmtBlockCount4U->fetchColumn();
    
} catch (PDOException $e) {
    echo "Query execution failed: " . $e->getMessage();
    exit();
}

// Rest of your code here...

// Close the database connection
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    
    !----======== lightbox functionality ======== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-3lTlkQwf9X0b0GheE1jzY8Yu2wCI4vN/4vyRi1Nfo8ScgW9pKjHCEeUUq3Yi8U6kC/6Xd5U6y5U5EIsjxyW9XQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-4vD0Rlm1yPKdK8W26X0guvCJVa0HqOYJ8sFBnEMsFtBnM3qy3/8Q2XcN9N0Rr1zZ+Sy8WCa1cJyKjTB2ze+/oA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
          href="test.php"
          >CMS - Cemetery Management System</a
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
          >Welcome <?php echo $Email ?></a
        >
           <li class="nav-item dropdown">
  <a
    class="nav-link dropdown-toggle ms-2"
    href="#"
    role="button"
    data-bs-toggle="dropdown"
    aria-expanded="false"
  >
<img src="<?php echo $image_path; ?>" alt="Profile Image" width="20" height="20">  </a>
  <ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
    <li><a class="dropdown-item" href="ChangePassword_A.php">Change Password</a></li>
    <li><a class="dropdown-item" href="index.php">Logout</a></li>
  </ul>
</li>
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
                <span>User</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="test.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Dashboard</span>
                    </a>
                  </li>
                  
                  <li>
                    <a href="DataTableUser.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>DataTableUser</span>
                    </a>
                  </li>
                  <li>
                    <a href="profile.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Profile</span>
                    </a>
                  </li>
                  <li>
                    <a href="ChangePassword_A.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>ChangePassword</span>
                    </a>
                  </li>
                  <li>
                    <a href="CreateNewUsers.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>CreateNewUsers</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#layouts"
              >
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Cemetery</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="test.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Dashboard</span>
                    </a>
                  </li>
                  <li>
                    <a href="AddCemeteryRecord.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>AddCemeteryRecord</span>
                    </a>
                  </li>
                   <li>
                    <a href="EditCemeteryRecord.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>EditCemeteryRecord</span>
                    </a>
                  </li>
                  <li>
                    <a href="DataTableCemetery.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>DataTableCemetery</span>
                    </a>
                  </li>
                </ul>
              </div>
              
            </li>
<!-- PLOT -->
<li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#layouts"
              >
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>PLOT</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="PLOT-A.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>PLOT-A</span>
                    </a>
                  </li>
                  <li>
                    <a href="PLOT-B.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>PLOT-B</span>
                    </a>
                  </li>
                   <li>
                    <a href="PLOT-C.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>PLOT-C</span>
                    </a>
                  </li>
                  <li>
                    <a href="PLOT-D.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>PLOT-D</span>
                    </a>
                  </li>
                </ul>
              </div>
              
            </li>
            <!-- CONTACT AND FEEDBACK -->
<li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#layouts"
              >
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Contact Form</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="ContactForm.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Contact Form</span>
                    </a>
                  </li>
                  <li>
                    <a href="PLOT-B.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Feedback</span>
                    </a>
                  </li>
                  
                </ul>
              </div>
              
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
    <div class="card-body py-5">Total Role User: <?php echo $totalCount; ?>
  <br>Admins: <?php echo $adminCount; ?>  
  <br>Users: <?php echo $UserCount; ?>
</div>
<div class="card-footer d-flex">
  <a href="DataTableUser.php" class="text-white">View Details</a>
  <span class="ms-auto">
    <a href="DataTableUser.php" class="text-white">
      <i class="bi bi-chevron-right"></i>
    </a>
  </span>
</div>

  </div>
</div>
<div class="col-md-3 mb-3">
<div class="card bg-warning text-white h-100">
    <div class="card-body py-5">Total Graves: <?php echo $GraveCount; ?>
        <br>Block A: <?php echo $BlockCount1 ; ?>  
  <br>Block B: <?php echo $BlockCount2 ; ?>
  <br>Block C: <?php echo $BlockCount3 ; ?>  
  <br>Block D: <?php echo $BlockCount4 ; ?>
       </div>
       
         
       
        <div class="card-footer d-flex">
  <a href="DataTableCemetery.php" class="text-white">View Details</a>
  <span class="ms-auto">
    <a href="DataTableCemetery.php" class="text-white">
      <i class="bi bi-chevron-right"></i>
    </a>
  </span>
</div>
    </div>
</div>

 <div class="col-md-3 mb-3">
<div class="card bg-warning text-white h-100">
    <div class="card-body py-5">Total Graves: <?php echo $GraveCount; ?>
       <br>Block A<br> 
       Available: <?php echo $BlockCount1A ; ?>
       <br>
       Unvailable: <?php echo $BlockCount1U ; ?>
        <br>
        
   <br>Block B<br> 
       Available: <?php echo $BlockCount2A ; ?>
       <br>
       Unavailable: <?php echo $BlockCount2U ; ?>
        <br>
         <br>Block C<br> 
       Available: <?php echo $BlockCount3A ; ?>
       <br>
       Unavailable: <?php echo $BlockCount3U ; ?>
        <br>
         <br>Block D<br> 
       Available: <?php echo $BlockCount4A ; ?>
       <br>
       Unavailable: <?php echo $BlockCount4U ; ?>
        <br>
       </div>
       
         
       
        <div class="card-footer d-flex">
  <a href="DataTableCemetery.php" class="text-white">View Details</a>
  <span class="ms-auto">
    <a href="DataTableCemetery.php" class="text-white">
      <i class="bi bi-chevron-right"></i>
    </a>
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
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
           <?php
$counter = 1;
foreach ($rowsUserProfile as $rowUserProfile): ?>
    <tr>
        <td><?php echo $counter++; ?></td>
        <td>
            <a href="<?php echo $image_path = $rowUserProfile['Image']; ?>" data-lightbox="cemetery-image">
                <img src="<?php echo $image_path = $rowUserProfile['Image']; ?>" alt="Image" width="100" height="100">
            </a>
        </td>
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
                <input type="hidden" name="user_id" value="<?php echo $rowUserProfile['user_id']; ?>">
                <select name="status" onchange="this.form.submit()">
                    <option value="Active" <?php echo $rowUserProfile['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                    <option value="Inactive" <?php echo $rowUserProfile['status'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </form>
        </td>
        <td>
           <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $rowUserProfile['user_id']; ?>" onclick="confirmDelete(<?php echo $rowUserProfile['user_id']; ?>)">
    Delete
</button>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal<?php echo $rowUserProfile['user_id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form method="POST" action="delete_user.php" id="deleteForm<?php echo $rowUserProfile['user_id']; ?>">
  <input type="hidden" name="user_id" value="<?php echo $rowUserProfile['user_id']; ?>">
  <button type="submit" class="btn btn-danger">Delete</button>
</form>

            </div>
        </div>
    </div>
</div>

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
                <th>Status</th>
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
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script>
function confirmDelete(userId) {
  if (confirm("Are you sure you want to delete this user?")) {
    // If the user confirms the deletion, submit the form
    document.getElementById("deleteForm" + userId).submit();
  }
}
</script>

  </body>
</html>
