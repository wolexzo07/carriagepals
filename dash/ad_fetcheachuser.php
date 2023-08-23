<?php

    if(!isset($PageToken)){
		exit();
	}
	
	if(x_validateget("uid")){
	
	$cuser = xg("uid");
	
	if(x_count("manageaccount","id='$cuser' LIMIT 1") > 0){
		
		foreach(x_select("0","manageaccount","id='$cuser'","1","id") as $user){
			
			$id = $user["id"];
			$isbig = $user["is_big"];
			$ngn = $user["wallet_ngn"];
			$usd = $user["wallet_usd"];
			$getimage = $user["user_photo"];
			$name = $user["name"];
			$email = $user["email"];
			$mobile = $user["mobile"];
			$realtime = $user["realtime"];
			
			if($isbig == 1){
				$admin = "Yes";
			}else{
				$admin = "No";
			}
			
			if($getimage == ""){
				
				$getimage = "userphoto/avatar.png";
				
			}else{
				if(file_exists($getimage)){
					
					$getimage = $getimage;
					
				}else{
					
					$getimage = "userphoto/avatar.png";
					
				}
			}
			
			?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-12">
						<i class="close-eye mb-2 fa fa-close fa-2x pull-right"></i>
					</div>
				</div>
			</div>
			
			<div class="container">

				<div  class="row">
					
					<div class="col-lg-12 col-md-12 col-12">
						<div class="list-group">
							<div class="list-group-item pb-3">
								<h3 class="adh-text">FULL PROFILE <span class="g-color">MANAGER</span></h3>
								
								
								<div class="row">
									<div class="col-lg-3 col-md-3 col-12 mt-2">
									  <div class="ceach-img"><img src="<?php echo $getimage;?>" class="userprofile-photo"/></div>
									</div>
									<div class="col-lg-9 col-md-9 col-12 mt-2">
									 <table class="table table-bordered table-striped mt-1">
										<tr>
											<td>Fullname</td>
											<th><?php echo $name;?></th>
										</tr>
										<tr>
										<td>Wallet Balance</td>
											<th><?php echo "USD ".number_format($usd,2);?>  &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
											<span class="g-color"><?php echo "NGN ".number_format($ngn,2);?></span>
											</th>
										</tr>
										<tr>
											<td>Email Address</td>
											<th><?php echo $email;?></th>
										</tr>
										<tr>
											<td>Mobile Number</td>
											<th><?php echo $mobile;?></th>
										</tr>
										<tr>
											<td>Created On</td>
											<th><?php echo $realtime;?></th>
										</tr>
									 </table>
									</div>
								</div>
								
								<h3 class="adh-text">MANAGE <span class="g-color">REQUESTS</span></h3>
								<input type="hidden" id="hideseek" value="<?php echo $id;?>" class="hideseek"/>
								
								<div class="each-quotes-details mt-2"></div>
								
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<?php
			
		}
		
	}else{
		
	}
	
}
		
?>

		
<script>
$(document).ready(function(){
	$(".close-eye").click(function(){
		$(".user-eye").slideUp("100");
	});
	var getusid = $(".hideseek").val();
	ad_viewManager(getusid,".each-quotes-details","adfetch-rq-full")
});
</script>