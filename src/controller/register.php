<?php
include_once __DIR__.'/init.php';

/* Registration process, inserts user info into the database
 */

// Set session variables to be used on profile.php page
//$_SESSION['username'] = $_POST['username'];   
//$_SESSION['email'] = $_POST['email'];
//$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? null;
    
    if ($usernameSuccess && $emailSuccess && $passwordSuccess) {
        try {
            $connection = Service\DBConnector::getConnection();
        } catch (PDOException $exception) {
            http_response_code(500);
            echo 'A problem occured, contact support';     
            exit(10);
        }
        
        // Check if user with that email already exists
        
        $sqlQuery = "SELECT * FROM users WHERE email=:email";

        $statement = $connection->prepare($sqlQuery);
        
        $statement->bindParam('email', $email, PDO::PARAM_STR);
        
        $statement->execute();
        $results = $statement->fetchAll();
        // User email exists if the rows returned are more than 0
        if ( count($results) > 0 ) {
            
            $_SESSION['message'] = 'User with this email already exists!';
            header("location: error.php");
            
        }
        else {  // Add user to the database          
                $sql = "INSERT INTO user(username, email, password) VALUES (\"$username\", \"$email\", \"$password\")";
                //$insertion = $connection->exec($sql);
                
                 $statement = $connection->prepare($sql);
                
                $statement->bindParam('username', $username, PDO::PARAM_STR);
                
                $statement->execute();
                
                if (!$statement) {
                    echo implode(', ', $connection->errorInfo());
                    return;
                }
                $id = $connection->lastInsertId();
                
                return;
        }
    }
}
    ?>