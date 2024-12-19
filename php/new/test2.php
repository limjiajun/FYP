<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jiajunco_cmd_db2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    session_start();
    $userId = $_SESSION["userId"];
 $Email = $_SESSION["Email"];
    if (count($_POST) > 0) {
        $sql = "SELECT Password FROM user_profile WHERE user_id = ?";
        $statement = $conn->prepare($sql);
        $statement->bindParam(1, $userId);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!empty($row)) {
            $hashedPassword = $row["Password"];
            $currentPassword = sha1($_POST["currentPassword"]);
            $newPassword = sha1($_POST["newPassword"]);
            $confirmPassword = sha1($_POST["confirmPassword"]);

            if ($newPassword !== $confirmPassword) {
                echo "
                    <script>
                        alert('Passwords do not match');
                        window.location.href='index.php';
                    </script>";
                exit;
            }

            if ($hashedPassword === $currentPassword) {
                $update = "UPDATE user_profile SET Password = :newPassword WHERE user_id = :userId";
                $stmt = $conn->prepare($update);
                $stmt->bindParam(':newPassword', $newPassword);
                $stmt->bindParam(':userId', $userId);
                $stmt->execute();
                echo "
                    <script>
                        alert('Password Changed Successfully');
                        window.location.href='index.php';
                    </script>";
                exit;
            } else {
                echo "
                    <script>
                        alert('Current Password is incorrect');
                        window.location.href='index.php';
                    </script>";
                exit;
            }
        }
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
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
    <title>Frontendfunn - Bootstrap 5 Admin Dashboard Template</title>
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
          href="#"
          >Frontendfunn</a
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
              
                <i class="bi bi-person-fill"></i>
                
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="test2.php">change password</a></li>
                <li>
                  <a class="dropdown-item" href="index.php">Logout</a>
                </li>
              </ul>
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
                <span>Layouts</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Dashboard</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-book-fill"></i></span>
                <span>Pages</span>
              </a>
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
    <!-- offcanvas -->
<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form name="frmChange" method="post" action="test2.php" onSubmit="return validatePassword()" class="p-4 bg-light border">

                    <div class="text-center mb-3">
                        <?php if(isset($message)) { echo '<div class="text-danger">' . $message . '</div>'; } ?>
                        <h2 class="mb-4">Change Password</h2>
                    </div>

                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <span id="currentPassword" class="validation-message"></span>
                        <input type="password" name="currentPassword" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <span id="newPassword" class="validation-message"></span>
                        <input type="password" name="newPassword" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <span id="confirmPassword" class="validation-message"></span>
                        <input type="password" name="confirmPassword" class="form-control">
                    </div>

                    <div class="text-center">
                        <input type="submit" name="Submit" value="Submit" class="btn btn-primary">
                    </div>

                </form>
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

<script>
    function validatePassword() {
        var currentPassword, newPassword, confirmPassword, output = true;

        currentPassword = document.frmChange.currentPassword;
        newPassword = document.frmChange.newPassword;
        confirmPassword = document.frmChange.confirmPassword;

        if (!currentPassword.value) {
            currentPassword.focus();
            document.getElementById("currentPassword").innerHTML = "Required";
            output = false;
        }
        else if (!newPassword.value) {
            newPassword.focus();
            document.getElementById("newPassword").innerHTML = "Required";
            output = false;
        }
        else if (!confirmPassword.value) {
            confirmPassword.focus();
            document.getElementById("confirmPassword").innerHTML = "Required";
            output = false;
        }
        if (newPassword.value !== confirmPassword.value) {
            newPassword.value = "";
            confirmPassword.value = "";
            newPassword.focus();
            document.getElementById("confirmPassword").innerHTML = "Passwords do not match";
            output = false;
        }
        return output;
    }
</script>

  </body>
  
</html>