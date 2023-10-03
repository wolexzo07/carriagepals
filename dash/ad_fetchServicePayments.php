<?php
	if(!isset($PageToken)){
		exit();
	}
	
	if(x_count("payments_forservices","status='1' OR status='0'") > 0){
		$counter = 0;
		?>
		<table class="table" id="table_id">
		<thead>
			<tr>
				<th>Photo/Name</th>
				<th>Tranx.ID</th>
				<th>Agreed Amt</th>
				<th>Amt Paid</th>
				<th>Paymnt status</th>
				
				<th>DateTime</th>
			</tr>
		</thead><tbody>
		<?php
		foreach(x_select("0","payments_forservices","status='1' OR status='0'","0","id desc") as $money){
			$counter++;
			$id = $money["id"];
			$uid = $money["user_id"];
			$pid = $money["payment_id"];
			$agamount = $money["agreed_amount"];
			$pamount = $money["paid_amount"];
			$time = $money["timed"];
			$status = $money["status"];
			
			
			$currency = "USD";
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
				<td><span class="badge"><?php echo $pid;?></span></td>
				<td class="f-bold"><?php echo $currency." ".number_format($agamount,2);?></td>
				<td class="f-bold"><?php echo $currency." ".number_format($pamount,2);?></td>
				<td class="<?php echo $color;?>"><?php echo $statusa;?></td>
				<td><?php echo $time;?></td>
			</tr>
			<?php
		}
		?>
			</tbody></table>
			<div class="f-spay x_overflow"></div>
		<?php
	}else{
		?>
			<p class="text-center pb-5"><i style="color:lightgray;font-size:100pt;" class="fa fa-bank"></i>
			<br/>
			<span style="font-size:15pt;color:gray;">No service payments record<span>
			
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
