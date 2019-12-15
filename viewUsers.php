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

//make sure user is admin
if($_SESSION["basicInfo"]["typeOfUser"] != "admin"){
	echo "Access denied.";
	exit();
}

$sql = "SELECT * from users where typeOfUser='user'";

$result = $conn->query($sql);

if($result->num_rows > 0){
	$users = $result->fetch_all();
}
else{
	$_SESSION["message"] = "No Users!";
}
?>

<html>
<head>
	<title>View Users</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
</head>
	<h1>View Users</h1>
	<body>
		<?php
		for ($i=0; $i < sizeof($users); $i++) { 
		$id = $users[$i][4];
		$username = $users[$i][0];
		echo "Username: " . $users[$i][0] . "  ,  ";
		echo "Email: " . $users[$i][1] . "  ,  ";
		echo "UserID: " . $users[$i][4] . "    ";
		echo "<a href='user.php?id=$id&username=$username'> View User Profile</a>" . "<br><br>";
		}
		?>
		<a href="home.php"><- Go Back to Home</a>
	</body>
</html>