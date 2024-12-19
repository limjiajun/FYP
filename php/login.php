<?php
include 'dbconnect.php';
?>
<?php

session_start();
if (isset($_POST['LOGIN'])) {
   // include 'dbconnect.php';
  
    $Email = $_POST['Email'];
    $Password = sha1($_POST['Password']);
    $otp = '1';
    
    
    
    $sqllogin = "SELECT * FROM user_profile WHERE Email = '$Email' AND Password= '$Password' AND otp='$otp'";

    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        $user_id = $user['user_id'];
        $First_name = $user['First_name'];
        $Last_name = $user['Last_name'];
        $image_path = $user['Image'];
        $user_type = $user["user_type"];
        
        
        $Gender= $user['Gender'];
        $Email = $user['Email'];
        $Password = $user['Password'];
        $Phone_Number = $user['Phone_Number'];
        $Home_Address = $user['Home_Address'];


//SELECT `user_id`, `Image`, `First_name`, `Last_name`, `Gender`, `Email`, `Password`, `Phone_Number`, `Home_Address`, 
//`otp`, `resettoken`, `resettokenexp`, `user_type` FROM `user_profile` WHERE 1

       
        $_SESSION["sessionid"] = session_id();
        $_SESSION["user_id"] = $user_id;
        $_SESSION["Email"] = $Email;
        $_SESSION['First_name'] = $First_name;
        $_SESSION['Last_name'] = $Last_name;
        $_SESSION['Image'] = $image_path;
        
        $_SESSION["Gender"] = $Gender;
        $_SESSION['Password'] = $Password;
        $_SESSION['Phone_Number'] = $Phone_Number;
        $_SESSION['Home_Address'] = $Home_Address;
        $_SESSION['user_type'] = $user_type;

        
        



        if ($user_type == "user") {
            echo "<script>alert('Login success');</script>";
            echo "<script>window.location.replace('Dashboard_User.php')</script>";
        } elseif ($user_type == "admin") {
            echo "<script>alert('Login success');</script>";
            echo "<script>window.location.replace('Dashboard_Admin.php')</script>";
        } else {
            echo "<script>alert('Login failed: Invalid user type');</script>";
            echo "<script>window.location.replace('login.php')</script>";
        }
    } else {
        echo "<script>alert('Login failed');</script>";
        echo "<script>window.location.replace('login.php')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CMS TEst</title>

  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

 
  <link rel="stylesheet" href="./assets/css/style-index.css">

 
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
  
  
    <link rel="stylesheet" href="../css/style-login.css">
    
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
   
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Montserrat:wght@600&display=swap"
      rel="stylesheet"
    />
  </head>
  <style> @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: none;
    text-decoration: none;
    border: none;
    list-style: none;
    transition: all 0.3s cubic-bezier(0.16, 0.8, 0.62, 1.52);
    text-transform: capitalize;
    font-family: 'Roboto', sans-serif;
}

html{
    font-size: 62.5%;
    overflow-x: hidden;
}

:root{
    --blue: #5e84fb;
    --black: #2a333d;
}

body{
    background-color: #f9f9f9;
}

header{
    width: 100%;
    background-color: #fff;
    align-items: center;
    justify-content: space-between;
    display: flex;
    top: 0;
    left: 0;
    z-index: 400;
    padding: 2.5rem 7%;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
}

header .logo{
    font-size: 24px;
    font-weight: 800;
    color: #666;
}

header .logo span{
    color: var(--blue);
}

header .navbar ul{
    text-align: center;
    justify-content: center;
    display: flex;
}

header .navbar ul li{
    margin-left: 23px;
}

header .navbar ul li a{
    margin-left: 3px;
    border-radius: 5px;
    color: #999;
    padding: 5px 15px;
    font-size: 16px;
}

header .navbar ul li a.active, header .navbar ul li a:hover{
    color: #fff;
    background: var(--blue);
}

#menu{
    font-size: 30px;
    color: #999;
    cursor: pointer;
    display: none;
}

@media(max-width: 991px){
    html{
        font-size: 55%;
    }
}

@media(max-width: 768px){
    #menu{
        display: block;
    }
    header .navbar{
        position: fixed;
        top: 8rem;
        left: -120%;
        height: 100%;
        width: 100%;
        background: #eee;
        border-top: .2rem solid #0000001a;
    }
    header .navbar ul{
        flex-flow: column;
        padding: 16px;
    }
    header .navbar ul li{
        text-align: center;
        width: 100%;
        margin: 9px 0;
    }
    header .navbar ul a{
        display: block;
        padding: 8px;
    }
    header .navbar ul a.active, header .navbar ul a:hover{
        padding: 8px;
        color: #fff;
        background: var(--blue);
        border: none;
        border-radius: 35px;
    }
    header .navbar.nav-toggle{
        left: 0;
    }
    .fa-times{
        transform: rotate(180deg);
    }
}

/* Added style to prevent automatic capitalization of the first letter in your email and password fields. */
input[type="email"], input[type="password"]{
    text-transform: none;
}
</style>
  <body>

 <script src = "js/login.js"></script>

  <body onload = "loadCookies()">
      <header>

      <img src="../assets/images/Logo123.png" alt="CMS logo" width="100">
      <div id="menu" class="fas fa-bars"></div>
      <nav class="navbar">
        <ul>
          <li><a class="active" href="index.html">Home</a></li>
          <li><a href="About.html">About</a></li>
          <li><a href="Contact.html">Contact Us</a></li>
          <li><a href="Location.html">Location</a></li>
          <li><a href="login.php">Login</a></li>
          <li><a href="re.php">Sign Up</a></li>
        </ul>
      </nav>
   

</header>

    <div class="wrapper">
      <div class="title">Login Form</div>
      <form name="loginForm" action="login.php" method="post">
        <div class="field">
          <input  type="Email" name="Email" id="idemail"
                         required>
          <label>Email Address</label>
        </div>

        <div class="field">
          <input type="password" name="Password" id="idpassword"
                         required>
          <label>Password</label>

        </div>
        <div class="content">
          <div class="checkbox">
            <input type="checkbox"  name="rememberme" type="checkbox" id="idremember" onclick="rememberMe()">
            <label for="remember-me">Remember me</label>
          </div>


          

          <div class="pass-link"><a href="forgotPassword.php">Forgot password?</a></div>
        </div>
        <div class="field">
        <input type="submit" name="LOGIN"  value="LOGIN">
        
        </div>
        <div class="signup-link">Not a member? <a href="re.php">Signup now</a></div>
      </form>
    </div>
  
    
    

    <!-- top navigation bar -->
    <!-- offcanvas -->
  
    
    
     <script>
    let cookieConsent = getCookie("user_cookie_content");
    if (cookieConsent != ""){
      document.getElementById("cookieNotice").style.display = "none";
    } else {
      document.getElementById("cookieNotice").style.display = "block";
    }
  </script>
  

  
  

  
  </body>
</html>