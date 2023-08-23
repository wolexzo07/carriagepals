<?php
	if(!isset($PageToken)){
		exit();
	}
	
	if(x_count("manageaccount","status='1' OR status='0'") > 0){
		$counter = 0;
		?>
		<table class="table" id="table_id">
		<thead>
			<tr>
				<th>No.</th>
				<th>Photo/Name</th>
				<th>Is Admin</th>
				<th>Contact Details</th>
				<th>Wallet Balance</th>
				
				<th>Action</th>
			</tr>
		</thead><tbody>
		<?php
		foreach(x_select("0","manageaccount","status='1' OR status='0'","0","id desc") as $user){
			$counter++;
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
			<tr>
				<td><?php echo $counter;?></td>
				
				<td><img src="<?php echo $getimage;?>" class="img-icon"/><?php echo $name;?></td>
				<td><?php echo $admin;?></td>
				<td><p><?php echo $email;?><br/><?php echo $mobile;?></p></td>
				<td><p><?php echo "NGN ".number_format($ngn,2);?><br/>
				<?php echo "USD ".number_format($usd,2);?>
				</p></td>
				<td>
					<button title="view profile" onclick="ad_viewManager('<?php echo $id;?>','.user-eye','manage-view')" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
					<button title="view profile" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
				</td>
			</tr>
			<?php
		}
		?>
			</tbody></table>
			<div class="user-eye x_overflow"></div>
		<?php
	}else{
		
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
