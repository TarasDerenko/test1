<?php

/*if(isset($_GET['file'])){
    $file = 'https://vs1.coursehunters.net/udemy-react16-maxim/lesson'.$_GET['file'].'.mp4';
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    readfile($file);
    exit;
}*/

$number = rand(1,30);
$count = 0;
while (true) {
	echo "Enter number between 1 to 30: ";
	$count++;
	$input = trim(fgets(STDIN,1024));
	if(is_numeric($input)){
		switch (true) {
			case ($input > $number):
				echo "Number is smaller! \n";
				break;
			case ($input < $number):
				echo "Number is bigger! \n";
				break;
			
			default:
				echo "You Win! \n";
				echo "Numder is: {$number} \n";
				echo "Count is: {$count} \n";
				break 2;
				break;
		}
	}
}