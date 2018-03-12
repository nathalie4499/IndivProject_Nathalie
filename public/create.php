<?php
/**
 * Use an HTML form to create a new entry in the
 * cats table.
 *
 */
if (isset($_POST['submit']))
{
	
    require "../config/app.config.php";
	require "../common.php";
	try 
	{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$new_cat = array(
			"catname" => $_POST['catname'],
			"catbreed"  => $_POST['catbreed'],
			"age"       => $_POST['age'],
			"location"  => $_POST['location']
		);
		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"cats",
				implode(", ", array_keys($new_cat)),
				":" . implode(", :", array_keys($new_cat))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($new_cat);
	}
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>


<?php 
if (isset($_POST['submit']) && $statement) 
{ ?>
	<blockquote><?php echo $_POST['catname']; ?> successfully added.</blockquote>
<?php 
} ?>

<h2>Add a cat</h2>

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
