<?php

/* Main page with two forms: sign up and log in */
session_start();
require '..\service\DBConnector.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign-Up/Login Form</title>

</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$username = $_POST['username'] ?? null;
	$email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $password_2 = $_POST['password_2'] ?? null;
    
    $usernameSuccess = (is_string($username) && strlen($username) > 2);
	$emailSuccess = (is_string($email) && (strpos($email, '@') !== false));
    $passwordSuccess = ($password === $password_2 && strlen($password) > 7);
	
    if (isset($_POST['login'])) { 			//user logging in
        require 'login.php';      
    }   
    elseif (isset($_POST['register'])) { 	//user registering        
        require 'register.php';      
    }
}
?>
<body>
  <div id="login">   
    <h1>Welcome Back!</h1>
          
     <form action="index.php" method="post">
        <label for="name">Your username :</label>
		<input type="text" name="name" />
		<br/>
		<label for="email">Your email :</label>
		<input type="email" name="email" />
		<br/>
		<label for="password">Password</label>
        <input type="password" name="password"/>
		<br/>	
		<button type="submit" name="login">Log In</button>
          
     </form>
	  </div>

      <div id="register">   
        <h1>Sign Up for Free</h1>
          
        <form action="index.php" method="post">
		
			<?php if (!($usernameSuccess ?? true)) {?>
    		<div>
    			<p> You have an error into your username</p>
    		</div>
    		<?php }?>
		    <label for="name">Your username :</label>
			<input type="text" name="username" value="<?php echo htmlentities($username ?? '')?>"/>
			<br/>
			
			<?php if (!($emailSuccess ?? true)) {?>
    		<div>
    			<p> You have an error into your email</p>
    		</div>
    		<?php }?>
            <label for="email">Email Address</label>
            <input type="email" name="email" value="<?php echo htmlentities($email ?? '')?>"/>
			<br/>
			
			<?php if (!($passwordSuccess ?? true)) {?>
    		<div>
    			<p> You have an error into your password</p>
    		</div>
    		<?php }?>
            <label for="password">Set a password</label>
            <input type="password" name="password"/>
			<br/>
			<label for="password_2">Confirm password</label>
            <input type="password" name="password_2"/>
			<br/>
            <button type="submit" name="register">Register</button>
          
        </form>
      </div>

</body>
</html>
