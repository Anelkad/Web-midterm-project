<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
		<link rel="icon" href="https://pngimg.com/uploads/twitter/small/twitter_PNG3.png">
		<link rel="stylesheet" href="loginS.css">
		<title>Log In</title>
	</head>
	<?php error_reporting(0);?>
	<body>
		<div class="container">        
			<div class="box">
				<i class="fab fa-twitter"><img src="https://img.icons8.com/color/50/000000/twitter--v1.png"/></i>
				<form method="post">
					<div class="box-input"><input type="text" placeholder="Username" id="username" name="username"/></div>
					<div class="box-input"><input type="password" placeholder="Password" id="password" name="password"/></div>
					<input type="submit" class="next-btn" value="Log in">
				</form>
			</div>
			<p>Don't have an account <a href="signup.php">Sign Up</a></p>
		</div>

	<?php
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		
		$conn = mysqli_connect("localhost", "root", "", "test");
		
		if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT * FROM users WHERE username = '$username' limit 1";
		$result = mysqli_query($conn, $sql);

		if ($result) {
			if(mysqli_num_rows($result)>0){
				$user_data=mysqli_fetch_assoc($result);

				if($user_data['password']===$password){

				$fullname = $user_data['firstName'] . " " . $user_data['lastName'];
				mysqli_query($conn, "UPDATE usersprofile SET full_name = '$fullname', username = '$username' WHERE id=1");
				?>
					<script language="javascript">
						window.location="home.php";
					</script>
				<?php
				}
				else{
					?>
					<script language="javascript">
						alert('Wrong password!');
					</script>
					<?php
				}
			}
			else{
				?>
				<script language="javascript">
					alert('User not registered!');
				</script>
				<?php
			}
			
		} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

	?>

	</body>
</html>