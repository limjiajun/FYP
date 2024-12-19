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
    exit();
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
    <title>CMS - IMAGE MAP BLOCK A</title>
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
<img src="../res/maps/map_A%20%281%29.png" usemap="#image-map">



<map name="image-map">
    <area target="_blank" alt="A1- William Edward Cuznerss" title="A1- William Edward Cuznerss" href="../php/TestGraveDetails.php?cmid=1" coords="107,33,133,47" shape="rect">
    <area target="_blank" alt="A2- Corp Percy Garfield" title="A2- Corp Percy Garfield" href="../php/TestGraveDetails.php?cmid=2" coords="135,32,164,47" shape="rect">
    <area target="_blank" alt="A22 - No Record" title="A22 - No Record" href="../php/TestGraveDetails.php?cmid=81" coords="185,31,210,47" shape="rect">
    <area target="_blank" alt="A3- Ian Alexander Durant" title="A3- Ian Alexander Durant" href="../php/TestGraveDetails.php?cmid=3" coords="212,32,238,47" shape="rect">
    <area target="_blank" alt="A4- William Patrick Duffy" title="A4- William Patrick Duffy" href="../php/TestGraveDetails.php?cmid=4" coords="257,33,283,47" shape="rect">
    <area target="_blank" alt="A23 - No Record" title="A23 - No Record" href="../php/TestGraveDetails.php?cmid=82" coords="284,32,310,45" shape="rect">
    <area target="_blank" alt="A24 - No Record" title="A24 - No Record" href="../php/TestGraveDetails.php?cmid=83" coords="324,32,351,46" shape="rect">
    <area target="_blank" alt="A5- Vivtor Keith" title="A5- Vivtor Keith" href="../php/TestGraveDetails.php?cmid=5" coords="352,31,379,47" shape="rect">
    <area target="_blank" alt="A25 - No Record" title="A25 - No Record" href="../php/mapA_A.php?cmid=84" coords="397,35,426,46" shape="rect">
    <area target="_blank" alt="A6- R_I_Beer" title="A6- R_I_Beer" href="../php/TestGraveDetails.php?cmid=6" coords="428,34,455,45" shape="rect">
    <area target="_blank" alt="A7- L.J.Bane" title="A7- L.J.Bane" href="../php/TestGraveDetails.php?cmid=7" coords="467,30,495,46" shape="rect">
    <area target="_blank" alt="A8- Alexandar" title="A8- Alexandar" href="../php/TestGraveDetails.php?cmid=8" coords="108,47,134,59" shape="rect">
    <area target="_blank" alt="A9- John" title="A9- John" href="../php/TestGraveDetails.php?cmid=9" coords="135,48,163,59" shape="rect">
    <area target="_blank" alt="A10- George Henry Draper" title="A10- George Henry Draper" href="../php/TestGraveDetails.php?cmid=10" coords="210,47,237,60" shape="rect">
    <area target="_blank" alt="A11- Geoffrey Francis Mills" title="A11- Geoffrey Francis Mills" href="../php/TestGraveDetails.php?cmid=40" coords="351,46,379,61" shape="rect">
    <area target="_blank" alt="A12- Capt David Williams" title="A12- Capt David Williams" href="../php/TestGraveDetails.php?cmid=41" coords="469,48,495,59" shape="rect">
    <area target="_blank" alt="A13- Anna Stewart Wright" title="A13- Anna Stewart Wright" href="../php/TestGraveDetails.php?cmid=42" coords="537,45,563,59" shape="rect">
    <area target="_blank" alt="A14- Stacey Louise Rudkin" title="A14- Stacey Louise Rudkin" href="../php/TestGraveDetails.php?cmid=43" coords="63,59,89,73" shape="rect">
    <area target="_blank" alt="A15- Colin John Rowe" title="A15- Colin John Rowe" href="../php/TestGraveDetails.php?cmid=44" coords="107,58,133,72" shape="rect">
    <area target="_blank" alt="A16- William Scott" title="A16- William Scott" href="../php/TestGraveDetails.php?cmid=45" coords="323,59,352,74" shape="rect">
    <area target="_blank" alt="A17- Else Schonberg" title="A17- Else Schonberg" href="../php/TestGraveDetails.php?cmid=46" coords="397,59,426,73" shape="rect">
    <area target="_blank" alt="A18- Arshak Sarkies" title="A18- Arshak Sarkies" href="../php/TestGraveDetails.php?cmid=47" coords="427,60,451,74" shape="rect">
    <area target="_blank" alt="A19- Joseph Smith" title="A19- Joseph Smith" href="../php/TestGraveDetails.php?cmid=48" coords="468,59,496,73" shape="rect">
    <area target="_blank" alt="A20- Frederick Stewart" title="A20- Frederick Stewart" href="../php/TestGraveDetails.php?cmid=49" coords="563,59,592,73" shape="rect">
    <area target="_blank" alt="A21- Frederick Mathieu Stewart" title="A21- Frederick Mathieu Stewart" href="../php/TestGraveDetails.php?cmid=50" coords="33,74,64,89" shape="rect">
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