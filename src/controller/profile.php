<?php
/* to get user information and some messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}
else {
    // Makes it easier to read
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= $username ?></title>
</head>

<body>
  <div class="form">
          <h1>Welcome</h1>       
          <p>
          <?php 
     
          // Display message about account verification
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              
              // to not annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }         
          ?>
          </p>
          
          <h2><?php echo $username; ?></h2>
          <p><?= $email ?></p>        
          <a href="logout.php"><button name="logout">Log Out</button></a>

  </div>

</body>
</html>
