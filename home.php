<?php
session_start();

//don't show page if not logged in
if(!isset($_SESSION["basicInfo"])){
	echo "Not logged in. <br>";
	echo "<a href='login.php'>Log In</a>";
	exit();
}


$conn = new mysqli("localhost", "root", "12345werty");
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
$conn->select_db("check");

$id = $_SESSION["basicInfo"]["id"];

//only runs when request method is post when page is invoked
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$taskToAdd = $_POST["taskToAdd"];

	$sql = "INSERT into taskss (id, task, finished) values ('$id', '$taskToAdd', '0')";

	if($conn->query($sql) === true){
		$_SESSION["message"] = "Successfully added task.";
	}
	else{
		$_SESSION["message"] = "Unable to add task.";
	}
}

//delete task based on task id(primary key)
if($_SERVER["REQUEST_METHOD"] == "GET" && !isset($_GET["finish"]) && isset($_GET["taskNumber"])){
	$taskToModify = $_GET["taskNumber"];

	$sql = "DELETE from taskss where taskNumber='$taskToModify'";

	if($conn->query($sql) === true){
		$_SESSION["message"] = "Successfully deleted task.";
	}
	else{
		$_SESSION["message"] = "Unable to delete task.";
	}
}

//set task to finish
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["finish"]) ){
	$taskToModify = $_GET["taskNumber"];

	$sql = "UPDATE taskss SET finished=1 where taskNumber='$taskToModify'";

	if($conn->query($sql) === true){
		$_SESSION["message"] = "Successfully finished task.";
	}
	else{
		$_SESSION["message"] = "Unable to finish task.";
	}
}



$sql = "SELECT * from taskss where id='$id'";

$result = $conn->query($sql);

if($result->num_rows > 0){
	$tasks = $result->fetch_all();
}
else{
	$_SESSION["message"] = "No tasks!";
}

?>

<head>
	<title>Tasks</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
</head>

<h1>
	<?php echo $_SESSION["message"]?> <br>
	Hello, <?php echo $_SESSION["basicInfo"]["username"] ?>! 
	You are logged in as: <?php echo $_SESSION["basicInfo"]["typeOfUser"] ?>.
</h1>
<h2><a href="logout.php">Log Out</a>
<body>
	<h3>Your to do list: </h3>
	<ul>
	<?php
	//list all tasks based on user id
	if($result->num_rows > 0){
		for ($i=0; $i < sizeof($tasks) ; $i++) { 
		echo "<li>" . $tasks[$i][2];
		if($tasks[$i][3] == 0){
			echo "  :Unfinished";
		}
		else{
			echo "  :Finished";
		}
		echo "</li>";
		$taskNumber = $tasks[$i][0];
		echo "<a href='home.php?taskNumber=$taskNumber'>Delete</a> ";
		echo "<a href='home.php?taskNumber=$taskNumber&finish=1'>Finish</a>";
		}
	}
	?>
	</ul>

	<h3>Add to list:</h3>
	<form action="home.php" method="POST">
		<input type="text" name="taskToAdd" required>
		<input type="submit">
	</form>

	<?php 
	if ($_SESSION["basicInfo"]["typeOfUser"] == "admin") {
		echo "<h3><a href='viewUsers.php'>View Users</a></h3>";;
	}
	 ?>
</body>