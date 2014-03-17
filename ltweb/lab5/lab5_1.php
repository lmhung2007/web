<!DOCTYPE html>
<html>
<head>
	<title>Lab5_1</title>
	<style type="text/css">
	body {
		margin: 100px auto;
		width: -moz-fit-content;
		width: -webkit-fit-content;
		width: fit-content;
		text-align: center;
	}
	th, td {
		padding: 0px 5px;
	}
	input[type=text] {
		width: 80px;
	}
	</style>
</head>
<body>
<h2>Simple Caculator</h2>
<form method="post" class="pure-form">
	<table>
		<tr>
			<th>Số thứ nhất</th>
			<th>Phép tính</th>
			<th>Số thứ hai</th>
			<th></th>
			<th>Kết quả</th>
		</tr>
		<tr>
			<td>
				<input type="text" name="first" placeholder="Số thứ nhất" value="<?php
					if (isset($_POST['first']))
						echo $_POST['first'];
				?>">
			</td>
			<td>
				<select name="operator">
				<?php
			    	$operators = array("+", "-", "*", "/", "^", "1/x");
				    foreach ($operators as $opt) {
				    	echo '<option value="'.$opt.'"';
				    	if (isset($_POST['operator']) && $_POST['operator'] == $opt)
				    		echo ' selected="selected"';
				    	echo '>'.$opt.'</option>';
			    	}
				 ?>
				</select>
			</td>
			<td>
				<input type="text" name="second" placeholder="Số thứ hai" value="<?php
					if (isset($_POST['second']))
						echo $_POST['second'];
				?>">
			</td>
			<td>
				<button type="submit">=</button>
			</td>
			<td>
				<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$a = $_POST['first'];
					$b = $_POST['second'];
					$o = $_POST['operator'];
					switch ($o) {
						case '+':
							echo ($a + $b);
							break;
						case '-':
							echo ($a - $b);
							break;
						case '*':
							echo ($a * $b);
							break;
						case '/':
							echo ($a / $b);
							break;
						case '^':
							echo (pow($a, $b));
							break;
						case '1/x':
							echo (1.0 / $a);
							break;
						default:
							echo $a.' '.$o.' '.$b;
							break;
					}
				}
				?>
			</td>
		</tr>
	</table>
</form>
</body>
</html>