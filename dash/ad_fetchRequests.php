<?php

    if(!isset($PageToken)){
		exit();
	}
		
			if(x_count("quotes_request","status !='' LIMIT 1") > 0){
				?>
				<ul class="list-group">
				
				<?php
				$co = 0;
				foreach(x_select("0","quotes_request","status !=''","1000","id desc") as $request){
					$co++;
					$id = $request["id"];
					$uid = $request["user_id"];
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
					
					$name = x_getsingleupdate("manageaccount","name","id='$uid'");
					$email= x_getsingleupdate("manageaccount","email","id='$uid'");
					$mobile = x_getsingleupdate("manageaccount","mobile","id='$uid'");
					$photo = x_getsingleupdate("manageaccount","user_photo","id='$uid'");
					$dummy = "userphoto/avatar.png";
					$getimage = x_validatePath($photo,$dummy);
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
								<th>Posted By</th>
								<td class="f-bold"><img src="<?php echo $getimage;?>" class="img-icon"/><?php echo $name;?></td>
							</tr>
							<tr>
								<th>Contact Email</th>
								<td class=""><p class=""><?php echo $email;?></p></td>
							</tr>
							<tr>
								<th>Contact Phone.</th>
								<td class=""><?php echo $mobile;?></td>
							</tr>
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
							
							if($status == 0){
								?>
								<div class="row">
									<div class="col-12 col-md-4 col-lg-4 mt-1 mb-1 x_requestResult"></div>
								</div>
								
								<div class="row">
									<div class="col-12 col-md-4 col-lg-4">
									
										<form method="POST" id="approve-request">
											<div class="row">
												<div class="col-12 col-md-8 col-lg-8">
													<input required="" class="form-control input-lg" type="number" placeholder="Agreed cost" name="amount"/>
													<input type="hidden" name="request_id" value="<?php echo $id;?>"/>
												</div>
												<div class="col-12 col-md-4 col-lg-4">
												<button class="btn p-1 btn-primary btn-sm w-100 pull-left">Approve</button>
												</div>
											</div>
										
										
										</form>
									
									</div>
									<div class="col-12 col-md-4 col-lg-4">
									
										<form method="POST" id="reject-request">
										
											<div class="row">
												<div class="col-12 col-md-12 col-lg-12">
													
													<input type="hidden" name="request_id" value="<?php echo $id;?>"/>
													<button class="btn p-1 btn-success btn-sm w-100 pull-left"><i class="fa fa-close"></i> &nbsp;&nbsp;Reject Request</button>
													
												</div>
											</div>
											
										</form>	
										
									</div>
									<div class="col-12 col-md-4 col-lg-4">
									
									<form method="POST" id="delete-request">
										
											<div class="row">
												<div class="col-12 col-md-12 col-lg-12">
													
													<input type="hidden" name="request_id" value="<?php echo $id;?>"/>
													<input type="hidden" name="ref_id" value="<?php echo $ref;?>"/>
													<button class="btn p-1 btn-danger btn-sm w-100 pull-left"><i class="fa fa-trash"></i> &nbsp;&nbsp;Delete Request</button>
													
												</div>
											</div>
											
									</form>	
									
									</div>
								</div>
				
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
				<p class="text-center pb-5"><i style="color:lightgray;font-size:100pt;" class="fa fa-edit"></i>
					<br/>
					<span style="font-size:15pt;color:gray;">No request History<span>
				
				</p>
				<?php
			}
	
	
	
		
?>
<script>
	$(document).ready(function(){
		formpusher("#approve-request",".x_requestResult","approveRequest"); // approve request
		formpusher("#reject-request",".x_requestResult","rejectRequest"); // reject request
		formpusher("#delete-request",".x_requestResult","deleteRequest"); // delete request
	});
</script>