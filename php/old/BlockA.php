<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jiajunco_cmd_db2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     session_start();
 $Email = $_SESSION["Email"];
    // Retrieve data from user profile table
    $sqlUserProfile = "SELECT `user_id`, `Image`, `First_name`, `Last_name`, `Gender`, `Email`, `Password`, `Phone_Number`, `Home_Address`, `otp`, `status`, `resettoken`, `resettokenexp`, `user_type` FROM `user_profile`";
    $stmtUserProfile = $conn->prepare($sqlUserProfile);
    $stmtUserProfile->execute();
    $rowsUserProfile = $stmtUserProfile->fetchAll();

    // Get the total count of users
    $totalCount = count($rowsUserProfile);
    
    
    $image_path = ''; // Default image path if not found

if (!empty($rowsUserProfile)) {
    $image_path = $rowsUserProfile[0]['Image'];
}

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
    // Retrieve data from cemetery record table
$sqlCemeteryRecord = "SELECT cr.`Grave_ID`, cr.`Image`, cr.`Image2`, cr.`Name_Deceased`, cr.`Years_of_Born`, cr.`Years_of_Died`, cr.`Location`, cr.`Years_Buried`, a.`unit`, a.`Status`
                      FROM `cemeteryrecord` as cr
                      INNER JOIN `Area` as a ON cr.`Area_id` = a.`Area_id`";
$stmtCemeteryRecord = $conn->prepare($sqlCemeteryRecord);
$stmtCemeteryRecord->execute();
$rowsCemeteryRecord = $stmtCemeteryRecord->fetchAll();


 

   
    $conn = null; // Close the database connection
} catch (PDOException $e) {
    echo $sqlUserProfile . "<br>" . $e->getMessage();
  
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
    <title>CMS  DASHBOARD</title>
    <style>
.grid-container {
  display: grid;
  grid-template-columns: repeat(10, 1fr);
  gap: 10px;
  padding: 10px;
}

.grid-item {
  background-color: #f2f2f2;
  border: 1px solid #ddd;
  padding: 1px;
  font-size: 16px;
  text-align: center;
}
</style>
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
<main class="mt-5 pt-3">
  <div class="container">
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
         <a class="nav-link" href="mapA.php">Block A</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mapB.php">Block B</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mapC.php">Block C</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mapD.php">Block D</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
     <div class="container py-3" id="page-container">
  <h3>Image Map</h3>
  <hr>
<!-- Image Map Generated by http://www.image-map.net/ -->
<img src="https://jiajun0701.com/test/res/maps/map_A%20%281%29.png" usemap="#image-map">

<map name="image-map">
    <area target="_blank" alt="WilliamEdwardCuznerss" title="WilliamEdwardCuznerss" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=1" coords="107,31,132,47" shape="rect">
    <area target="_blank" alt="Corp_Percy_Garfield" title="Corp_Percy_Garfield" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=2" coords="135,32,160,46" shape="rect">
    <area target="_blank" alt="Ian Alexander Durant" title="Ian Alexander Durant" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=3" coords="239,47,212,32" shape="rect">
    <area target="_blank" alt="William Patrick Duffy" title="William Patrick Duffy" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=4" coords="256,34,283,47" shape="rect">
    <area target="_blank" alt="Vivtor_Keith" title="Vivtor_Keith" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=5" coords="351,32,376,47" shape="rect">
    <area target="_blank" alt="R_I_Beer" title="R_I_Beer" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=6" coords="455,45,424,34" shape="rect">
    <area target="_blank" alt="L.J.Bane" title="L.J.Bane" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=7" coords="469,33,494,45" shape="rect">
    <area target="_blank" alt="Alexandar" title="Alexandar" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=8" coords="106,48,135,61" shape="rect">
    <area target="_blank" alt="John" title="John" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=9" coords="136,47,164,61" shape="rect">
    <area target="_blank" alt="I_E_Fitzpatrick" title="I_E_Fitzpatrick" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=10" coords="211,45,239,60" shape="rect">
    <area target="_blank" alt="Capt David Williams" title="Capt David Williams" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=41" coords="350,48,377,60" shape="rect">
    <area target="_blank" alt="Anna Stewart Wright" title="Anna Stewart Wright" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=42" coords="496,60,466,47" shape="rect">
    <area target="_blank" alt="Stacey Louise Rudkin" title="Stacey Louise Rudkin" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=43" coords="564,60,536,46" shape="rect">
    <area target="_blank" alt="Colin John Rowe" title="Colin John Rowe" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=44" coords="64,58,89,73" shape="rect">
    <area target="_blank" alt="William Scott" title="William Scott" href="https://jiajun0701.com/test/php/EditCemeteryRecord.php?cmid=45" coords="107,62,134,73" shape="rect">
    <area target="_blank" alt="Else Schonberg" title="Else Schonberg" href="https://jiajun0701.com/test/php/GraveDetails.php?cmid=46" coords="322,61,351,74" shape="rect">
    <area target="_blank" alt="Arshak Sarkies" title="Arshak Sarkies" href="https://jiajun0701.com/test/php/GraveDetails.php?cmid=47" coords="397,59,426,73" shape="rect">
    <area target="_blank" alt="Joseph smith" title="Joseph smith" href="https://jiajun0701.com/test/php/GraveDetails.php?cmid=48" coords="466,62,495,73" shape="rect">
    <area target="_blank" alt="Frederick Stewart" title="Frederick Stewart" href="https://jiajun0701.com/test/php/GraveDetails.php?cmid=49" coords="588,72,563,59" shape="rect">
    <area target="_blank" alt="Frederick Mathieu Stewart" title="Frederick Mathieu Stewart" href="https://jiajun0701.com/test/php/GraveDetails.php?cmid=50" coords="34,74,62,88" shape="rect">
</map>
</div>
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
    <script src="./js/script.js"></script>
</body>
</html>
