<?php

    if(!isset($PageToken)){
		exit();
	}
	
	if(x_validateget("uid")){
		
		$cuser = xg("uid");
		
			if(x_count("quotes_request","user_id='$cuser' LIMIT 1") > 0){
				?>
				<ul class="list-group">
				
				<?php
				$co = 0;
				foreach(x_select("0","quotes_request","user_id='$cuser'","10","id desc") as $request){
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
				<!---<button class="btn btn-danger btn-sm mt-1"><i class="fa fa-plus"></i> Request Quote</button>--->
				</div>
				<?php
			}
		
	}
	
	
		
?>