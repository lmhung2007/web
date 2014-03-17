<!DOCTYPE html>
<html>
<head>
	<title>Lab4_4</title>
	<style type="text/css">
	table {
		margin: 100px auto;
		background-color: #ff0;
		text-align: center;
		border: 1px solid black;
		border-spacing: 0;
	}
	td {
		height: 30px;
		width: 30px;
		border: 1px solid black;
	}
	</style>
</head>
<body>
<?php 
	function printTable($n) {
		echo "<table>";
		for ($i = 1; $i <= $n; $i++) {
			echo "<tr>";
			for ($j = 1; $j <= $n; $j++) {
				echo "<td>".($i * $j)."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	printTable(17);
 ?>
</body>
</html>