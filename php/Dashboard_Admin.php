 <?php
session_start();
include_once("dbconnect.php");
include_once("access_control.php");


if (!isset($_SESSION['user_type'])) {
    echo "<script>alert('Access denied. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
    exit;
}

    
 $Email = $_SESSION["Email"];
 $user_id = $_SESSION["user_id"];
 $image_path= $_SESSION["Image"];
   
    // Retrieve data from user profile table
    try {
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
   
}


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
    
    <!----======== lightbox functionality ======== -->
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

    
    
    
    
    
    <title>CMS - Dashboard Admin Page</title>
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
          href="Dashboard_Admin.php"
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
    <li><a class="dropdown-item" href="profile_A.php">Profile</a></li>
    <li>
        <a class="dropdown-item" href="ChangePassword_A.php">Change Password</a>
        </li>
    <li><a class="dropdown-item" href="login.php">Logout</a></li>
  </ul>
</li>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
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
              <a href="Dashboard_Admin.php" class="nav-link px-3 active">
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
                    <a href="Dashboard_Admin.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Dashboard</span>
                    </a>
                  </li>
                  
                  <li>
                    <a href="DataTableUser_A.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>DataTableUser</span>
                    </a>
                  </li>
                  <li>
                    <a href="profile_A.php" class="nav-link px-3">
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
                    <a href="AddCemeteryRecord.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>AddCemeteryRecord</span>
                    </a>
                  </li>
               
                  <li>
                    <a href="DataTableCemetery_A.php" class="nav-link px-3">
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
                <span>Feedback</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="ContactForm_A.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Feedback</span>
                    </a>
                  </li>
                  
                  
                </ul>
              </div>
              
            </li>
            
                        <!-- Image Map -->
<li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#layouts"
              >
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Image Map</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="mapA_A.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Image Map Block A</span>
                    </a>
                  </li>
                    <li>
                    <a href="mapB_A.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Image Map Block B</span>
                    </a>
                  </li>
                    <li>
                    <a href="mapC_A.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Image Map Block C</span>
                    </a>
                  </li>
                    <li>
                    <a href="mapD_A.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Image Map Block D</span>
                    </a>
                  </li>
                  
                </ul>
              </div>
              
            </li>
            <!--  -->
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
               Tables
              </div>
            </li>
           
            <li>
              <a href="DataTableCemetery_A.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Data Table Cemetery</span>
              </a>
            </li>
            <li>
              <a href="DataTableUser_A.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Data Table User </span>
              </a>
            </li>
            <li>
              <a href="DataTableContactForm.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Data Table Feedback</span>
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
<a href="DataTableUser_A.php" class="text-white">View Details</a>
<span class="ms-auto">
<a href="DataTableUser_A.php" class="text-white">
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
<a href="DataTableCemetery_A.php" class="text-white">View Details</a>
<span class="ms-auto">
<a href="DataTableCemetery_A.php" class="text-white">
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
<a href="DataTableCemetery_A.php" class="text-white">View Details</a>
<span class="ms-auto">
<a href="DataTableCemetery_A.phpp" class="text-white">
  <i class="bi bi-chevron-right"></i>
</a>
</span>
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

    



  </body>
</html>