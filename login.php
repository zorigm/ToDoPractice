<?php
session_start();
$conn = new mysqli("localhost", "root", "12345werty");
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
$conn->select_db("check");

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = $_POST["username"];
	$password = $_POST["password"];

	$sql = "SELECT * From users where username='$username' and password='$password'";

	$result = $conn->query($sql);

	if($result->num_rows == 1){
		$_SESSION["message"] = "Log In Successful.";
		$_SESSION["basicInfo"] = $result->fetch_array();
		header("location: home.php");
	}
	else{
		$_SESSION["message"] = "Log In Failed.";
	}
}

?>

<html>
	<head>
		<title>Log In Page</title>
		<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
	</head>

	<h1>Log In</h1>
	<body>
		<h3>
			<?php
			if(isset($_SESSION["message"])){
				echo $_SESSION["message"];
			}
			?>
		</h3>
		<form method="POST" action="login.php">
			Username: <br>
			<input type="username" name="username" required> <br>
			Password: <br>
			<input type="password" name="password" required><br>
			<input type="submit" name="submit">
		</form>
		<a href="signup.php">Don't have an account? Sign Up!</a>
	</body>

</html>