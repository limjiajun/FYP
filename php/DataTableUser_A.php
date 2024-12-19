  <?php
session_start(); 
include_once("dbconnect.php");
include_once("access_control.php");


if (!isset($_SESSION['user_type'])) {
    echo "<script>alert('Access denied. Please login');</script>";
    echo "<script> window.location.replace('loginpage.php')</script>";
    
}

   
 $Email = $_SESSION["Email"];
 $user_id = $_SESSION["user_id"];
 $image_path = $_SESSION["Image"];
    try {
 
  $sqlUserProfile = "SELECT `user_id`, `Image`, `First_name`, `Last_name`, `Gender`, `Email`, `Password`, `Phone_Number`, `Home_Address`, `otp`, `status`, `resettoken`, `resettokenexp`, `user_type` FROM `user_profile`";
    $stmtUserProfile = $conn->prepare($sqlUserProfile);
    $stmtUserProfile->execute();
    $rowsUserProfile = $stmtUserProfile->fetchAll();
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

<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID and status from the form
    if (isset($_POST['user_id']) && isset($_POST['status'])) {
        $userId = $_POST['user_id'];
        $status = $_POST['status'];
$otp = $_POST['otp'];
        // Update the status in the database
       $servername = "localhost";
$username = "root";
$password = "";
$dbname = "jiajunco_cmd_db2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Update the status for the given user ID
            $sql = "UPDATE user_profile SET status = :status,otp = :otp WHERE user_id = :userId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':status', $status);
             $stmt->bindParam(':otp', $otp);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            // Close the database connection
            $conn = null;

            echo "success"; // Return success message to the JavaScript function
        } catch (PDOException $e) {
            echo "error"; // Return error message to the JavaScript function
        }
    }
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
   


 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css"/>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-3lTlkQwf9X0b0GheE1jzY8Yu2wCI4vN/4vyRi1Nfo8ScgW9pKjHCEeUUq3Yi8U6kC/6Xd5U6y5U5EIsjxyW9XQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-4vD0Rlm1yPKdK8W26X0guvCJVa0HqOYJ8sFBnEMsFtBnM3qy3/8Q2XcN9N0Rr1zZ+Sy8WCa1cJyKjTB2ze+/oA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"></script>
    <script src="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"></script>
  
      <style>
div.dataTables_wrapper {
        width: 4000px;
        margin: 0 auto;
    }

</style>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>CMS  - DataTable User</title>
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
       
        
      <div class="row">
  <div class="col-md-12 mb-3">
    <div class="d-flex justify-content-end">
      <form method="POST" action="CreateNewUsers.php">
        <button type="submit" class="btn btn-primary">Create New User</button>
      </form>
    </div>
  </div>
</div>

<section>

        <div class="row">
  <div class="col-md-12 mb-3">
    <div class="card">
      <div class="card-header">
        <span><i class="bi bi-table me-2"></i></span> UserTable
      </div>
      <div class="card-body">
        <div class="table-responsive">
            
            

<table id="example" class="display nowrap" style="width:100%">

            <thead>
              <tr>
                <th>User ID</th>
                <th>Image</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
         
                <th>Phone Number</th>
                <th>Home Address</th>
       
                <th>Status</th>
               
                <th>User Type</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
        <tbody>
    <?php
    $counter = 1;
    foreach ($rowsUserProfile as $rowsUserProfile): ?>
        <tr>
            <td><?php echo $counter++; ?></td>
            <td>
                <a href="<?php echo $image_path = $rowsUserProfile['Image']; ?>" data-lightbox="cemetery-image">
                    <img src="<?php echo $image_path = $rowsUserProfile['Image']; ?>" alt="Image" width="100" height="100">
                </a>
            </td>
            <td><?php echo $rowsUserProfile['First_name']; ?></td>
            <td><?php echo $rowsUserProfile['Last_name']; ?></td>
            <td><?php echo $rowsUserProfile['Gender']; ?></td>
            <td><?php echo $rowsUserProfile['Email']; ?></td>
           
            <td><?php echo $rowsUserProfile['Phone_Number']; ?></td>
            <td><?php echo $rowsUserProfile['Home_Address']; ?></td>
    
            <td><?php echo $rowsUserProfile['status']; ?></td>
      
            <td><?php echo $rowsUserProfile['user_type']; ?></td>
             <td>
            <form method="POST">
                <input type="hidden" name="user_id" value="<?php echo $rowsUserProfile['user_id']; ?>">
                
                <select name="status" onchange="this.form.submit()">
                    <option value="Action" <?php echo $rowsUserProfile['status'] == '' ? 'selected' : ''; ?>>Action</option>
                    <option value="Active" <?php echo $rowsUserProfile['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                    <option value="Inactive" <?php echo $rowsUserProfile['status'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </form>
        </td>
        <td>
           <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $rowsUserProfile['user_id']; ?>" onclick="confirmDelete(<?php echo $rowsUserProfile['user_id']; ?>)">
    Delete
</button>
                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal<?php echo $rowsUserProfile['user_id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this user?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form method="POST" action="delete_user.php" id="deleteForm<?php echo $rowsUserProfile['user_id']; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $rowsUserProfile['user_id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
            <tfoot>
              <tr>
                <th>User ID</th>
                <th>Image</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Home Address</th>
                <th>Status</th>
             
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
       

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>
    </main>
     <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
    
  <!-- Import scripts -->

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
<script src="./js/dataTables.bootstrap5.min.js"></script>
<script src="./js/script.js"></script>

<script>
// Initialize DataTables
$(document).ready(function() {
    console.log("Document is ready");
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        scrollX: true,
    });
});

function confirmDelete(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        // If the user confirms the deletion, submit the form
        document.getElementById("deleteForm" + userId).submit();
    }
}

</script>
<script>
// Event listener for select dropdown change
$(document).on('change', 'select[name="status"]', function() {
  var userId = $(this).closest('tr').data('userid');
  var newStatus = $(this).val();

  // Call the updateStatus() function for both "Active" and "Inactive" statuses
  updateStatus(userId, newStatus);
});
// Function to handle the AJAX request
function updateStatus(userId, newStatus) {
  $.ajax({
    url: 'update_status.php', // Replace with the actual server-side script URL
    method: 'POST',
    data: { userId: userId, status: newStatus },
    success: function(response) {
      // Update the status and otp values in the table
      var rowData = JSON.parse(response);
      var statusCell = $('#example').find('tr[data-userid="' + userId + '"]').find('td:eq(10)');
      var otpCell = $('#example').find('tr[data-userid="' + userId + '"]').find('td:eq(9)');
      statusCell.text(rowData.status);
      otpCell.text(newStatus === 'Inactive' ? '0' : rowData.otp); // Set otp to 0 for "Inactive" status
    },
    error: function() {
      alert('Error occurred. Please try again.');
    }
  });
}

</script>
  </body>
</html>
