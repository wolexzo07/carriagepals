<?php
	session_start();
	include_once("../../xe-library/xe-library74.php");
	
	if(x_validatesession("XCAPE_HACKS") && x_validateget("cmd") && x_validateget("hashkey")){
		$cmd = xg("cmd");
		$pageToken = x_session("XCAPE_HACKS");
		
		if($cmd == "manage-posting"){
			include("PostProcessor.php");
		}
	}

?>