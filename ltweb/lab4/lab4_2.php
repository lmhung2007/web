<!DOCTYPE html>
<html>
<head>
	<title>Lab4_2</title>
</head>
<body>
<?php 
	function printMessage($i) {
		switch ($i % 5) {
			case 0:
				echo "Hello";
				break;
			case 1:
				echo "How are you?";
				break;
			case 2:
				echo "I'm doing well, thank you";
				break;
			case 3:
				echo "See you later";
				break;
			case 4:
				echo "Good-bye";
				break;
		}
	}

	printMessage(0);
?>
</body>
</html>