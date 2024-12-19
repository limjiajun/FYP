<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jiajunco_cmd_db2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SELECT query to fetch user profile data
    $query = "SELECT `user_id`, `Image`, `First_name`, `Last_name`, `Gender`, `Email`, `Password`, `Phone_Number`, `Home_Address`, `otp`, `status`, `resettoken`, `resettokenexp`, `user_type` FROM `user_profile`";

    $stmt = $conn->query($query);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Retrieve data from the fetched row
    $image_path = $row['Image'];
    $First_name = $row['First_name'];
    $Last_name = $row['Last_name'];
    $Gender = $row['Gender'];
    $Email = $row['Email'];
    $Phone_Number = $row['Phone_Number'];
    $Home_Address = $row['Home_Address'];

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>

<?php
// Assume you have a database connection and other necessary configurations

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId']) && isset($_POST['status'])) {
  $userId = $_POST['userId'];
  $newStatus = $_POST['status'];

  // Perform the necessary database update query based on the $userId and $newStatus values

  // Assume you have retrieved the updated status and otp values from the database
  $updatedStatus = ($newStatus === 'Active') ? 'Active' : 'Inactive';
  $updatedOtp = ($newStatus === 'Active') ? '1' : '0';

  // Prepare the response data
  $responseData = array('status' => $updatedStatus, 'otp' => $updatedOtp);

  // Send the response back to the JavaScript code
  echo json_encode($responseData);
}


?>
