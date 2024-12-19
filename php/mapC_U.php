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
    <title>CMS - IMAGE MAP BLOCK C</title>
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
          href="Dashboard_User.php"
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
<img src="<?php echo $image_path ; ?>" alt="Profile Image" width="20" height="20">  </a>
  <ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="profile_U.php">Profile</a></li>
    <li><a class="dropdown-item" href="ChangePassword_U.php">Change Password</a></li>
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
                    <a href="Dashboard_User.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Dashboard</span>
                    </a>
                  </li>
                  
                  <li>
                    <a href="profile_U.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Profile</span>
                    </a>
                  </li>
                  <li>
                    <a href="ChangePassword_U.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Change Password</span>
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
                    <a href="DataTableCemetery_U.php" class="nav-link px-3">
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
                    <a href="PLOT-A-U.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>PLOT-A</span>
                    </a>
                  </li>
                  <li>
                    <a href="PLOT-B-U.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>PLOT-B</span>
                    </a>
                  </li>
                   <li>
                    <a href="PLOT-C-U.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>PLOT-C</span>
                    </a>
                  </li>
                  <li>
                    <a href="PLOT-D-U.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>PLOT-D</span>
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
                    <a href="mapA_U.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Image Map Block A</span>
                    </a>
                  </li>
                    <li>
                    <a href="mapB_U.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Image Map Block B</span>
                    </a>
                  </li>
                    <li>
                    <a href="mapC_U.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Image Map Block C</span>
                    </a>
                  </li>
                    <li>
                    <a href="mapD_U.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Image Map Block D</span>
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
                    <a href="ContactForm_U.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Contact Form</span>
                    </a>
                  </li>
                 
                  
                </ul>
              </div>
              
            <!--  -->
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
               Location
              </div>
            </li>
           
            <li>
              <a href="Location.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Location</span>
              </a>
            </li>
            
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <!-- offcanvas -->
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
         <a class="nav-link" href="mapA_U.php">Block A</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mapB_U.php">Block B</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mapC_U.php">Block C</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mapD_U.php">Block D</a>
        </li>
      </ul>
    </div>
  </div>
</nav>  
 <div class="container py-3" id="page-container">
  <h3>IMAGE MAP</h3>
  <hr>
<!-- Image Map Generated by http://www.image-map.net/ -->


<img src="../res/maps/map_C%20%281%29.png" usemap="#image-map">
<map name="image-map">
    <area target="_blank" alt="Kenneth William Davies" title="Kenneth William Davies" href="../php/TestGraveDetails-UserView.php?cmid=21" coords="73,25,96,34" shape="rect">
    <area target="_blank" alt="Clement Christopher Denis" title="Clement Christopher Denis" href="../php/TestGraveDetails-UserView.php?cmid=22" coords="93,24,119,36" shape="rect">
    <area target="_blank" alt="Victor Keith Alured Denne" title="Victor Keith Alured Denne" href="../php/TestGraveDetails-UserView.php?cmid=23" coords="127,25,151,34" shape="rect">
    <area target="_blank" alt="Able Seaman John Francis Durnin" title="Able Seaman John Francis Durnin" href="../php/TestGraveDetails-UserView.php?cmid=24" coords="150,25,173,35" shape="rect">
    <area target="_blank" alt="Francis Henry Hawkins" title="Francis Henry Hawkins" href="../php/TestGraveDetails-UserView.php?cmid=25" coords="185,25,206,34" shape="rect">
    <area target="_blank" alt="Pvt A. J. Fee" title="Pvt A. J. Fee" href="../php/TestGraveDetails-UserView.php?cmid=26" coords="208,23,229,35" shape="rect">
    <area target="_blank" alt="W. G. Hignett" title="W. G. Hignett" href="../php/TestGraveDetails-UserView.php?cmid=27" coords="262,25,283,34" shape="rect">
    <area target="_blank" alt="C21 - No Record" title="C21 - No Record" href="../php/TestGraveDetails-UserView.php?cmid=90" coords="238,25,263,35" shape="rect">
    <area target="_blank" alt="Khoo Chye Hong" title="Khoo Chye Hong" href="../php/TestGraveDetails-UserView.php?cmid=28" coords="297,23,319,35" shape="rect">
    <area target="_blank" alt="C22 - No Record" title="C22 - No Record" href="../php/TestGraveDetails-UserView.php?cmid=91" coords="319,24,340,34" shape="rect">
    <area target="_blank" alt="C23 - No Record" title="C23 - No Record" href="../php/TestGraveDetails-UserView.php?cmid=92" coords="353,20,381,36" shape="rect">
    <area target="_blank" alt="B. Hornby" title="B. Hornby" href="../php/TestGraveDetails-UserView.php?cmid=29" coords="38,34,59,46" shape="rect">
    <area target="_blank" alt="Sarah Jane Nissen Houston" title="Sarah Jane Nissen Houston" href="../php/TestGraveDetails-UserView.php?cmid=30" coords="74,36,95,45" shape="rect">
    <area target="_blank" alt="Ethel Mary" title="Ethel Mary" href="../php/TestGraveDetails-UserView.php?cmid=61" coords="94,37,115,45" shape="rect">
    <area target="_blank" alt="Raymond Maurice Barrett" title="Raymond Maurice Barrett" href="../php/TestGraveDetails-UserView.php?cmid=62" coords="128,36,150,46" shape="rect">
    <area target="_blank" alt="Dorothy Bennie" title="Dorothy Bennie" href="../php/TestGraveDetails-UserView.php?cmid=63" coords="153,36,172,46" shape="rect">
    <area target="_blank" alt="Thomas Lyons Beckingham" title="Thomas Lyons Beckingham" href="../php/TestGraveDetails-UserView.php?cmid=64" coords="184,35,206,46" shape="rect">
    <area target="_blank" alt="Mary Elizabeth Booker" title="Mary Elizabeth Booker" href="../php/TestGraveDetails-UserView.php?cmid=65" coords="206,36,229,46" shape="rect">
    <area target="_blank" alt="C24 - No Record" title="C24 - No Record" href="../php/TestGraveDetails-UserView.php?cmid=93" coords="239,37,261,45" shape="rect">
    <area target="_blank" alt="Charles William Booker" title="Charles William Booker" href="../php/TestGraveDetails-UserView.php?cmid=66" coords="262,35,284,46" shape="rect">
    <area target="_blank" alt="Harriett Brooman" title="Harriett Brooman" href="../php/TestGraveDetails-UserView.php?cmid=67" coords="295,35,318,45" shape="rect">
    <area target="_blank" alt="C25 - No Record" title="C25 - No Record" href="../php/TestGraveDetails-UserView.php?cmid=94" coords="340,47,320,35" shape="rect">
    <area target="_blank" alt="James Brooman" title="James Brooman" href="../php/TestGraveDetails-UserView.php?cmid=68" coords="74,46,94,56" shape="rect">
    <area target="_blank" alt=" Eleanor Edith Brown" title=" Eleanor Edith Brown" href="../php/TestGraveDetails-UserView.php?cmid=69" coords="" shape="rect">
    <area target="_blank" alt="Mary Eliza Canning" title="Mary Eliza Canning" href="../php/TestGraveDetails-UserView.php?cmid=70" coords="93,46,118,57" shape="rect">
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