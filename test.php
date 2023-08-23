<?php
include("xe-library/xe-library74.php");
$dimen = "400x300x400";
if(substr_count($dimen,"x") == 2 || substr_count($dimen,"X") == 2){
	
	if(substr_count($dimen,"x") == 2){
		$split = explode("x",$dimen);
	}
	if(substr_count($dimen,"X") == 2){
		$split = explode("X",$dimen);
	}
	
	$counter = count($split);
	
	if($counter == 3){
		
		if(is_numeric($split[0]) && is_numeric($split[1]) && is_numeric($split[2])){
			echo $split[0]." x ".$split[1]." x ".$split[2];
		}else{
			echo "bad";
		}
		
	}else{
		echo "bad";
	}
	
}else{
	echo "bad";
}

?>