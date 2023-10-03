<?php
	if(!isset($PageToken)){
		exit();
	}
	
	if(x_count("topup_details","status='1' OR status='0'") > 0){
		$counter = 0;
		?>
		<table class="table" id="table_id">
		<thead>
			<tr>
				<th>Photo/Name</th>
				<th>Tranx.Type</th>
				<th>Amount</th>
				<th>Timestamp</th>
				<th>Payment status</th>
				
				<th>Action</th>
			</tr>
		</thead><tbody>
		<?php
		foreach(x_select("0","topup_details","status='1' OR status='0'","0","id desc") as $money){
			$counter++;
			$id = $money["id"];
			$uid = $money["user_id"];
			$tranx_type = $money["tranx_type"];
			$bkid = $money["bank_account_id"];
			$trfer_date = $money["transferdate"];
			$trfer_des = $money["transfer_description"];
			$trfer_date = $money["transferdate"];
			$status = $money["status"];
			$pid = $money["payment_id"];
			$currency = $money["currency"];
			$cramt = $money["credit_amount"];
			$feeamt = $money["fee_amount"];
			$tamount = $money["total_amount"];
			$paid_on = $money["paid_on"];
			
			$name = x_getsingleupdate("manageaccount","name","id='$uid'");
			$photo = x_getsingleupdate("manageaccount","user_photo","id='$uid'");
			$dummy = "userphoto/avatar.png";
			$getimage = x_validatePath($photo,$dummy);
			
			if($status == "1"){
				$statusa ="approved";
				$color="p-color";
			}
			
			if($status == "0"){
				$statusa ="pending";
				$color="g-color";
			}
			
			?>
			<tr>
				
				<td><img src="<?php echo $getimage;?>" class="img-icon"/><?php echo $name;?></td>
				<td><span class="badge"><?php echo $tranx_type;?></span></td>
				<td class="f-bold"><?php echo $currency." ".number_format($cramt,2);?></td>
				<td><?php echo $paid_on;?></td>
				<td class="<?php echo $color;?>"><?php echo $statusa;?></td>
				<td>
					<?php
						if($status=="0" && $tranx_type=="manual"){
							?>
							<button title="view profile" onclick="" disabled class="btn btn-sm btn-primary"><i class="fa fa-check-circle"></i></button>
							<?php
						}
					?>
					<button title="view profile" class="btn btn-sm btn-danger" disabled><i class="fa fa-trash"></i></button>
				</td>
			</tr>
			<?php
		}
		?>
			</tbody></table>
			<div class="f-topup x_overflow"></div>
		<?php
	}else{
		?>
			<p class="text-center pb-5"><i style="color:lightgray;font-size:100pt;" class="fa fa-bank"></i>
			<br/>
			<span style="font-size:15pt;color:gray;">No Top-up History<span>
			
			</p>
			
		<?php
	}
	?>
	
<script>
	$(document).ready( function () {
		$('#table_id').DataTable({
			lengthMenu: [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, 'All'],
			],
		});
		$("#table_id_filter input").attr("placeholder","Search Anything");
		$("#table_id_filter input").attr("class","form-control form-control-sm");
	});
</script>
