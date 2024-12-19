  <?php
session_start();
include_once("dbconnect.php");
include_once("access_control.php");


if (!isset($_SESSION['user_type'])) {
    echo "<script>alert('Access denied. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
   
}

     
 $Email = $_SESSION["Email"];
 $user_id = $_SESSION["user_id"];
 $image_path = $_SESSION["Image"];
 
    
    try {
    $sqlUserProfile = "SELECT `user_id`, `Image`, `First_name`, `Last_name`, `Gender`, `Email`, `Password`, `Phone_Number`, `Home_Address`, `otp`, `status`, `resettoken`, `resettokenexp`, `user_type` FROM `user_profile` ";
    $stmtUserProfile = $conn->prepare($sqlUserProfile);
    $stmtUserProfile->execute();
    $rowsUserProfile = $stmtUserProfile->fetchAll();

    
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-3lTlkQwf9X0b0GheE1jzY8Yu2wCI4vN/4vyRi1Nfo8ScgW9pKjHCEeUUq3Yi8U6kC/6Xd5U6y5U5EIsjxyW9XQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-4vD0Rlm1yPKdK8W26X0guvCJVa0HqOYJ8sFBnEMsFtBnM3qy3/8Q2XcN9N0Rr1zZ+Sy8WCa1cJyKjTB2ze+/oA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<title>CMS - IMAGE MAP BLOCK D</title>
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
                      <span>Feedback </span>
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
<main class="mt-5 pt-3">
      <div class="container-fluid">
  
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient" id="topNavBar">
  <div class="container">
    <a class="navbar-brand" href="">
      Map Area 
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
         <a class="nav-link" href="mapA_A.php">Block A</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mapB_A.php">Block B</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mapC_A.php">Block C</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mapD_A.php">Block D</a>
        </li>
      </ul>
    </div>
  </div>
</nav>  
 <div class="container py-3" id="page-container">
  <h3>IMAGE MAP</h3>
  <hr>
<!-- Image Map Generated by http://www.image-map.net/ -->


<img src="../res/maps/map_D%20%281%29.png" usemap="#image-map">

<map name="image-map">
    <area target="_blank" alt="D. Johnson" title="D. Johnson" href="../php/TestGraveDetails.php?cmid=31" coords="180,32,209,46" shape="rect">
    <area target="_blank" alt="Pvt H. Kelly" title="Pvt H. Kelly" href="../php/TestGraveDetails.php?cmid=32" coords="209,32,238,45" shape="rect">
    <area target="_blank" alt="William Stuart Lecky" title="William Stuart Lecky" href="../php/TestGraveDetails.php?cmid=33" coords="252,33,280,45" shape="rect">
    <area target="_blank" alt="Hannah Cheng Jiau Lee" title="Hannah Cheng Jiau Lee" href="../php/TestGraveDetails.php?cmid=34" coords="281,31,310,44" shape="rect">
    <area target="_blank" alt="W. H. Leppard" title="W. H. Leppard" href="../php/TestGraveDetails.php?cmid=35" coords="327,32,356,47" shape="rect">
    <area target="_blank" alt="Michael Lesslar" title="Michael Lesslar" href="../php/TestGraveDetails.php?cmid=36" coords="356,30,383,44" shape="rect">
    <area target="_blank" alt="Francisca Siew Chin Liew" title="Francisca Siew Chin Liew" href="../php/TestGraveDetails.php?cmid=37" coords="395,33,424,46" shape="rect">
    <area target="_blank" alt="Lieut P. S. Loveday" title="Lieut P. S. Loveday" href="../php/TestGraveDetails.php?cmid=38" coords="423,32,451,46" shape="rect">
    <area target="_blank" alt="J. Lyon" title="J. Lyon" href="../php/TestGraveDetails.php?cmid=39" coords="454,32,480,45" shape="rect">
    <area target="_blank" alt="Susannah Carr" title="Susannah Carr" href="../php/TestGraveDetails.php?cmid=71" coords="490,31,520,45" shape="rect">
    <area target="_blank" alt="Harry Carr" title="Harry Carr" href="../php/TestGraveDetails.php?cmid=72" coords="179,47,207,60" shape="rect">
    <area target="_blank" alt="D21 - No Record" title="D21 - No Record" href="../php/TestGraveDetails.php?cmid=95" coords="568,46,543,31" shape="rect">
    <area target="_blank" alt="Fred Ivor Court" title="Fred Ivor Court" href="../php/TestGraveDetails.php?cmid=73" coords="252,46,278,59" shape="rect">
    <area target="_blank" alt="Sarah Elizabeth Cutler" title="Sarah Elizabeth Cutler" href="../php/TestGraveDetails.php?cmid=74" coords="279,47,308,59" shape="rect">
    <area target="_blank" alt="Charles Edwin Cutler" title="Charles Edwin Cutler" href="../php/TestGraveDetails.php?cmid=75" coords="327,48,352,61" shape="rect">
    <area target="_blank" alt="George Albert Golding" title="George Albert Golding" href="../php/TestGraveDetails.php?cmid=76" coords="356,47,384,60" shape="rect">
    <area target="_blank" alt="Harold Roy Ellmer" title="Harold Roy Ellmer" href="../php/TestGraveDetails.php?cmid=77" coords="397,47,423,59" shape="rect">
    <area target="_blank" alt="Reginald William Edwards" title="Reginald William Edwards" href="../php/TestGraveDetails.php?cmid=78" coords="425,47,451,57" shape="rect">
    <area target="_blank" alt="Helen Elizabeth Draper" title="Helen Elizabeth Draper" href="../php/TestGraveDetails.php?cmid=79" coords="454,45,479,59" shape="rect">
    <area target="_blank" alt="D15 - No Record" title="D15 - No Record" href="../php/TestGraveDetails.php?cmid=80" coords="209,47,237,59" shape="rect">
    <area target="_blank" alt="D22 - No Record" title="D22 - No Record" href="../php/TestGraveDetails.php?cmid=96" coords="542,46,568,59" shape="rect">
    <area target="_blank" alt="D23 - No Record" title="D23 - No Record" href="../php/TestGraveDetails.php?cmid=97" coords="208,59,236,75" shape="rect">
    <area target="_blank" alt="D24 - No Record" title="D24 - No Record" href="../php/TestGraveDetails.php?cmid=98" coords="396,59,423,73" shape="rect">
    <area target="_blank" alt="D25 - No Record" title="D25 - No Record" href="../php/TestGraveDetails.php?cmid=99" coords="490,60,526,77" shape="rect">
</map>
<h5> Image Map Generated by http://www.image-map.net/</h5>
</div>
</main>
 <script>
  $(document).ready(function() {
    $('img[usemap]').rwdImageMaps();
  });
  </script>
     <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>

  </body>
</html>