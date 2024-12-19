<?php
session_start();
include_once("dbconnect.php");
include_once("access_control.php");

if (!isset($_SESSION['user_type'])) {
    echo "<script>alert('Access denied. Please login');</script>";
    echo "<script>window.location.replace('login.php');</script>";
    exit;
}

$Email = $_SESSION["Email"];
$user_id = $_SESSION["user_id"];
$image_path = $_SESSION["Image"];


    $cmid = $_GET['cmid'] ?? null;

    $selectQuery = "SELECT cr.`Grave_ID`, cr.`Image`, cr.`Image2`, cr.`Name_Deceased`, cr.`Years_of_Born`, cr.`Years_of_Died`, cr.`Location`, cr.`Years_Buried`, a.`unit`
    FROM `cemeteryrecord` cr
    INNER JOIN `Area` a ON cr.`Area_id` = a.`Area_id`
    WHERE cr.`Grave_ID` = :cmid";

    $stmtSelect = $conn->prepare($selectQuery);
    $stmtSelect->bindParam(':cmid', $cmid);
    $stmtSelect->execute();
    $row = $stmtSelect->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $cmid = $row['Grave_ID'];
        $image_path1 = $row['Image'];
        $image_path2 = $row['Image2'];
        $Name_Deceased = $row['Name_Deceased'];
        $Years_of_Born = $row['Years_of_Born'];
        $Years_of_Died = $row['Years_of_Died'];
        $Years_Buried = $row['Years_Buried'];
        $Location = $row['Location'];
        $unit = $row['unit'];
    } else {
        echo "No record found for cmid: " . $cmid;
    }



    try {

        if (isset($_POST['submit'])) {
            $cmid = $_POST['cmid'];
        if (!empty($_FILES['cemetery_image']['tmp_name'])) {
            $IMAGE = $_FILES['cemetery_image'];
            $img_loc = $_FILES['cemetery_image']['tmp_name'];
            $img_name = $_FILES['cemetery_image']['name'];
            $img_des = "../res/cemeterys/" . $img_name;

            if ($IMAGE['error'] === UPLOAD_ERR_OK) {
                $info = getimagesize($img_loc);
                if ($info !== false) {
                    if (move_uploaded_file($img_loc, $img_des)) {
                        // Update image query
                        $sqlupdate_image = "UPDATE `cemeteryrecord` SET `Image` = :img_des WHERE `Grave_ID` = :cmid";
                        $stmt = $conn->prepare($sqlupdate_image);
                        $stmt->bindParam(':img_des', $img_des);
                        $stmt->bindParam(':cmid', $cmid);
                        $stmt->execute();
                    } else {
                        echo "<script>alert('Failed to move uploaded file')</script>";
                        echo "<script>window.location.replace('DataTableCemetery_A.php')</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('Not an image file')</script>";
                    echo "<script>window.location.replace('DataTableCemetery_A.php')</script>";
                    exit;
                }
            } else {
                echo "<script>alert('File upload error')</script>";
                echo "<script>window.location.replace('DataTableCemetery_A.php')</script>";
                exit;
            }
        }
        if (!empty($_FILES['person_image']['tmp_name'])) {
            $IMAGE2 = $_FILES['person_image'];
            $img_loc2 = $_FILES['person_image']['tmp_name'];
            $img_name2 = $_FILES['person_image']['name'];
            $img_des2 = "../res/persons/".$img_name2;

            if ($IMAGE2['error'] === UPLOAD_ERR_OK) {
                $info = getimagesize($img_loc2);
                if ($info !== false) {
                    if (move_uploaded_file($img_loc2, $img_des2)) {
                        // Update image query
                        $sqlupdate_image2 = "UPDATE `cemeteryrecord` SET `Image2` = :img_des2 WHERE `Grave_ID` = :cmid";
                        $stmt = $conn->prepare($sqlupdate_image2);
                        $stmt->bindParam(':img_des2', $img_des2);
                        $stmt->bindParam(':cmid', $cmid);
                        $stmt->execute();
                    } else {
                        echo "<script>alert('Failed to move uploaded file')</script>";
                        echo "<script>window.location.replace('DataTableCemetery_A.php')</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('Not an image file')</script>";
                    echo "<script>window.location.replace('DataTableCemetery_A.php')</script>";
                    exit;
                }
            } else {
                echo "<script>alert('File upload error')</script>";
                echo "<script>window.location.replace('DataTableCemetery_A.php')</script>";
                exit;
            }
        }
        $Name_Deceased = $_POST["Name_Deceased"];
        $Years_of_Born = date('Y-m-d', strtotime($_POST['Years_of_Born']));
        $Years_of_Died = date('Y-m-d', strtotime($_POST['Years_of_Died']));
        $Location = $_POST["Location"];
        $Years_Buried = $_POST["Years_Buried"];
      
        
        // Update other data query
        $sqlUpdateData = "UPDATE `cemeteryrecord` SET `Name_Deceased` = :Name_Deceased, `Years_of_Born` = :Years_of_Born,
         `Years_of_Died` = :Years_of_Died, `Location` = :Location, `Years_Buried` = :Years_Buried WHERE `Grave_ID` = :cmid";
         $stmtUpdateData = $conn->prepare($sqlUpdateData);
         $stmtUpdateData->bindParam(':Name_Deceased', $_POST["Name_Deceased"]);
         $stmtUpdateData->bindParam(':Years_of_Born', $_POST["Years_of_Born"]);
         $stmtUpdateData->bindParam(':Years_of_Died', $_POST["Years_of_Died"]);
         $stmtUpdateData->bindParam(':Location', $_POST["Location"]);
         $stmtUpdateData->bindParam(':Years_Buried', $_POST["Years_Buried"]);
         $stmtUpdateData->bindParam(':cmid', $cmid);
        $stmtUpdateData->execute();

        echo "<script>alert('Data updated successfully')</script>";
        echo "<script>window.location.replace('DataTableCemetery_A.php')</script>";
        exit;
    }
} catch (PDOException $e) {
    echo "<script>alert('Data updated failed')</script>";
    echo "<script>window.location.replace('Dashboard_Admin.php')</script>";
    exit;
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
    <title>CMS - Update Cemetery Record</title>
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

<?php
// Define default values for variables if they are undefined
$cmid = isset($cmid) ? $cmid : '';
$image_path1 = isset($image_path1) ? $image_path1 : '';
$image_path2 = isset($image_path2) ? $image_path2 : '';
$Name_Deceased = isset($Name_Deceased) ? $Name_Deceased : '';
$Years_of_Born = isset($Years_of_Born) ? $Years_of_Born : '';
$Years_of_Died = isset($Years_of_Died) ? $Years_of_Died : '';

$Years_Buried = isset($Years_Buried) ? $Years_Buried : '';
$Location = isset($Location) ? $Location : '';
$Area_id= isset($Area_id) ? $Area_id : '';
$options= isset($options) ? $options : '';



?>
<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container">
        <div class="title" style="display: flex; flex-direction: column; align-items: center;">
            <h5><b>Edit Grave Details</b></h5>
        </div>
        <div class="content">
            <form name="EditCemeteryRecord.phpForm" action="EditCemeteryRecord.php" enctype="multipart/form-data" method="post">
    <input type="hidden" name="cmid" value="<?php echo htmlspecialchars($cmid); ?>">
    <div class="user-details">
        <div class="row">
            <div class="col-md-6 col-sm-12 d-flex flex-column align-items-center">
                <label class="details"><b>Cemetery</b></label>
                <img class="img-fluid" src="<?php echo htmlspecialchars($image_path1); ?>" style="max-height: 160px; width: auto;" id="cemetery-image" onerror="this.src='../images/useravatar.png'">
                <input type="file" name="cemetery_image" id="cemetery-input" onchange="previewFile('cemetery-input', 'cemetery-image')" class="form-control" style="width: 50%; margin: 0 auto;">
            </div>
            <div class="col-md-6 col-sm-12 d-flex flex-column align-items-center">
                <label class="details"><b>Person</b></label>
                <img class="img-fluid" src="<?php echo htmlspecialchars($image_path2); ?>" style="max-height: 160px; width: auto;" id="person-image" onerror="this.src='../images/useravatar.png'">
                <input type="file" name="person_image" id="person-input" onchange="previewFile('person-input', 'person-image')" class="form-control" style="width: 50%; margin: 0 auto;">
            </div>
        </div>
        <div class="user-details" style="display: flex; flex-direction: column; align-items: center;">
            <div class="input-box" style="width: 50%;">
                <label class="details"><b>Name_Deceased</b></label>
                <input type="text" name="Name_Deceased" id="idName_Deceased" value="<?php echo htmlspecialchars($Name_Deceased); ?>" placeholder="Name_Deceased" required class="form-control">
            </div>
            <div class="input-box" style="width: 50%;">
                <label><b>Years_Buried</b></label>
                <input type="text" name="Years_Buried" id="idYears_Buried" value="<?php echo htmlspecialchars($Years_Buried); ?>" placeholder="Years_Buried" readonly required class="form-control">
            </div>
            <div class="input-box" style="width: 50%;">
                <label><b>Years_of_Born</b></label>
                <input type="date" name="Years_of_Born" class="form-control" value="<?php echo htmlspecialchars($Years_of_Born); ?>" onchange="calculateYearsBuried()">
            </div>
            <div class="input-box" style="width: 50%;">
                <label><b>Years_of_Died</b></label>
                <input type="date" name="Years_of_Died" class="form-control" value="<?php echo htmlspecialchars($Years_of_Died); ?>" onchange="calculateYearsBuried()">
            </div>
            <div class="input-box" style="width: 50%;">
                <label><b>Block-Unit</b></label>
                <select class="form-control form-control-sm" id="block-select" name="Area_id" readonly required>
                    <!-- Display the selected value -->
                    <option value="<?php echo $Area_id; ?>"><?php echo $unit; ?></option>
                </select>
            </div>
            <div class="input-box" style="width: 50%;">
                <label><b>Location</b></label>
                <textarea class="form-control" rows="3" name="Location" id="idLocation" required><?php echo htmlspecialchars($Location); ?></textarea>
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
  window.addEventListener('DOMContentLoaded', () => {
    calculateYearsBuried();
  });

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