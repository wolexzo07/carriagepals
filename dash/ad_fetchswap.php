<?php
	if(!isset($PageToken)){
		exit();
	}
	
	if(x_count("funds_swap","status='1' OR status='0'") > 0){
		?>
		<table class="table" id="table_id">
		<thead>
			<tr>
				<th>Photo/Name</th>
				<th>swap Type</th>
				<th>Amount</th>
				<th>Recieved amount</th>
				<th>Timestamp</th>
			</tr>
		</thead><tbody>
		<?php
		$count = 0;
		foreach(x_select("0","funds_swap","status='1' OR status='0'","0","id desc") as $td){
			$count++;
			$id = $td["id"];
			$uid = $td["user_id"];
			$type = $td["type"];
			$amount = $td["amount"];
			$amt_after = $td["amt_after_conversion"];
			$ngn = $td["ngn_balance"];
			$usd = $td["usd_balance"];
			$timed = $td["timed"];
			$rtimer = $td["rtimer"];
			$status = $td["status"];
			
			if($type == "n2d"){
				$title = "NAIRA TO DOLLAR CONVERSION";
				$color="success";
				$swaptype = "NGN - USD";
				$currency = "NGN";
				$alt = "USD";
				$cmd = "g-color f-bold";
			}
			
			if($type == "d2n"){
				$title = "DOLLAR TO NAIRA CONVERSION";
				$color="primary";
				$swaptype = "USD - NGN";
				$currency = "USD";
				$alt = "NGN";
				$cmd = "p-color f-bold";
			}
			
			$name = x_getsingleupdate("manageaccount","name","id='$uid'");
			$photo = x_getsingleupdate("manageaccount","user_photo","id='$uid'");
			$dummy = "userphoto/avatar.png";
			$getimage = x_validatePath($photo,$dummy);
			?>
			<tr>
				<td><img src="<?php echo $getimage;?>" class="img-icon"/><?php echo $name;?></td>
				<td><span title="<?php echo $title;?>" class="btn btn-<?php echo $color;?> btn-sm"><?php echo $swaptype;?></span></td>
				<td><?php echo $currency." ".number_format($amount,2);?></td>
				<td><span class="<?php echo $cmd ;?>"><?php echo $alt." ".number_format($amt_after,2);?></span></td>
				<td><?php echo $rtimer;?></td>
			</tr>
			<?php
			
		}
		
		?>
			</tbody></table>
			<div class="swap-records x_overflow"></div>
		<?php
	
	}else{
		?>
			<p class="text-center pb-5"><i style="color:lightgray;font-size:100pt;" class="fa fa-money"></i>
			<br/>
			<span style="font-size:15pt;color:gray;">No swap History<span>
			
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
