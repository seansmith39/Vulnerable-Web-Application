<!DOCTYPE html>
<html>
<head>
	<title>SQL Injection</title>
	<link rel="shortcut icon" href="../Resources/hmbct.png" />
</head>
<body>
	<div style="background-color:#c9c9c9;padding:15px;">
      <button type="button" name="homeButton" onclick="location.href='../homepage.html';">Home Page</button>
      <button type="button" name="mainButton" onclick="location.href='sqlmainpage.html';">Main Page</button>
	</div>

	<div align="center">
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" >
		<p>Give me book's number and I give you book's name in my library.</p>
		Book's number : <input type="text" name="number">
		<input type="submit" name="submit" value="Submit">
		<!--<p>You hacked me again?
			   But I updated my code
			</p>
		-->
	</form>
	</div>

<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "1ccb8097d0e9ce9f154608be60224c7c";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$db);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	//echo "Connected successfully";
	if(isset($_POST["submit"])){
		$number = $_POST['number'];
		//You hacked me again?
		//I updated my code
		if(strchr($number,"'")){
			echo "What are you trying to do?<br>";
			echo "Awesome hacking skillzz<br>";
			echo "But you can't hack me anymore!";
			exit;
		}

        $result = $conn->execute_query('SELECT bookname,authorname FROM books WHERE number = ?', [$number]);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<hr>";
                echo htmlspecialchars($row['bookname']) . " ----> " . htmlspecialchars($row['authorname']);
            }

            if (mysqli_num_rows($result) <= 0)
                echo "0 result";
        } else {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            die($message);
        }
	}
?> 

</body>
</html>
