<?php 
session_start();
include("../../xe-library/xe-library74.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<title>Carriagepals – Admin section</title>
	<script src="ckeditor/ckeditor.js"></script>
	<link rel="" href="ckeditor/samples/css/samples.css"/>
	<script src="ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css"/>
	<link rel="stylesheet" href="assets/css/style.css"/>
	<script src="../js/jquery.js" type="text/javascript"></script>
	<script src="../js/Toast.min.js" type="text/javascript"></script>
   <script src="../js/toastify-js.js" type="text/javascript"></script>
   <script src="../js/index.js" type="text/javascript"></script>

</head>
<body>

	<?php
	if(x_validatesession("CARRIAGE_ADMINER_ID")){
		
		if(!x_validateget("loginHash")){
			finish("0","Parameter missing!!");
			exit();
		}
		
		if($_SESSION["CARRIAGE_ADMINER_LOGID"] != xg("loginHash")){
			finish("0","Token missing!");
			exit();
		}
		
		include("makepost.php");
		
	}else{
		?>
		<div class="form-control">
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
				<input type="text" class="form-control-input" name="userid" placeholder="Enter user ID"/><br/>
				<input type="password" class="form-control-input" name="pass" placeholder="Enter password"/><br/>
				<input type="hidden" class="form-control-btn" name="_token" value="<?php echo sha1(uniqid());?>"/>
				<input type="submit" value="Login"/>
			</form>
			
			<?php
			if(x_validatepost("_token")){
				$user = xp("userid");
				$pass = xp("pass");
				
				if(($user == "akinade" && $pass == "AkindeCarriagePals2023??") || ($user == "xelowgc" && $pass == "affinity")){
					
					if($user == "xelowgc"){
						$name = "Biobaku Oluwole";
						$id = sha1(uniqid());
					}
					
					if($user == "akinade"){
						$name = "Akinade Akinwumi";
						$id = sha1(uniqid());
					}
					
					$salted = "XeLoWgC1234567890??#";
					$_SESSION["XCAPE_HACKS"] = sha1(uniqid().$salted).md5(uniqid().$salted);
					$_SESSION["CARRIAGE_ADMINER_ID"] = $user;
					$_SESSION["CARRIAGE_ADMINER_NAME"] = $name;
					$_SESSION["CARRIAGE_ADMINER_LOGID"] = $id;
					session_write_close();
					
					finish("AdminerController?loginHash=$id","0");
					
				}else{
					finish("0","Invalid login credentials!!");
				}
			}
			?>
		</div>
		<?php
	}
	?>

	
</body>
</html>
