<?php
	//server stuff
	$servername = "localhost";
	$serverUser = "root";
	$dbName = "main";
	$serverPass = "";
	//form stuff
	$username = "";
	$password1 = "";
	$password2 = "";
	$secPass = "";

	if(isset($_POST['register'])) {
		$username = $_POST['name'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		if(empty($username)) {
			echo '<script>document.getElementById("emptyuser").style.display="block";</script>';
		}
		elseif(empty($password1)) {
			echo '<script>document.getElementById("emptyuser").style.display="block";</script>';
		}
		elseif(empty($password2)) {
			echo '<script>document.getElementById("emptyuser").style.display="block";</script>';
		}
		elseif($password1 != $password2) {
			echo '<script>document.getElementById("match").style.display="block";</script>';
		} else {
			$secPass = md5($password1);
			$conn = new mysqli($servername, $serverUser, $serverPass, $dbName);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$sql = "INSERT INTO phpLogin (username, password) VALUES ('$username', '$secPass');";
			if ($conn->query($sql) === TRUE) {
			    echo '<script>document.getElementById("success").style.display="block";</script>';
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$username = "";
			$password1 = "";
			$password2 = "";
			$secPass = "";
			$conn->close();
		}
	}
?>
