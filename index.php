<?php
    session_start();
    require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
<link rel="stylesheet" href="css/style.css">
<style>
    body 
    {
        background-image: url('https://wallpaperaccess.com/full/7270229.jpg' );
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
    }
</style>
</head>

<br>
<br>
<br>
<br>
<br>
<br>

<br>
<br>
	
<body>

<div id="main-wraper">
    <center>
        <h2><strong id="log">Login</strong></h2>
        <div class="imgcontainer">
        <img src="image/bot.png" class="avatar"/>
    </center>

    <form class="myform" action="index.php" method="post">
            
            <div class="inner_container">
            <label><b id="un">Username:</b></label><br>
             <input name="username" id="us" type="text" class="inputvalues"
            placeholder="Enter Username here..." required/><br>
            <label><b id="pas">Password:</b></label><br>
			<input name="password" id="pass" type="password" class="inputvalues" 
            placeholder="Your Password..." required/><br>

            <input name="login" type="submit" id="login_btn" value="Login"/><br>

            <a href="register.php"><input type="button" id="register_btn" value="Register"/></a><br>

        </div>
    </form>

    <?php
    if(isset($_POST['login']))
    {
        $username=$_POST['username'];
        $password=$_POST['password'];

        $sql = "SELECT * FROM users WHERE username= :username";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();


        if($stmt->rowCount() > 0)
        {
            //User with the given username exists, fetching the hashed password
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['password'];

            //Verifying the password
            if(password_verify($password, $hashed_password)) {
                //Password is valid
                $_SESSION['username'] = $username;
                header('location:homepage.php');
            } else {
                // Invalid Password
                echo '<script type="text/javascript"> alert("Invalid credentials") </script>';
            }
        }
        else {
            //invalid
            echo '<script type="text/javascript">alert("Invalid credentials")</script>';
        }
    }







    ?>




</div>
    
</body>
</html>