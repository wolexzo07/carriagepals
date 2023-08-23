<?php
session_start();
include("../xe-library/xe-library74.php");
$PageToken = md5(uniqid());
	
if(x_validateget("hashkey") && x_validateget("cmd") && x_validatesession("CARRIAGE_PAL_ID")){
		
		$cmd = xg("cmd");
		$user = x_clean(x_session("CARRIAGE_PAL_ID"));
		$os = xos(); $br = xbr(); $ip = xip();
		
		if($cmd == "ngn-balance"){ // NGN Wallet Balance
			$balance = x_getsingleupdate("manageaccount","wallet_ngn","id='$user'");
			echo "N ".number_format($balance,2);
			//echo 1;
		}
		
		if($cmd == "usd-balance"){ // USD Wallet Balance
			$balance = x_getsingleupdate("manageaccount","wallet_usd","id='$user'");
			echo "<i class='fa fa-dollar'></i> ".number_format($balance,2);
		}
		
		if($cmd == "swap-funds"){ // funds swapping
			
			if(x_validatepost("_token") && x_validatesession("XCAPE_HACKS")){
				$token = xp("_token");
				$csession = x_session("XCAPE_HACKS");
				
				if($token != $csession){
					x_toasts("Oops :: Failed to swap funds! Token missing");
				}else{
					$option = xp("option");
					$amount = xp("amount");
					
					$createRates = x_dbtab("rates","
					selling_rate DOUBLE NOT NULL,
					buying_rate DOUBLE NOT NULL,
					status ENUM('0','1') NOT NULL
					","innodb");
					
					$swapTable = x_dbtab("funds_swap","
					type ENUM('','n2d','d2n') NOT NULL,
					amount DOUBLE NOT NULL,
					amt_after_conversion DOUBLE NOT NULL,
					ngn_balance DOUBLE NOT NULL,
					usd_balance DOUBLE NOT NULL,
					timed DATETIME NOT NULL,
					rtimer VARCHAR(50) NOT NULL,
					status ENUM('0','1') NOT NULL,
					os VARCHAR(70) NOT NULL,
					br VARCHAR(700) NOT NULL,
					ip VARCHAR(20) NOT NULL
					","innodb");
					
					if($createRates){
						
						if(x_count("rates","status='1' AND id='1' LIMIT 1") > 0){}else{
							$slr = 750;
							$byr = 730;
							x_insert("selling_rate,buying_rate,status","rates","'$slr','$byr','1'","&nbsp;","<div class='alert alert-danger' role='alert'>Oops :: Failed to create rate table<div>");
						}
						
						// Getting current rate from database
						
						$sellRate = x_getsingleupdate("rates","selling_rate","status='1' AND id='1'");
						$buyRate = x_getsingleupdate("rates","buying_rate","status='1' AND id='1'");
						
						if($swapTable){
							
							$options = array("n2d","d2n");
						
							if(in_array($option , $options)){
								
								// Handling naira to dollar
								
								if($option == "n2d"){ // checking for sufficient balance
				
									$currency = "NGN"; 
									$inputamount = $amount;
									$userid = $user;
									//$switch = $currency;
									
									x_balsufficient($currency , $inputamount , $userid);
									
									$cbal_ngn = x_crwbalance("NGN" , $userid);
									$cbal_usd = x_crwbalance("USD" , $userid);
									$newbal_in_ngn = $cbal_ngn - $inputamount;

									$amt_in_dollar = round($inputamount / $sellRate,2);
									$newbal_in_usd = $cbal_usd + $amt_in_dollar;
									
									// updating new balance
									
									x_update("manageaccount","id='$user'","wallet_ngn=wallet_ngn-$inputamount , wallet_usd=wallet_usd + $amt_in_dollar","","");
									
									// creating transaction history
									$timed = x_curtime(0,0);
									$rtimed = x_curtime(0,1);
									
									x_insert("type,amount, amt_after_conversion,ngn_balance,usd_balance,timed,rtimer,status,os,br,ip","funds_swap","'n2d','$inputamount','$amt_in_dollar','$newbal_in_ngn','$newbal_in_usd','$timed','$rtimed','1','$os','$br','$ip'","<script>showalert('Transaction completed successfully!')</script>","<script>showalert('Failed to complete Transaction!')</script>");
									
								}
								
								// Handling Dollar to Naira Conversion
								
								if($option == "d2n"){ // checking for sufficient balance
				
									$currency = "USD"; 
									$inputamount = $amount;
									$userid = $user;
									//$switch = $currency;
									
									x_balsufficient($currency , $inputamount , $userid);
									
									$cbal_ngn = x_crwbalance("NGN" , $userid);
									$cbal_usd = x_crwbalance("USD" , $userid);
									

									$amt_in_ngn = round($inputamount * $buyRate,2);
									
									$newbal_in_ngn = $cbal_ngn + $amt_in_ngn;
									
									$newbal_in_usd = $cbal_usd - $inputamount;
									
									// updating new balance
									
									x_update("manageaccount","id='$user'","wallet_ngn=wallet_ngn+$amt_in_ngn , wallet_usd=wallet_usd-$inputamount","","");
									
									// creating transaction history
									
									$timed = x_curtime(0,0);
									$rtimed = x_curtime(0,1);
									
									
									x_insert("type,amount,amt_after_conversion,ngn_balance,usd_balance,timed,rtimer,status,os,br,ip","funds_swap","'d2n','$inputamount','$amt_in_ngn','$newbal_in_ngn','$newbal_in_usd','$timed','$rtimed','1','$os','$br','$ip'","<script>showalert('Transaction completed successfully!')</script>","<script>showalert('Failed to complete Transaction!')</script>");
									
								}
								
							}else{
								echo "Invalid option detected";
							}
							
						}else{
							x_toasts("Oops :: Failed to create Fundd Swap Table");
						}
						
					}else{
						x_toasts("Oops :: Failed to create rates Table");
					}
				}
			}
			
		}
		
		if($cmd == "fetch-swap"){ // funds swapping
			
			if(x_count("funds_swap","status='1' OR status='0'") > 0){
				 ?><ul class="list-group tr-sact">
					<li class="list-group-item">
						<h3 class="h-text">TRANSACTION <span class="g-color">DETAILS</span></h3>
					</li>
					<?php
					$count = 0;
				foreach(x_select("0","funds_swap","status='1' OR status='0'","9","id desc") as $td){
					$count++;
					$id = $td["id"];
					$type = $td["type"];
					$amount = $td["amount"];
					$amt_after = $td["amt_after_conversion"];
					$ngn = $td["ngn_balance"];
					$usd = $td["usd_balance"];
					$timed = $td["timed"];
					$rtimer = $td["rtimer"];
					$status = $td["status"];
					
					if($type == "n2d"){
						$currency = "NGN";
						$alt = "USD";
					}
					
					if($type == "d2n"){
						$currency = "USD";
						$alt = "NGN";
					}
					
					?>
					<li class="list-group-item">
						<?php echo $count.". &nbsp;&nbsp;";?> <span class="m-currency"><?php echo $currency." ".number_format($amount,2);?></span>&nbsp; was swapped to get&nbsp; <span class="o-currency"><?php echo $alt." ".number_format($amt_after,2);?></span>
						<!--<span class="timer-spot"><?php echo $timed;?></span>-->
					</li>
					
					<?php
					
				}
				?></ul><?php
				
			}else{
				
			}
			
		}
		
		if($cmd == "process-rq"){ // handling request
		
		 if(x_validatepost("_token")){
			 
			 $shipping_type = xp("shtype");
			 $order_type = xp("order-type");
			 $unit = xp("item-weight-type");
			 $size = xp("item-weight");
			 $titled = xp("title");
			 
			 if($unit == "lb"){ // handling pounds
				 if(!is_numeric($size)){
					 x_toasts("numeric value is expected as weight value");
					 exit();
				 }
				 $size = xp("item-weight");
			 }
			 
			 if($unit == "dimen"){ // handling dimension in centimeters				
				$size = x_valdimension($size);
			 }
			 
			 if($unit == "other"){
				 $size = xp("item-weight");
			 }
			 
			 
			 $shdate = xp("date");
			 $details = xp("message");
			 
			 $userid = x_session("CARRIAGE_PAL_ID");
			 $ref = x_refgen($userid);
			 $dated = x_curtime(0,0); $rdated = x_curtime(0,1);
			 $os = xos(); $br = xbr(); $ip = xip();
			 
			 $getname = x_getsingleupdate("manageaccount","name","id='$userid'");
			 $getemail = x_getsingleupdate("manageaccount","email","id='$userid'");
			 $getmobile = x_getsingleupdate("manageaccount","mobile","id='$userid'");
			 
			 $total_count = count($_FILES['upload']['name']);
	
			// restrict the number of images that can be upload at once
			
			if($total_count > 4){
				x_toasts("Oops :: You can not upload more than 4 images at once");
				exit();
			}
	
	
			 $create = x_dbtab("quotes_request","
			 user_id INT NOT NULL,
			 images_count INT NOT NULL,
			 is_images ENUM('0','1') NOT NULL,
			 amount_agreed DOUBLE NOT NULL,
			 ref VARCHAR(255) NOT NULL,
			 shipping_type ENUM('','air','sea','road') NOT NULL,
			 item_unit ENUM('','lb','dimen','other') NOT NULL,
			 item_size VARCHAR(100) NOT NULL,
			 order_type ENUM('','single','bulky') NOT NULL,
			 shipping_date DATE NOT NULL,
			 title VARCHAR(255) NOT NULL,
			 details TEXT NOT NULL,
			 status ENUM('','0','1','2'),
			 dated DATETIME NOT NULL,
			 rdated VARCHAR(255) NOT NULL,
			 os VARCHAR(100) NOT NULL,
			 br VARCHAR(100) NOT NULL,
			 ip VARCHAR(50) NOT NULL
			 ","innodb");
			 
			 if($create){
				 
				 if(x_count("quotes_request","ref='$ref' LIMIT 1") > 0){
					 
					 x_toasts("Request with ref #$ref already exist"); 
					 
				 }else{
					 $title = "Carriagepals :: Quotes Request From $getname";
					 $user_email="hello@carriagepals.com";
					 $content = "Hi admin,<br/>
					 <p><b>$getname</b> sent you quote request with the following details below:</p>
					 <table cellpadding='10px' cellspacing='1px' width='100%'>
						 <tr>
						 <th>Ref ID:</th>
						 <td>#$ref</td>
						 </tr>
						 
						 <tr>
						 <th>Email:</th>
						 <td>$getemail</td>
						 </tr>
						 
						 <tr>
						 <th>Mobile:</th>
						 <td>$getmobile</td>
						 </tr>
						 
						 <tr>
						 <th>Details:</th>
						 <td>$details</td>
						 </tr>
					 </table>
					 ";
					 ep_mailer($title,$content,$user_email); // send emails to admin
					 
					 $title = "Carriagepals :: Quotes Request confirmation";
					 $content = "Hi <b>$getname</b>, <br/>
					 We are delighted to have you with us at carriagepals. Your request with ref ID <b>#$ref</b> has been recieved successfully. Our specialist will get intouch with you soon.Thank you for choosing carriagepal
					 <p>Your requested quote below :</p>
					 	 <table cellpadding='10px' cellspacing='1px' width='100%'>
						 
						 <tr>
						 <th>Email:</th>
						 <td>$getemail</td>
						 </tr>
						 
						 <tr>
						 <th>Mobile:</th>
						 <td>$getmobile</td>
						 </tr>
						 
						 <tr>
						 <th>Details:</th>
						 <td>$details</td>
						 </tr>
					 </table>
					 ";
					 $user_email = $getemail;
					 ep_mailer($title,$content,$user_email); // send emails to user
					 
					 x_insert("title,user_id,ref,shipping_type,item_unit,item_size,order_type,shipping_date,details,status,dated,rdated,os,br,ip","quotes_request","'$titled','$userid','$ref','$shipping_type','$unit','$size','$order_type','$shdate','$details','0','$dated','$rdated','$os','$br','$ip'","<script>showalert('Quote request submitted successfully! Our team will get intouch soon!')</script>","<script>showalert('Failed to submit quote')</script>");
					 
					 include("process_attachment.php");
					 
				 }
				 
			 }else{
				x_toasts("Failed to create table for quotes request!"); 
			 }
			 
		 }
		
		}
		
		if($cmd == "fetch-rq"){ // handling request
		
			if(x_count("quotes_request","user_id='$user' LIMIT 1") > 0){
				?>
				<ul class="list-group tr-sacted">
					<li class="list-group-item">
						<h3 class="h-text">REQUESTED <span class="g-color">QUOTES</span></h3>
					</li>
				<?php
				$co = 0;
				foreach(x_select("0","quotes_request","user_id='$user'","10","id desc") as $request){
					$co++;
					$id = $request["id"];
					$amt = $request["amount_agreed"];
					$title = $request["title"];
					$ref = $request["ref"];
					$shtype = $request["shipping_type"];
					$unit = $request["item_unit"];
					$size = $request["item_size"];
					$ortype = $request["order_type"];
					$shdate = $request["shipping_date"];
					$details = $request["details"];
					$status = $request["status"];
					$dt = $request["dated"];
					$rdt = $request["rdated"];
				
					?>
					<li class="list-group-item">
						<?php echo $co++.". &nbsp;&nbsp;";?> 
						<?php echo x_trunc($details,0,60);?>
					</li>
					<?php
				}
				?></ul><?php
			}else{
				?>
				<ul class="list-group ">
					<li class="list-group-item">
						<h3 class="h-text">REQUESTED <span class="g-color">QUOTES</span></h3>
						
					    <div class="pt-5 pb-5 text-center"><i style="font-size:100pt;color:lightgray;" class="fa fa-edit"></i>
						  <p style="color:lightgray;" class="">No request was made</p>
						  <button class="btn btn-danger btn-sm mt-1 mb-2"><i class="fa fa-plus"></i> Request Quote</button>
						</div>
					</li>
				</ul>
				
				<?php
			}
		}
		
			if($cmd == "fetch-rq-full"){ // handling request
		
			if(x_count("quotes_request","user_id='$user' LIMIT 1") > 0){
				?>
				<ul class="list-group">
					<!---<li class="list-group-item">
						<h3 class="h-text">REQUESTED <span class="g-color">QUOTES</span></h3>
					</li>-->
				<?php
				$co = 0;
				foreach(x_select("0","quotes_request","user_id='$user'","10","id desc") as $request){
					$co++;
					$id = $request["id"];
					$amt = $request["amount_agreed"];
					$title = $request["title"];
					$ref = $request["ref"];
					$shtype = $request["shipping_type"];
					$unit = $request["item_unit"];
					$size = $request["item_size"];
					$ortype = $request["order_type"];
					$shdate = $request["shipping_date"];
					$details = $request["details"];
					$status = $request["status"];
					$dt = $request["dated"];
					$rdt = $request["rdated"];
					
					$is_paid = $request["is_paid"];
					$paid_on = $request["paid_on"];
					
					$img_count = $request["images_count"];
					$is_image = $request["is_images"];
					
					if($status == 0){
						$statusf = "fa fa-minus-circle";
						$smg = "Pending";
						$scolor = "green";
						
					}
					if($status == 1){
						$statusf = "fa fa-check-circle";
						$smg = "Approved";
						$scolor = "purple";
					}
					if($status == 2){
						$statusf = "fa fa-close";
						$smg = "Rejected";
						$scolor = "Red";
					}
					?>
					<li style="margin-bottom:20pt;" class="list-group-item pb-2 pt-2">
						<span style="background-color:<?php echo $scolor;?>;" class="pull-right badge"><i class="<?php echo $statusf;?>"></i>&nbsp;<?php echo $smg;?></span>
						<h4 class="f-bold"><?php echo strtoupper($title);?></h4>
						
						<?php
						if($img_count > 0){
							?>
							<div class="mt-2 mb-2 img-resu<?php echo $id;?>"></div>
							<script>
								$(document).ready(function(){
									imagesManager(".img-resu<?php echo $id;?>","<?php echo $ref;?>","getImages");
								});
							</script>
							<?php
						}
						?>
						
						<p class="pb-1"><?php echo $details;?></p>

						<table class="table">
						   <tr>
								<th>Reference ID</th>
								<td><?php echo $ref;?></td>
							</tr>
							<tr>
								<th>Payment status</th>
								<td><?php
									if($is_paid == 1){
										?>
										<span style="background:purple;" class="badge">Paid</span>
										<?php
									}else{
										?>
										<span style="background:red;" class="badge">unpaid</span>
										<?php
									}
								?></td>
							</tr>
							
							<?php
							if($is_paid == 1){
								?>
							<tr>
								<th>Paid on</th>
								<td><?php echo $paid_on;?></td>
							</tr>
								<?php
							}
							?>
							<tr>
								<th>Agreed Cost</th>
								<td><?php echo "<i class='fa fa-dollar'></i> ".number_format($amt,2);?></td>
							</tr>
							<tr>
								<th>Item weight</th>
								<td><?php echo $size." ".$unit;?></td>
							</tr>
							<tr>
								<th>Pref.shipping date</th>
								<td><?php echo $shdate;?></td>
							</tr>
							<tr>
								<th>Order Type</th>
								<td><?php echo $ortype;?></td>
							</tr>
						</table>
						
						<?php
						if($is_paid == 1 &&  $amt != 0){
							
							if($status == 1){
								?>
								<button class="btn btn-default btn-sm pull-left">Send message&nbsp;&nbsp; 
								<span class="badge">0</span>
								</button>
								<?php
							}
							
						}else{
							
							if($status == 1){
								?>
								<button class="btn btn-primary btn-sm pull-left">Make payment
								</button>
								<?php
							}
							
						}
							
						?>
					</li>
					<?php
				}
				?></ul><?php
			}else{
				?>
				<div class="text-center"><i style="font-size:100pt;color:lightgray;" class="fa fa-edit"></i>
				<p style="color:lightgray;" class="">No request was made</p>
				<button class="btn btn-danger btn-sm mt-1"><i class="fa fa-plus"></i> Request Quote</button>
				</div>
				<?php
			}
		}
		
		
		if($cmd == "getImages"){ // images gridding
			$ref = xg("ref");
			if(x_count("filelogs","post_id='$ref' AND status='1' LIMIT 1") > 0){
				foreach(x_select("0","filelogs","post_id='$ref'  AND status='1'","4","id") as $images){
					$fimg[] = "'".$images["file_path"]."'";
				}
			}
			$final_images = implode(",",$fimg);
			?>
			<div class="pick_images<?php echo $ref;?>"></div>
			<script>
				$(".pick_images<?php echo $ref;?>").imagesGrid({
					images: [<?php echo $final_images;?>],
					align: true,
					getViewAllText: function(imgsCount) {
					var	subcount = imgsCount-5;
					return "+ "+subcount; 					
				}
				});
			</script>
			<?php
		}
		
		if($cmd == "pending-request"){ // Handling pending Request counts
			$getpr = x_count("quotes_request","user_id='$user' AND status='0'");
			echo $getpr;
		}
		
		if($cmd == "approved-request"){// Handling approved Request counts
			$getar = x_count("quotes_request","user_id='$user' AND status='1'");
			echo $getar;
		}
		
		if($cmd == "rejected-request"){// Handling rejected Request counts
			$getrr = x_count("quotes_request","user_id='$user' AND status='2'");
			echo $getrr;
		}
		
		if($cmd == "amount-spent"){ // Handling total spent in fulfilling request
			$amount = x_sum("amount_agreed","quotes_request","user_id='$user' AND status='1' AND is_paid='1' AND amount_agreed != '0'");
			echo "<i class='fa fa-dollar'></i> ".number_format($amount,2);
		}
		
		if($cmd == "upassword"){ // Handling total spent in fulfilling request
			
			if(x_validatepost("_token") && x_validatepost("old")){
				
				$old = x_clean(x_post("old"));
				$new = x_clean(x_post("new"));
				$neww = x_clean(x_post("neww"));
				
				$cuser = $user;
				$oldhash = x_phasher($old);
				$hash = x_phasher($new);
				$time = x_curtime(0,1);
				
				if($new != $neww){
					x_toasts("Password does not match");
					exit();
				}
				
				if(x_count("manageaccount","id='$cuser' AND pass='$oldhash' LIMIT 1") > 0){
					
					x_updated("manageaccount","id='$cuser'","pass='$hash',last_login_r ='$time'","<script>showalert('Password was changed!');</script>","<script>showalert('Failed to update password!');</script>");
					
				}else{
					x_toasts("Invalid old password!");
				}
			}
		}
		
		if($cmd == "uphoto"){ // Handling total spent in fulfilling request
			
			if(x_validatepost("_token")){
				
				$cuser = $user;
				
				$dirn = "userphoto"; // creating directory
				if(!is_dir($dirn)){
					 mkdir($dirn);
					}
				
				if(x_ischeckupload("upload")){
					
					$getlimit = 1048576;
					xcload("upload"); // checking upload status
					$size1 = x_size("upload"); // get file size
					xcsize("upload",$getlimit); // 1mb max file size
					xtex("png,gif,jpg,jpeg","upload");	// checking file extension
					$token1 = sha1($cuser.uniqid().xrands(10).Date("His"))."_";
					$path1 = x_path("upload","userphoto/$token1");
					
				}else{
					x_toasts("No upload was detected!");
					exit();
				}
				
				if(x_count("manageaccount","id='$cuser' LIMIT 1") > 0){
					
					$getpath = x_getsingleupdate("manageaccount","user_photo","id='$cuser'");
					
					if($getpath == ""){}else{
						if(file_exists($getpath)){
							unlink($getpath); // deleted from directory
						}else{}
					}
					
					x_updated("manageaccount","id='$cuser'","user_photo='$path1'","<script>showalert('Photo updated successfully!');</script>","<script>showalert('Failed to update photo!');</script>");
					
					$ngetpath = x_getsingleupdate("manageaccount","user_photo","id='$cuser'");
					
					if($ngetpath == $path1){
						xmload("upload",$path1,""); // move file to location
					}
					
					
				}else{
					x_toasts("Invalid old password!");
				}
			}
			
		}
		
		if($cmd == "profile-photo"){
			$getimage = x_getsingleupdate("manageaccount","user_photo","id='$user'");
			if($getimage == ""){
				$getimage = "userphoto/avatar.png";
			}else{
				if(file_exists($getimage)){
					$getimage = $getimage;
				}else{
					$getimage = "userphoto/avatar.png";
				}
			}
			?><img src="<?php echo $getimage;?>" class="img-responsive"/><?php
		}
		
		// Admin page manager
		
		if(x_count("manageaccount","id='$user' AND is_big='1'") > 0){
			include("adminController.php");
		}
	
}

?>
