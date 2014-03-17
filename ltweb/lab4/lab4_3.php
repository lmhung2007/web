<!DOCTYPE html>
<html>
<head>
	<title>Lab4_3</title>
</head>
<body>
<?php 
	function printOddUseFor($n) {
		for ($i = 0; $i <= $n; $i++) {
			if ($i % 2 == 1) {
				echo $i." ";
			}
		}
	}
	function printOddUseWhile($n) {
		$i = 0;
		while ($i <= $n) {
			if ($i % 2 == 1) {
				echo $i." ";
			}
			$i++;
		}
	}
	printOddUseFor(100);
	echo "<br>";
	printOddUseWhile(100);
 ?>
</body>
</html>