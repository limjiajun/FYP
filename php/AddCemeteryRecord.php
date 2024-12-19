
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

try {
    

 $cmid = isset($_GET['cmid']) ? $_GET['cmid'] : null;
 
    $selectQuery = "SELECT cr.`Grave_ID`, cr.`Image`, cr.`Image2`, cr.`Name_Deceased`, cr.`Years_of_Born`, cr.`Years_of_Died`, cr.`Location`, cr.`Years_Buried`, a.`unit`
    FROM `cemeteryrecord` cr
    INNER JOIN `Area` a ON cr.`Area_id` = a.`Area_id`
    WHERE cr.`Grave_ID` = :cmid";

$stmtSelect = $conn->prepare($selectQuery);
$stmtSelect->bindParam(':cmid', $cmid);
$stmtSelect->execute();
$row = $stmtSelect->fetch(PDO::FETCH_ASSOC);

// Check if a record was found for the given cmid
if ($row) {
   $cmid = $row['Grave_ID'];
    $image_path1 = $row['Image'];
    $image_path2 = $row['Image2'];
    $nameDeceased = $row['Name_Deceased'];
    $yearsBorn = $row['Years_of_Born'];
    $yearsDied = $row['Years_of_Died'];
    $location = $row['Location'];
    $yearsBuried = $row['Years_Buried'];
    $unit = $row['unit'];
} else {
    // No record found for the given cmid, handle the error or redirect to an error page
    echo "No record found for cmid: " . $cmid;
    // You can redirect the user to an error page using header() function
    // header("Location: error.php");
  
}
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>




<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jiajunco_cmd_db2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $Email = $_SESSION["Email"];

    // Retrieve available areas
    $areaQuery = "SELECT * FROM Area WHERE Status = 'Available'";
    $stmt = $conn->query($areaQuery);
    $availableAreas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if query execution was successful
    if ($availableAreas) {
        // Build the select options with the available areas
        $options = '<option value="Select" selected>Select</option>';

        foreach ($availableAreas as $area) {
            $area_id = $area['Area_id'];
            $block_id = $area['Block_id'];
            $unit = $area['unit'];

            $options .= '<option value="' . $area_id . '">' . $unit . '</option>';
        }
    } else {
        // Display an error message if query execution fails
        echo "Error retrieving available areas: " . $conn->errorInfo()[2];
    }

 if (isset($_POST['submit'])) {
    // Code to handle form submission
    
    $IMAGE = $_FILES['cemetery_image'];
    $img_loc = $_FILES['cemetery_image']['tmp_name'];
    $img_name = $_FILES['cemetery_image']['name'];
    $img_des = "../res/cemeterys/".$img_name;
    move_uploaded_file($img_loc,'../res/cemeterys/'.$img_name);
    
  $IMAGE2 = $_FILES['person_image'];
$img_loc2 = $_FILES['person_image']['tmp_name'];
$img_name2 = $_FILES['person_image']['name'];
$img_des2 = "../res/persons/".$img_name2;
move_uploaded_file($img_loc2,'../res/persons/'.$img_name2);

    $Name_Deceased = $_POST["Name_Deceased"];
    $Years_of_Born = date('Y-m-d', strtotime($_POST['Years_of_Born']));
    $Years_of_Died = date('Y-m-d', strtotime($_POST['Years_of_Died']));
    $Location = $_POST["Location"];
    $Years_Buried = $_POST["Years_Buried"];
    $Area_id = $_POST["Area_id"];
    
    // Update the status of the selected area to 'unavailable'
    $updateQuery = "UPDATE Area SET Status = 'unavailable' WHERE Area_id = :area_id";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':area_id', $Area_id);
  
    try {
        $stmt->execute();

        $sqlinsert = "INSERT INTO `cemeteryrecord`(`Image`, `Image2`, `Name_Deceased`, `Years_of_Born`, `Years_of_Died`, `Location`, `Years_Buried`, `Area_id`) 
        VALUES ('$img_des', '$img_des2', '$Name_Deceased', '$Years_of_Born', '$Years_of_Died', '$Location', '$Years_Buried', '$Area_id')";
        
        try {
            $conn->exec($sqlinsert);
            echo "<script>alert('Success')</script>";
            echo "<script>window.location.replace('AddCemeteryRecord.php')</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Insert Failed');</script>";
            echo "<script>window.location.replace('AddCemeteryRecord.php')</script>";
        }
    } catch (PDOException $e) {
        echo "Error updating area status: " . $e->getMessage();
        exit();
    }
}

} catch (PDOException $e) {
    echo "<script>alert('Update failed')</script>";
    echo "<script>window.location.replace('AddCemeteryRecord.php')</script>";
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
    <title>CMS - Create Cemetery Record</title>
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
    <li><a class="dropdown-item" href="profile_A.php">Profile</a></li>
    <li><a class="dropdown-item" href="ChangePassword_A.php">Change Password</a></li>
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

    <!-- offcanvas -->
<?php
// Define default values for variables if they are undefined
$graveID = isset($graveID) ? $graveID : '';
$image = isset($image) ? $image : '';
$image2 = isset($image2) ? $image2 : '';
$nameDeceased = isset($nameDeceased) ? $nameDeceased : '';
$yearsBorn = isset($yearsBorn) ? $yearsBorn : '';
$yearsDied = isset($yearsDied) ? $yearsDied : '';
$location = isset($location) ? $location : '';
$yearsBuried = isset($yearsBuried) ? $yearsBuried : '';
$areaID = isset($areaID) ? $areaID : '';

?>


<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container">
        <div class="title" style="display: flex; flex-direction: column; align-items: center;"><h5><b>Add Cemetery</h5></b></div>
        <div class="content">
            <form name="AddCemeteryRecord.phpForm" action="AddCemeteryRecord.php" enctype="multipart/form-data" method="post">
                <div class="user-details">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 d-flex flex-column align-items-center">
                            <label class="details"><b>Cemetery</b></label>
                            <img class="img-fluid" src="../images/useravatar.png" style="max-height: 50px; width: auto;" id="cemetery-image" onerror="this.src='../images/useravatar.png'">
                            <input type="file" name="cemetery_image" id="cemetery-input" onchange="previewFile('cemetery-input', 'cemetery-image')" class="form-control" style="width: 50%; margin: 0 auto;">
                        </div>

                        <div class="col-md-6 col-sm-12 d-flex flex-column align-items-center">
                            <label class="details"><b>Person</b></label>
                            <img class="img-fluid" src="../images/useravatar.png" style="max-height: 50px; width: auto;" id="person-image" onerror="this.src='../images/useravatar.png'">
                            <input type="file" name="person_image" id="person-input" onchange="previewFile('person-input', 'person-image')" class="form-control" style="width: 50%; margin: 0 auto;">
                        </div>
                    </div>

                    <div class="user-details" style="display: flex; flex-direction: column; align-items: center;">
                        <div class="input-box" style="width: 50%;">
                            <label class="details"><b>Name_Deceased</b></label>
                            <input type="text" name="Name_Deceased" id="idName_Deceased" placeholder="Name_Deceased" required class="form-control">
                        </div>
                        <div class="input-box" style="width: 50%;">
                            <label class="details">Years_Buried</label>
                            <input type="text" name="Years_Buried" id="idYears_Buried" placeholder="Years_Buried" readonly required class="form-control">
                        </div>
                        <div class="input-box" style="width: 50%;">
                            <label><b>Years_of_Born</b></label>
                            <input type="date" name="dateofbirth" class="form-control" onchange="calculateYearsBuried()">
                        </div>
                        <div class="input-box" style="width: 50%;">
                            <label><b>Years_of_Died</b></label>
                            <input type="date" name="Years_of_Died" class="form-control" onchange="calculateYearsBuried()">
                        </div>
                        <div class="input-box" style="width: 50%;">
                            <label><b>Block-Unit</b></label>
                         <select class="form-control form-control-sm" id="block-select" name="Area_id">

                                <!-- Populate options with available blocks -->
                                <?php echo $options; ?>
                            </select>
                        </div>
                        <div class="input-box" style="width: 50%;">
                            <label><b>Location</b></label>
                            <textarea class="form-control" rows="3" name="Location" id="idLocation" placeholder="Enter your Location" required></textarea>
                        </div>
                    </div>
                </div>
                <br>
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
<script>
  function calculateYearsBuried() {
    const dateOfBirthInput = document.querySelector('input[name="dateofbirth"]');
    const dateOfDiedInput = document.querySelector('input[name="Years_of_Died"]');
    const yearsBuriedInput = document.querySelector('input[name="Years_Buried"]');

    const dateOfBirth = new Date(dateOfBirthInput.value);
    const dateOfDied = new Date(dateOfDiedInput.value);

    if (dateOfBirth && dateOfDied && dateOfDied > dateOfBirth) {
      const yearsBuried = dateOfDied.getFullYear() - dateOfBirth.getFullYear();
      yearsBuriedInput.value = yearsBuried;
    } else {
      yearsBuriedInput.value = "";
    }
  }
</script>         



  </body>
  
</html>