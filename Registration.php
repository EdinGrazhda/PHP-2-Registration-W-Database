<?php
   include('server.php');
?>
<html>
	<head>
		<style>
			.empty {color: red;}
		</style>
	</head>
	<body>
		<p><span class="empty">* Required</span></p>
		<form method="POST">
            <?php include('errors.php'); ?>
			First Name: <input type="text" name="firstName">
			<br><br>
			Last Name: <input type="text" name="lastName">
            <br><br>
			Email: <input type="text" name="email">
            <br><br>
			Password: <input type="password" name="password">
			<br><br>
            Confirm Password: <input type="password" name="confirmPassword">
			<br><br>
			Gender:<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Femer") echo "checked";?> value="Femer">F
				   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="Mashkull") echo "checked";?> value="Mashkull">M
			<br><br>
			Birthday: <input type="date" name="birthday">
			<br><br>
			<input type="submit" name="login" value="Sign Up">
			<input type="reset" value="Cancel">
		</form>
	</body>
</html>