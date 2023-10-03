<?php
session_start();
include("../xe-library/xe-library74.php");
$PageToken = md5(uniqid());
if(x_validatesession("CARRIAGE_PAL_ID") && x_validateget("optcmd")){
	
	$pageExtension = sha1(uniqid()); // token for extended pages
	
	if(x_get("optcmd") == "flutter"){
		
		$optcmd = x_clean(x_get("optcmd")); // Getting payment company
		$ref = x_clean(x_get("transaction_id")); // Transaction id
		$total = x_clean(x_get("debited")); // Transaction Amount without fees
		
	}else{
		
		$optcmd = x_clean(x_get("optcmd")); // Getting payment company
		$ref = x_clean(x_get("ref")); // Transaction ref
		$total = x_clean(x_get("total")); // Transaction Amount
		
	}
	

	$complist = array("paystack","flutter"); // payment company listing
	
	if(in_array($optcmd,$complist)){
		
		if($optcmd == "paystack"){ 
		
			//include("verify_paystk.php"); //paystack verification starts here
			
		}else{ 
		
			include("verify_flutters.php");// flutter verification starts here
			
		}
	}

}else{
	echo "Missing Parameter!";
}
?>
