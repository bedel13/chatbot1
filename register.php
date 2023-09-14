<?php
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<style>
body 
{
  background-image: url('https://wallpaperaccess.com/full/7270229.jpg' );
   background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>


<title>Registration Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<!--<body style="background-color:#bdc3c7"> -->
	
	<div id="main-wrapper">
		<center>
			<h2><strong id="regis">Sign Up</strong></h2>
			<img src="image/bot_avatar.webp" class="avatar"/>
		</center>
	
		<form class="myform" action="register.php" method="POST">

			<div class="inner_container">


 			<label><b id="run">Username:</b></label><br>
			<input name="username" type="text" id="ruser" class="inputvalues" placeholder="Username" required/><br>
			<label><b id="pass">Password:</b></label><br>
			<input name="password" type="password" id="password" class="inputvalues" placeholder="Password" required/><br>
				<label><b id="pass2">Confirm Password:</b></label><br>
			<input name="password2" type="password" id="password2" class="inputvalues" placeholder="Confirm password" required/><br>
			<label><b id="mail">Email:</b></label><br>
			<input name="email" type="email" id="email" class="inputvalues" placeholder="Email" required/><br>
			<input name="submit_btn" type="submit" id="signup_btn" value="Sign Up"/><br>
			<a href="index.php"><input type="button" id="back_btn" value="Back"/></a>
		
		</div>


		</form>
		
        <?php
        if(isset($_POST['submit_btn'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $email = $_POST['email'];
            
            if(strlen($password)<6){
                echo '<script type="text/javascript">alert("Password must be at least 6 characters long")</script>';
            } else {
            $query = "SELECT * FROM users WHERE username= :username";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            }

            if($stmt->rowCount()>0) {
                echo '<script type="text/javascript"> alert("User already exists.. try another username") </script>';
            } elseif($password !== $password2) {
                echo '<script type="text/javascript"> alert("Passwords does not match!") </script>';	
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                //Insert the user into the database
                $query = "INSERT INTO users(username, password, email) VALUES (:username, :password, :email)";

                $stmt = $db->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->bindParam(':email', $email);

                if($stmt->execute()) {
                    echo '<script type="text/javascript"> alert("User Registered.. Go to login page") </script>';
                } else {
                    echo "Error creating user. Please try again later.";
                }
            }

        }

        ?>
		
	</div>
</body>
</html>