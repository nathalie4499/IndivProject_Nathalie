<?php
include_once __DIR__.'/../../config/app.conf.php';

if(isset($_GET['edit_id']))
{
    $sql_query="SELECT * FROM users WHERE user_id=".$_GET['edit_id'];
    $result_set=mysql_query($sql_query);
    $fetched_row=mysql_fetch_array($result_set);
}
if(isset($_POST['btn-update']))
{
    // variables for input data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city_name = $_POST['city_name'];
    // variables for input data
    
    // sql query for update data into database
    $sql_query = "UPDATE users SET first_name='$first_name',last_name='$last_name',user_city='$city_name' WHERE user_id=".$_GET['edit_id'];
    mysql_query($sql_query));
    // sql query for update data into database
}
?>


<?php


/**
 * Function to query information based on
 * a parameter: location.
 *
 */


 if (isset($_POST['submit'])) 
{
	
	try 
	{
		
		require "../config/app.config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "SELECT * 
						FROM cats
						WHERE catname = :catname";
		$catname = $_POST['catname'];
		$statement = $connection->prepare($sql);
		$statement->bindParam(':catname', $catname, PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetchAll();
	}
	
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
	
<?php  
if (isset($_POST['submit'])) 
{
	if ($result && $statement->rowCount() > 0) 
	{ ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Cat Name</th>
					<th>Cat Breed</th>
					<th>Age</th>
					<th>Location</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["catname"]); ?></td>
				<td><?php echo escape($row["catbreed"]); ?></td>
				<td><?php echo escape($row["age"]); ?></td>
				<td><?php echo escape($row["location"]); ?></td>
				<td><?php echo escape($row["date"]); ?> </td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
	<?php
	} 
}?> 

// update data in mysql database 
$sql="UPDATE $tbl_name SET name='$name', lastname='$lastname', email='$email' WHERE id='$id'"; 
$result=mysql_query($sql); 

// if successfully updated. 
if($result){ 
echo "Successful"; 
echo "<BR>"; 
echo "<a href='list_records.php'>View result</a>"; 
} 

else { 
echo "ERROR"; 
} 

<?php
require_once('connect.php');
$id = $_GET['id'];
$SelSql = "SELECT * FROM `crud` WHERE id=$id";
$res = mysqli_query($connection, $SelSql);
$r = mysqli_fetch_assoc($res);
if(isset($_POST) & !empty($_POST)){
	$fname = mysql_real_escape_string($_POST['fname']);
	$lname = mysql_real_escape_string($_POST['lname']);
	$email = mysql_real_escape_string($_POST['email']);
	$gender = $_POST['gender'];
	$age = $_POST['age'];
 
	$UpdateSql = "UPDATE `crud` SET first_name='$fname', last_name='$lname', gender='$gender', age=$age, email_id='$email' WHERE id=$id";
	$res = mysqli_query($connection, $UpdateSql);
	if($res){
		header('location: view.php');
	}else{
		$fmsg = "Failed to update data.";
	}
}
?>
<h2>Modify a cat</h2>

<form method="post">
<label for="catname">Cat Name</label>
<input type="text" name="catname" id="catname">
<label for="catbreed">Cat Breed</label>
<input type="text" name="catbreed" id="catbreed">
<label for="age">Age</label>
<input type="text" name="age" id="age">
<label for="location">Location</label>
<input type="text" name="location" id="location">
<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

