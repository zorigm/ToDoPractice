<?php
session_start();
$_SESSION = array();
session_destroy();
?>
<head>
	<title>Tasks</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
</head>

<h1>You have been logged out. <br></h1>
<h1><a href='login.php'>Log In</a></h1>