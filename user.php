<?php
session_start();

if(!isset($_SESSION["basicInfo"])){
	echo "Not logged in. <br>";
	echo "<a href='login.php'>Log In</a>";
	exit();
}

if($_SESSION["basicInfo"]["typeOfUser"] != "admin"){
	echo "Access denied";
	exit();
}

$conn = new mysqli("localhost", "root", "12345werty");
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
$conn->select_db("check");

$id = $_SESSION["basicInfo"]["id"];

if(isset($_GET["id"])){
	$viewID = $_GET["id"];
	$viewUser = $_GET["username"];

	$sql = "SELECT * from taskss where id='$viewID'";

	$result = $conn->query($sql);

	if($result->num_rows > 0){
		$tasks = $result->fetch_all();
		echo "
		<h1>User $viewUser</h1>
		<body>
			<ul>";
			for ($i=0; $i < sizeof($tasks) ; $i++) { 
				echo "<li>" . $tasks[$i][2];
				if($tasks[$i][3] == 0){
					echo "  :Unfinished";
				}
				else{
					echo "  :Finished";
				}
					echo "</li>";
			}
		echo "</ul>
		</body>";
		
	}
	else{
		echo "No tasks.";
	}
}
else{
	echo "User not selected.";
}
?>
<head>
	<title>View</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
</head>

<a href="viewUsers.php"><- View Users</a>