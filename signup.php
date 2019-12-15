<?php
session_start();

$conn = new mysqli("localhost", "root", "12345werty");
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
$conn->select_db("check");


if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//make sure password matches
	if($_POST["password"] == $_POST["passwordConfirm"]){
		$username = $_POST["username"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$userType = $_POST["typeOfUser"];

		$sql = "INSERT INTO users (username, email, password, typeOfUser) VALUES ('$username', '$email', '$password', '$userType')";

		if($conn->query($sql) === true){
			$_SESSION["message"] = "Registration successful. You can now log in.";
			header("location: login.php");
		}
		else{
			$_SESSION["message"] = "User could not be added to database" . "<br>" . $conn->error;
		}
	}
	else{
		$_SESSION["message"] = "Passwords do not match.";
	}
	
}

?>

<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
</head>
	<h1>Sign Up:</h1>
	<body>
		<?php
		if(isset($_SESSION["message"])){
				echo $_SESSION["message"];
			}
		 ?>
		<form action="signup.php" method="post">
			Email: 
			<input type="email" name="email" id="email" required=""> <br>

			User Name: 
			<input type="text" name="username" id="username" required> <br>

			Type of Account: 
			<input type="radio" name="typeOfUser" value="user" checked> Regular User
  			<input type="radio" name="typeOfUser" value="admin"> Administrator<br>

			Password:
			<input type="text" name="password" id="password" required> <br>

			Confirm Password:
			<input type="text" name="passwordConfirm" id="passwordConfirm" required> <br>

			<input type="submit" name="createaccount" id="submit">

		</form>
	</body>
</html>