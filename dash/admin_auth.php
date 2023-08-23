  <?php
	session_start();
	include("../xe-library/xe-library74.php");

	if(x_validatesession("XCAPE_HACKS")){
			
			$pageToken = x_session("XCAPE_HACKS");
			
		}else{
			echo "<div class='alert alert-success' role='alert'>Missing parameter! Unable to load admin pages</div>";
			finish("0","Missing parameter");
			exit();
		}
		
	if(x_validatesession("CARRIAGE_PAL_ID")){
		
		$currentuser = x_session("CARRIAGE_PAL_ID");
		
		if(x_count("manageaccount","id='$currentuser' AND is_big='1'") > 0){
			
		}else{
			finish("logout","Escalate privilege! Admin access allowed.");
			exit();
		}
		
	}else{
		finish("../","Invalid session! Login");
		exit();
	}
?>