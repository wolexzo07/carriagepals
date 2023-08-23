<?php
if(!isset($PageToken)){
	exit();
}

// start admin scripting here

	if($cmd == "registered-users"){ // fetching registered users
	
		include_once("ad_fetchusers.php");
		
	}
	
	if($cmd == "manage-view"){ // fetching each full profile
	
	 include_once("ad_fetcheachuser.php");	
	
	}
	
	if($cmd == "adfetch-rq-full"){ // handling request
	
		include_once("ad_fetcheachrequests.php");
	
	}

?>
