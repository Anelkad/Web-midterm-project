<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
	<link rel="icon" href="https://pngimg.com/uploads/twitter/small/twitter_PNG3.png">
	<link rel="stylesheet" href="signS.css">
	<title>Sign Up</title>
</head>
<?php error_reporting(0); ?>
<body>
	
	<div class="container">        
        <div class="box">
            <i class="fab fa-twitter"><img src="https://img.icons8.com/color/50/000000/twitter--v1.png"/></i>
            <form method="post">
				<dt class="namePlace">Username</dt>
                <div class="box-input"><input type="text" placeholder="Username" id="username" name="username"/></div>
				<dt class="namePlace">First name</dt>
                <div class="box-input"><input type="text" placeholder="First name" id="firstName" name="firstName"/></div>
				<dt class="namePlace">Last name</dt>
                <div class="box-input"><input type="text" placeholder="Last name" id="lastName" name="lastName"/></div>
				<dt class="namePlace">Email</dt>
                <div class="box-input"><input type="text" placeholder="Email" id="email" name="email"/></div>
				<dt class="namePlace">Password</dt>
                <div class="box-input"><input type="password" placeholder="Password" id="password" name="password"/></div>
            	<input type="submit" class="next-btn" value="Sign up">
			</form>
        </div>
    </div>
	
<?php	
		$username = $_POST['username'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		
		$conn = mysqli_connect("localhost", "root", "", "test");
		
		if (!$conn) {
		  die("Connection failed: " . mysqli_connect_error());
		}
		
		$check_fields = empty($username) || empty($firstName) || empty($lastName) || empty($email) || empty($password);

		$sql_login = "SELECT * FROM users WHERE username = '$username' limit 1";
		$login_sql = mysqli_query($conn, $sql_login);
		$login_exist = False;

		if ($check_fields){
			?>
				<script language="javascript">
					alert('Please write fields properly');
				</script>
			<?php
		}
		else
		if ($login_sql) {
    		if(mysqli_num_rows($login_sql)>0){
				$login_exist = True;
				?>
				<script language="javascript">
					alert('Login used already! Please use another login');
				</script>
				<?php
   		 	}
		}

		$success = (!$check_fields) && (!$login_exist);

		if ($success) {
			$sql = "INSERT INTO users (username, firstName, lastName, email, password) VALUES ('$username', '$firstName', '$lastName', '$email', '$password')";
			if (mysqli_query($conn, $sql)){
				$fullname = $firstName . " " . $lastName;
				mysqli_query($conn, "UPDATE usersprofile SET full_name = '$fullname', username = '$username' WHERE id=1");
				?>
				  <script language="javascript">
					  alert('Welcome to Twitter!');
					  window.location="home.php";
				  </script>
			  	<?php
			}
			else {
		  		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

		mysqli_close($conn);
		      
	?> 
</body>
</html>