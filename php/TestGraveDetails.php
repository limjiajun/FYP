 <?php
session_start();
include_once("dbconnect.php");
include_once("access_control.php");


if (!isset($_SESSION['user_type'])) {
    echo "<script>alert('Access denied. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
    exit;
}

     session_start();
 $Email = $_SESSION["Email"];
 $user_id = $_SESSION["user_id"];
  $image_path= $_SESSION["Image"];
   
    // Retrieve data from user profile table
    try {

    if (isset($_GET['cmid'])) {
        $cmid = $_GET['cmid'];

        $query = "SELECT cr.`Grave_ID`, cr.`Image`, cr.`Image2`, cr.`Name_Deceased`, cr.`Years_of_Born`, cr.`Years_of_Died`, cr.`Location`, cr.`Years_Buried`, a.`unit`
        FROM `cemeteryrecord` cr
        INNER JOIN `Area` a ON cr.`Area_id` = a.`Area_id`
        WHERE cr.`Grave_ID` = :cmid";

        // Prepare and execute the query
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cmid', $cmid, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the result set as an associative array
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if any rows were returned
        if (count($rows) == 0) {
    // If no rows were returned, show an error message and redirect
    echo "<script>alert('Graves not found.');</script>";
    echo "<script>window.location.replace('TestGraveDetails.php')</script>";
    exit();
} else {
    // Process and display the specific cemetery record
   
            $row = $rows[0]; // Assuming only one row is returned
            $graveID = $row['Grave_ID'];
            $image = $row['Image'];
            $image2 = $row['Image2'];
            $nameDeceased = $row['Name_Deceased'];
            $yearsBorn = $row['Years_of_Born'];
            $yearsDied = $row['Years_of_Died'];
            $location = $row['Location'];
            $yearsBuried = $row['Years_Buried'];
            $unit = $row['unit'];

         
        }
    }  else {
    // If the cmid parameter was not set, show an error message and redirect
  
   
}

} catch (PDOException $e) {
    echo "<script>alert('View failed')</script>";
    echo "<script>window.location.replace('TestGraveDetails.php')</script>";
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
   <title>CMS - Grave Details</title>
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
                    <a href="ContactForm_A.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Contact Form</span>
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
                <span>Data Table Contact Form</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
     <!-- offcanvas -->
    <!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-md">
        <div class="row justify-content-center">
            <div class="card-deck">
                <div class="card border-dark shadow-lg">
                    <div class="row no-gutters">
                        <div class="col-md-3 d-flex flex-column align-items-center justify-content-center">
                            <div class="mb-2">
                                <a href='<?php echo $image; ?>' data-lightbox='image-1'>
                                    <img src="<?php echo $image; ?>" class="card-img-top" style="width:150px; height:150px;" alt="Cemetery Image">
                                </a>
                            </div>
                            <div>
                                <a href='<?php echo $image2; ?>' data-lightbox='image-2'>
                                    <img src="<?php echo $image2; ?>" class="card-img-top" style="width:150px; height:150px;" alt="Persons Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">Grave ID: <?php echo $graveID; ?></h5>
                                <p class="card-text">Name of Deceased: <?php echo $nameDeceased; ?></p>
                                <p class="card-text">Years of Birth: <?php echo $yearsBorn; ?></p>
                                <p class="card-text">Years of Death: <?php echo $yearsDied; ?></p>
                                <p class="card-text">Years Buried: <?php echo $yearsBuried; ?></p>
                                <p class="card-text">Location: <?php echo $location; ?></p>
                                <p class="card-text">Unit: <?php echo $unit; ?></p>
             <div class="text-center">
    <a href="EditCemeteryRecord.php?cmid=<?php echo $cmid; ?>" class="btn btn-primary">Edit</a>
</div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>







<script src="./js/jquery-3.5.1.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./js/jquery.dataTables.min.js"></script>
<script src="./js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
<script src="./js/script.js"></script>



  </body>
  
</html>