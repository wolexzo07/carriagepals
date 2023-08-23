<?php
session_start();
include("xe-library/xe-library74.php");
if(x_validatesession("XCAPE_HACKS") && x_validateget("cmd") && x_validateget("hashkey")){
	$cmd = xg("cmd");
	$allowed = array("lg","rg","rt"); //login register reset
	
	if( !in_array($cmd,$allowed) ){
		echo "<div class='alert alert-warning' role='alert'>Invalid options!</div>";
		}else{
			
				if($cmd == "rg"){ // Handling Registration
					
					if(x_validatepost("_token")){
							$fname = x_clean(x_post("fname"));
							$lname = x_clean(x_post("lname"));
							$name = $fname." ". $lname;
							$email = x_clean(x_post("email"));
							$pass = x_clean(x_post("pass"));
							$mobile = x_clean(x_post("mobile"));
							$hash = x_phasher($pass);
							$regdate = x_curtime(0,0);
							$rtime = x_curtime(0,1);
							
							// validating inputs
							
							if($fname == "" || $lname == ""){
								echo "<div class='alert alert-danger' role='alert'>Check your name input!</div>";
									exit();
								}
								
							if(xpmail("email")  != true || $email == ""){
								echo "<div class='alert alert-danger' role='alert'>Enter valid email!</div>";
									exit();
								}
							
							// checking for duplicates
							
							if(x_count("manageaccount","email = '$email' LIMIT 1") > 0){
									echo "<div class='alert alert-danger' role='alert'>Email address already used!</div>";
									exit();
								}
								
								if(x_count("manageaccount","mobile = '$mobile' LIMIT 1") > 0){
									echo "<div class='alert alert-danger' role='alert'>Mobile number already used!</div>";
									exit();
								}
								
								x_insert("name,email,mobile,pass,timest,realtime","manageaccount","'$name','$email','$mobile','$hash','$regdate','$rtime'","created","<div class='alert alert-danger' role='alert'>Failed to create account!</div>");
						}
					
					}
					
				if($cmd == "lg"){ // Handling Login
						
						if(x_validatepost("_token")){
							$uname = x_clean(x_post("username"));
							$pass = x_clean(x_post("password"));
							$hash = x_phasher($pass);
							
							// validating input 
						
							if($uname == ""){
									echo "<div class='alert alert-danger' role='alert'>Email or Mobile Missing!</div>";
									exit();
								}
								
								if($pass == ""){
									echo "<div class='alert alert-danger' role='alert'>Password Missing!</div>";
									exit();
								}
							
							//  Login account
							if(x_count("manageaccount","email = '$uname' AND pass='$hash' OR mobile='$uname' AND pass='$hash' LIMIT 1") > 0){
							
								foreach(x_select("id,name,email,mobile","manageaccount","email = '$uname' AND pass='$hash' OR mobile='$uname' AND pass='$hash'","1","id") as $user){
										$id= $user["id"];
										$name = $user["name"];
										$email = $user["email"];
										$mobile = $user["mobile"];
										
										$_SESSION["CARRIAGE_PAL_ID"] = $id;
										$_SESSION["CARRIAGE_PAL_NAME"] = $name;
										$_SESSION["CARRIAGE_PAL_EMAIL"] = $email;
										$_SESSION["CARRIAGE_PAL_MOBILE"] = $mobile;
										
										finish("./dash","0");
									}
								}else{
									x_toasts("Invalid login credentials!");
								}
							
							}
							
					}
					
				if($cmd == "rt"){ // Handling Reset
						echo "<div class='alert alert-warning' role='alert'>Account recovery activated</div>";
					}
			
			}
	
	}
?>
