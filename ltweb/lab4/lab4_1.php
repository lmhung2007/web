<!DOCTYPE html>
<html>
<head>
	<title>Lab4_1</title>
</head>
<body>
<?php
	function printResult($x, $y) {
		printf("%d + %d = %d<br>", $x, $y, $x + $y);
		printf("%d - %d = %d<br>", $x, $y, $x - $y);
		printf("%d * %d = %d<br>", $x, $y, $x * $y);
		if ($y != 0) {
			printf("%d / %d = %0.13f<br>", $x, $y, $x / $y);
			printf("%d %% %d = %d<br>", $x, $y, $x % $y);
		}
	}

	printResult(10, 7);
?>
</body>
</html>