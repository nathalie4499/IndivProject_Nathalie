<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password1 = $_POST['password1'] ?? null;
    $password2 = $_POST['password2'] ?? null;
    
    $nameSuccess = (is_string($name) && strlen($name) > 3);
    $emailSuccess = (is_string($email) && (strpos($email, '@') !== false));
    $password1Success = ($password1 === $password2 && strlen($password1) > 7);
    $password2Success = ($password2 === $password1);
    
    if($nameSuccess && $emailSuccess && $password1Success) {
        try {
            $connection = new PDO('mysql:host=localhost;dbname=register', 'root');
        } catch (PDOException $exception) {
            http_response_code(500);
            echo 'A problem occurred, contact support';
            exit(10);
        }
        $sql = "INSERT INTO user(username, email, password) VALUES (\"$name\", \"$email\", \"$password1\")";
        $affected = $connection->exec($sql);   
        if (!$affected) {
            echo implode(', ', $connection->errorInfo());
            return;
        }
        
        echo 'data success';
        return;
    } else {
        echo 'something is missing in your form';
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Register here</title>
	</head>
	<body>
		<form method="POST">
		<?php if (!($nameSuccess ?? true)) {?>
		<div>
		<p> You have an error into your username</p>
		</div>
		<?php }?>
			<label for="name">Your username :</label>
			<input type="text" name="name" value="<?php echo htmlentities($name ?? ""); ?>" />
			<br/>
				<?php if (!($passwordSuccess ?? true)) {?>
		<div>
		<p> You have an error into your password</p>
		</div>
		<?php } ?>	
			<label for="email">Your email :</label>
			<input type="text" name="email" value="<?php echo htmlentities($email ?? ""); ?>" />
			<br/>
				<?php if (!($emailSuccess ?? true)) {?>
		<div>
		<p> You have an error into your email</p>
		</div>
		<?php } ?>	
			
			<label for="password_1">Your password :</label>
			<input type="password" name="password_1" />
			<br/>
			
			<label for="password_2">Retype your password :</label>
			<input type="password" name="password_2"/>
			<br/>
			
			<button type="submit">Send</button>
		</form>
	</body>
</html>