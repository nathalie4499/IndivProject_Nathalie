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
						WHERE location = :location";
		$location = $_POST['location'];
		$statement = $connection->prepare($sql);
		$statement->bindParam(':location', $location, PDO::PARAM_STR);
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
				<td><?php echo htmlentities($row["id"]); ?></td>
				<td><?php echo htmlentities($row["catname"]); ?></td>
				<td><?php echo htmlentities($row["catbreed"]); ?></td>
				<td><?php echo htmlentities($row["age"]); ?></td>
				<td><?php echo htmlentities($row["location"]); ?></td>
				<td><?php echo htmlentities($row["date"]); ?> </td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo htmlentities($_POST['location']); ?>.</blockquote>
	<?php
	} 
}?> 


<h2>Find cats based on their location</h2>

<form method="post">
	<label for="location">Location</label>
	<input type="text" id="location" name="location">
	<input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

