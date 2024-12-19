  <?php
session_start();
include_once("dbconnect.php");
include_once("access_control.php");


if (!isset($_SESSION['user_type'])) {
    echo "<script>alert('Access denied. Please login');</script>";
    echo "<script> window.location.replace('loginpage.php')</script>";
    exit;
}

     
 $Email = $_SESSION["Email"];
 $user_id = $_SESSION["user_id"];
 $image_path = $_SESSION["Image"];


$stmt = $conn->prepare("SELECT * FROM `user_profile` WHERE `user_id` = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    // Access your data
    $First_name = $row['First_name'];
    
        $Last_name = $row["Last_name"];
        $Gender = $row["Gender"];
        $Email = $row["Email"];
        $Phone_Number = $row['Phone_Number'];
        $Home_Address = $row['Home_Address'];
    
}



    try {

    if (isset($_POST['Update'])) {
        if (!empty($_FILES['image']['name'])) {
            $IMAGE = $_FILES['image'];
            $img_loc = $_FILES['image']['tmp_name'];
            $img_name = $_FILES['image']['name'];
            $img_des = "../res/users/" . $img_name;

            if ($IMAGE['error'] === UPLOAD_ERR_OK) {
                $info = getimagesize($img_loc);
                if ($info !== false) {
                    if (move_uploaded_file($img_loc, $img_des)) {
                        // Update image query
                        $sqlupdate_image = "UPDATE `user_profile` SET `Image`=:img_des WHERE `user_id`=:user_id";

                        $stmt = $conn->prepare($sqlupdate_image);
                        $stmt->bindParam(':img_des', $img_des);
                        $stmt->bindParam(':user_id', $user_id);
                        $stmt->execute();
                    } else {
                        echo "<script>alert('Failed to move uploaded file')</script>";
                        echo "<script>window.location.replace('dashboarduserpage.php')</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('Not an image file')</script>";
                    echo "<script>window.location.replace('dashboarduserpage.php')</script>";
                    exit;
                }
            } else {
                echo "<script>alert('File upload error')</script>";
                echo "<script>window.location.replace('dashboarduserpage.php')</script>";
                exit;
            }
        }

        $First_name = $_POST["First_name"];
        $Last_name = $_POST["Last_name"];
        $Gender = $_POST["Gender"];
        $Email = $_POST["Email"];
        $Phone_Number = $_POST['Phone_Number'];
        $Home_Address = $_POST['Home_Address'];

        // Update other data query
        $sqlupdate_data = "UPDATE `user_profile` SET `First_name`=:First_name, `Last_name`=:Last_name, `Gender`=:Gender,
        `Email`=:Email,`Phone_Number`=:Phone_Number, `Home_Address`=:Home_Address WHERE `user_id`=:user_id";

        $stmt = $conn->prepare($sqlupdate_data);
        $stmt->bindParam(':First_name', $First_name);
        $stmt->bindParam(':Last_name', $Last_name);
        $stmt->bindParam(':Gender', $Gender);
        $stmt->bindParam(':Email', $Email);
        $stmt->bindParam(':Phone_Number', $Phone_Number);
        $stmt->bindParam(':Home_Address', $Home_Address);
        $stmt->bindParam(':user_id', $user_id);

        $stmt->execute();

        echo "<script>alert('Update successful')</script>";
        echo "<script>window.location.replace('profile_U.php')</script>";
    }
} catch (PDOException $e) {
    echo "<script>alert('Update failed')</script>";
    echo "<script>window.location.replace('Dashboard_User.php')</script>";
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
    <title>CMS - Edit Profile</title>
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
<?php
// Define default values for variables if they are undefined
$image_path = isset($image_path) ? $image_path : '';
$First_name = isset($First_name) ? $First_name : '';
$Last_name = isset($Last_name) ? $Last_name : '';
$Gender = isset($Gender) ? $Gender : 'Select';
$Phone_Number = isset($Phone_Number) ? $Phone_Number : '';
$Home_Address = isset($Home_Address) ? $Home_Address : '';
?>
<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container">
        <div class="title">Profile</div>
        <div class="content">
            <form name="profile_U.php" action="profile_U.php" enctype="multipart/form-data" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="user-details">
                            <div class="w-100 text-center">
                                <img class="img-fluid" src="<?php echo $image_path; ?>" style="max-height: 50px; width: auto;" onerror="this.src='../images/useravatar.png'">
                                <input type="file" name="image" id="" onchange="previewFile()">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="First_name" id="idfirstname" value="<?php echo $First_name ?>" class="form-control" placeholder="First Name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="Last_name" id="idlastname" value="<?php echo $Last_name ?>" class="form-control" placeholder="Last Name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="small-select" name="Gender">
                                    <option value="Select" <?php if ($Gender == "Select") echo ' selected="selected"'; ?>>Select</option>
                                    <option value="Male" <?php if ($Gender == "Male") echo ' selected="selected"'; ?>>Male</option>
                                    <option value="Female" <?php if ($Gender == "Female") echo ' selected="selected"'; ?>>Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="user-details">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="Email" id="idEmail" value="<?php echo $Email ?>" class="form-control" placeholder="Enter your Email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="Phone_Number" id="idphonenumber" value="<?php echo $Phone_Number ?>" class="form-control" placeholder="Enter your phone number" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Home Address</label>
                                <textarea class="form-control" rows="3" name="Home_Address" id="idHome_Address" placeholder="Enter your home address" required><?php echo $Home_Address ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="button text-center">
    <input type="submit" name="Update" value="Update" class="btn btn-primary">
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
        function previewFile() {
            const preview = document.querySelector('.w3-image');
            const file = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                // convert image file to base64 string
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>      

  </body>
  
</html>