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
  

 $sqlUserProfile = "SELECT `user_id`, `Image`, `First_name`, `Last_name`, `Gender`, `Email`, `Password`, `Phone_Number`, `Home_Address`, `otp`, `status`, `resettoken`, `resettokenexp`, `user_type` FROM `user_profile`";
    $stmtUserProfile = $conn->prepare($sqlUserProfile);
    $stmtUserProfile->execute();
    $rowsUserProfile = $stmtUserProfile->fetchAll();


    
  
    if (isset($_POST['submit'])) {
       

   $IMAGE = $_FILES['user_image'];
    $img_loc = $_FILES['user_image']['tmp_name'];
    $img_name = $_FILES['user_image']['name'];
    $img_des = "../res/users/".$img_name;
    move_uploaded_file($img_loc,'../res/users/'.$img_name);
            
            
      

        $First_name  = $_POST["First_name"];
        $Last_name = $_POST["Last_name"];
        $Gender = $_POST["Gender"];
        $Email  = $_POST["Email"];
        $Password = sha1($_POST["Password"]);
        $Phone_Number = $_POST['Phone_Number'];
        $Home_Address = $_POST['Home_Address'];
        $otp = rand(10000,99999);
        
        $user_type = !empty($_POST['user_type']) && in_array($_POST['user_type'], ['admin', 'user']) ? $_POST['user_type'] : 'user';
        $status = "inactive";
        $resettokenexp = "";

        $sqlinsert = "INSERT INTO `user_profile` (`Image`, `First_name`, `Last_name`, `Gender`, `Email`, `Password`, `Phone_Number`, `Home_Address`, `otp`, `status`, `resettokenexp`, `user_type`) 
        VALUES ('$img_des', '$First_name', '$Last_name', '$Gender', '$Email', '$Password', '$Phone_Number', '$Home_Address', '$otp', '$status', '$resettokenexp', '$user_type')";

        try {
            $conn->exec($sqlinsert);
            echo "<script>alert('Success')</script>";
            echo "<script>window.location.replace('DataTableUser_A.php')</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Failed')</script>";
            echo "<script>window.location.replace('DataTableUser_A.php')</script>";
        }
    }
} catch (PDOException $e) {
    echo "<script>alert('Failed')</script>";
    echo "<script>window.location.replace('DataTableUser_A.php')</script>";
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
    <title>CMS - Create a New User</title>
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
                  <li>
                    <a href=".php" class="nav-link px-3">
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
                <span>Data Table Contact Form</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container">
<div class="title text-center"><b>Create New User</b></div>
<br>
<br>
        <div class="content">
            <form name="CreateNewUsers.php" action="CreateNewUsers.php" enctype="multipart/form-data" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="user-details">
                             
                
                        
                        
                        <div class="col-md-6 col-sm-12 d-flex flex-column align-items-center">
                            <label class="details"><b>Image</b></label>
                            <img class="img-fluid" src="../images/useravatar.png" style="max-height: 50px; width: auto;" id="user-image" onerror="this.src='../images/useravatar.png'">
                            <input type="file" name="user_image" id="user-input" onchange="previewFile('user-input', 'user-image')" class="form-control" style="width: 50%; margin: 0 auto;">
                        </div>
                        

                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="First_name" id="idfirstname" v class="form-control" placeholder="First Name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="Last_name" id="idlastname"  class="form-control" placeholder="Last Name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="small-select" name="Gender">
                                    <option value="Select" selected>Select</option>
                                    <option value="Male">Male</option>
                            <option value="Female">Female</option>
                                </select>
                            </div>
                            
                        
                            
                            
                            
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="user-details">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="Email" id="idEmail"  class="form-control" placeholder="Enter your Email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="Password" name="Password" id="idPassword"  class="form-control" placeholder="Enter your Password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                 <input type="Password" name="Password" id="idreenterpassword" class="form-control"
                                    placeholder="Confirm your password" required>
                            </div>
                            
                            
                            

                            <div class="mb-3">
                                <label class="form-label">Home Address</label>
                                <textarea class="form-control" rows="3" name="Home_Address" id="idHome_Address" placeholder="Enter your home address" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="button text-center">
    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
</div>

            </form>
        </div>
    </div>
</main>



<script src="./js/jquery-3.5.1.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./js/jquery.dataTables.min.js"></script>
<script src="./js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
<script src="./js/script.js"></script>

<script>
function previewFile(inputId, imageId) {
  const preview = document.getElementById(imageId);
  const file = document.getElementById(inputId).files[0];
  const reader = new FileReader();

  reader.onload = function (e) {
    preview.src = e.target.result;
  };

  if (file) {
    reader.readAsDataURL(file);
  }
}
</script>    

  </body>
  
</html>