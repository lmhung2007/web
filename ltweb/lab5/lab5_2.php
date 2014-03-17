<!DOCTYPE html>
<html>
<head>
	<title>Lab5_2</title>
	<style type="text/css">
	body {
		margin: 50px auto;
		width: -webkit-fit-content;
		width: -moz-fit-content;
		width: fit-content;
	}
	form {
		border: 1px solid #00f;
		padding: 20px;
	}
	label {
		display: inline-block;
		width: 100px;
		padding: 5px 0;
	}
	.fit {
		width: 300px;
	}
	</style>
	<?php
	function firstRun() {
		return !isset($_REQUEST['submit']);
	}
	$errfname = $errlname = $erremail = $errpassword = '';
	$success = false;
	if (!firstRun()) {
		$fname = $_REQUEST['fname'];
		$lname = $_REQUEST['lname'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$day = $_REQUEST['day'];
		$month = $_REQUEST['month'];
		$year = $_REQUEST['year'];
		$gender = $_REQUEST['gender'];
		$country = $_REQUEST['country'];
		$about = $_REQUEST['about'];

		if (strlen($fname) < 2 || strlen($fname) > 30)
			$errfname = ' must be 2-30 characters';
		if (strlen($lname) < 2 || strlen($lname) > 30)
			$errlname = ' must be 2-30 characters';
		if (strlen($password) < 6 || strlen($password) > 20)
			$errpassword = ' must be 6-20 characters';
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
			$erremail = htmlspecialchars(' format: <sth>@<sth>.<sth>');

		if (strlen($errlname) + strlen($errfname) + strlen($erremail) + strlen($errpassword) < 10)
			$success = true;
	} else {
		$fname = $lname = $email = $password = '';
		$day = $month = 1;
		$year = 1970;
		$gender = 'Male';
		$country = 'Vietnam';
		$about = '';
	}
	function fillOption($from, $to, $default) {
		for ($i = $from; $i <= $to; $i++) {
			if ($i == $default)
				echo '<option selected="selected" value="$i">'.$i.'</option>';
			else
				echo '<option value="$i">'.$i.'</option>';
		}
	}
	?>
</head>
<body>
<form method="GET"> <!--  action="<?=$_SERVER['PHP_SELF'];?>"  -->
	<h3>Registration Form</h3>
	<label>First name:</label>
	<input type="text" name="fname" value="<?=$fname;?>" placeholder="First name" class="fit">
	<?=$errfname;?>
	<br><label>Last name:</label>
	<input type="text" name="lname" value="<?=$lname;?>" placeholder="Last name" class="fit">
	<?=$errlname;?>
	<br><label>Email:</label>
	<input type="text" name="email" value="<?=$email;?>" placeholder="example@abc.com" class="fit">
	<?=$erremail;?>
	<br><label>Password:</label>
	<input type="password" name="password" value="<?=$password;?>" class="fit">
	<?=$errpassword;?>
	<br><label>Birthday:</label>
	Day <select name="day" id="day">
		<?php fillOption(1, 31, $day); ?>
	</select>
	Month <select name="month" id="month">
		<?php fillOption(1, 12, $month); ?>
	</select>
	Year <select name="year" id="year">
		<?php fillOption(1970, 2015, $year);	?>
	</select>
	<br><label>Gender:</label>
	<input type="radio" name="gender" id="male" value="Male" <?php
		if ($gender == 'Male') echo 'checked';
	?>>
	<label for="male">Male</label>
	<input type="radio" name="gender" id="female" value="Female" <?php
		if ($gender == 'Female') echo 'checked';
	?>>
	<label for="female">Female</label>
	<br><label>Country:</label>
	<select name="country" id="country">
	<?php
		$ar = array('Vietnam', 'Australia', 'United States', 'India', 'Other');
		foreach ($ar as $c) {
			echo '<option';
			if ($country == $c) echo ' selected';
			echo '>'.$c.'</option>';
		}
	?>
	</select>
	<br><label>About:</label>
	<textarea name="about" class="fit"><?=$about;?></textarea>
	<br><input type="reset" name="reset" value="Reset">
	<input type="submit" name="submit" value="Submit">
	<h3>
	<?php
	if ($success == true)
		echo "Successful!";
	?>
	</h3>
</form>
</body>
</html>