<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jiajunco_cmd_db2";

// Create a new mysqli instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted and the user ID is provided
if (isset($_POST['id'])) {
    // Retrieve the user ID from the form submission
    $id = $_POST['id'];

    // Prepare the SQL statement to delete the user
    $sql = "DELETE FROM `emails` WHERE id = ?";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the user ID parameter
    $stmt->bind_param("i", $id);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // User deleted successfully
        
        
        echo "<script>alert('Email deleted successfully!');</script>";
    echo "<script> window.location.replace('DataTableContactForm.php')</script>";
    } else {
        // Failed to delete the user
        echo "Error deleting user: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Redirect or display an error message if the user ID is not provided
    echo "User ID not provided!";
}

// Close the database connection
$conn->close();
?>