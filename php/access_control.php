<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once("dbconnect.php");

if (!isset($_SESSION['sessionid']) || !isset($_SESSION['user_type'])) {
    echo "<script>alert('Access denied. Please login');</script>";
    echo "<script> window.location.replace('loginpage.php')</script>";
    exit;
}

$adminPages = [
    "Dashboard_Admin.php",
    "profile_A.php",
    "ChangePassword_A.php",
    "DataTableUser_A.php",
    "TestGraveDetails.php",
    "DataTableCemetery_A.php",
    "DataTableContactForm.php",
    
    "ContactForm_A.php",
    "CreateNewUsers.php",
    "AddCemeteryRecord.php",
    "mapA_A.php",
    "mapB_A.phpp",
    "mapC_A.php",
    "mapD_A.php",
    "PLOT-A.php",
    "PLOT-B.php",
    "PLOT-C.php",
    "PLOT-D.php",
    

];

$userPages = [
    "Dashboard_User.php",
    "profile_U.php",
    "ChangePassword_U.php",
    "Location.php",
    
    "TestGraveDetails-UserView.php",
    "DataTableCemetery_U.php",
    "ContactForm_U.php",
    "mapA_U.php",
    "mapB_U.phpp",
    "mapC_U.php",
    "mapD_U.php",
     "PLOT-A-U.php",
    "PLOT-B-U.php",
    "PLOT-C-U.php",
    "PLOT-D-U.php",
    
   
];

$currentFile = basename($_SERVER['PHP_SELF']);
if ($_SESSION['user_type'] === "admin" && in_array($currentFile, $userPages)) {
    echo "<script>alert('Access denied. Unauthorized access');</script>";
    echo "<script> window.location.replace('Dashboard_Admin.php')</script>";
    exit;
}

if ($_SESSION['user_type'] === "user" && in_array($currentFile, $adminPages)) {
    echo "<script>alert('Access denied. Unauthorized access');</script>";
    echo "<script> window.location.replace('Dashboard_User.php')</script>";
    exit;
}
?>
