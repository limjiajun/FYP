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
      <title>CMS - IMAGE MAP BLOCK B</title>
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


<img src="../res/maps/map_B%20%281%29.png" usemap="#image-map">

<map name="image-map">
    <area target="_blank" alt="Kenneth William Davies" title="Kenneth William Davies" href="../php/TestGraveDetails-UserView.php?cmid=21" coords="97,31,126,44" shape="rect">
    <area target="_blank" alt="B21 - No Record" title="B21 - No Record" href="../php/TestGraveDetails-UserView.php?cmid=85" coords="126,31,152,44" shape="rect">
    <area target="_blank" alt="B22 - No Record" title="B22 - No Record" href="../php/TestGraveDetails-UserView.php?cmid=86" coords="171,29,196,46" shape="rect">
    <area target="_blank" alt="Cpl W C Byde" title="Cpl W C Byde" href="../php/TestGraveDetails-UserView.php?cmid=12" coords="198,31,225,43" shape="rect">
    <area target="_blank" alt="WO F. Cain" title="WO F. Cain" href="../php/TestGraveDetails-UserView.php?cmid=13" coords="240,29,269,45" shape="rect">
    <area target="_blank" alt="B23 - No Record" title="B23 - No Record" href="../php/TestGraveDetails-UserView.php?cmid=87" coords="266,31,296,43" shape="rect">
    <area target="_blank" alt="B24 - No Record" title="B24 - No Record" href="../php/TestGraveDetails-UserView.php?cmid=88" coords="313,29,342,45" shape="rect">
    <area target="_blank" alt="B25 - No Record" title="B25 - No Record" href="../php/TestGraveDetails-UserView.php?cmid=89" coords="340,31,369,45" shape="rect">
    <area target="_blank" alt="Corp R. Carus" title="Corp R. Carus" href="../php/TestGraveDetails-UserView.php?cmid=14" coords="384,30,412,44" shape="rect">
    <area target="_blank" alt="R. C. F. Cooper" title="R. C. F. Cooper" href="../php/TestGraveDetails-UserView.php?cmid=15" coords="412,29,437,45" shape="rect">
    <area target="_blank" alt="Hiepke Tan Crommers" title="Hiepke Tan Crommers" href="../php/TestGraveDetails-UserView.php?cmid=16" coords="483,28,512,46" shape="rect">
    <area target="_parent" alt="Michael Vaughan Curtis" title="Michael Vaughan Curtis" href="../php/TestGraveDetails-UserView.php?cmid=17" coords="529,31,569,46" shape="rect">
    <area target="_blank" alt="Zuxin Dai" title="Zuxin Dai" href="../php/TestGraveDetails-UserView.php?cmid=18" coords="98,45,125,56" shape="rect">
    <area target="_blank" alt="Joseph Dass" title="Joseph Dass" href="../php/TestGraveDetails-UserView.php?cmid=19" coords="197,45,226,59" shape="rect">
    <area target="_blank" alt="David Anthony Dass" title="David Anthony Dass" href="../php/TestGraveDetails-UserView.php?cmid=20" coords="241,45,270,59" shape="rect">
    <area target="_blank" alt="Ghin Hye Tan" title="Ghin Hye Tan" href="../php/TestGraveDetails-UserView.php?cmid=51" coords="312,45,341,57" shape="rect">
    <area target="_blank" alt="Ghin Chong Tan" title="Ghin Chong Tan" href="../php/TestGraveDetails-UserView.php?cmid=52" coords="340,45,367,59" shape="rect">
    <area target="_blank" alt="Maria F.F Mathieu Stewart" title="Maria F.F Mathieu Stewart" href="../php/TestGraveDetails-UserView.php?cmid=53" coords="385,46,413,59" shape="rect">
    <area target="_blank" alt="Molly Alice Eckersall Toolseram" title="Molly Alice Eckersall Toolseram" href="../php/TestGraveDetails-UserView.php?cmid=54" coords="414,43,440,58" shape="rect">
    <area target="_blank" alt="Capt Stephen Charles Toolseram" title="Capt Stephen Charles Toolseram" href="../php/TestGraveDetails-UserView.php?cmid=55" coords="457,46,484,58" shape="rect">
    <area target="_blank" alt="Kanagasabapathy Vanniasingham" title="Kanagasabapathy Vanniasingham" href="../php/TestGraveDetails-UserView.php?cmid=56" coords="485,46,512,59" shape="rect">
    <area target="_blank" alt="John Charles William Weber" title="John Charles William Weber" href="../php/TestGraveDetails-UserView.php?cmid=57" coords="28,58,54,72" shape="rect">
    <area target="_blank" alt="Nathan Kesagar Vanniasingham" title="Nathan Kesagar Vanniasingham" href="../php/TestGraveDetails-UserView.php?cmid=58" coords="52,59,84,71" shape="rect">
    <area target="_blank" alt="Lucy Nallammah Vanniasingham" title="Lucy Nallammah Vanniasingham" href="../php/TestGraveDetails-UserView.php?cmid=59" coords="98,59,127,72" shape="rect">
    <area target="_blank" alt="Regina Stewart Weber" title="Regina Stewart Weber" href="../php/TestGraveDetails-UserView.php?cmid=60" coords="171,59,196,71" shape="rect">
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