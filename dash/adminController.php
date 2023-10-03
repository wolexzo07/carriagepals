<?php
if(!isset($PageToken)){
	exit();
}

// start admin scripting here

	if($cmd == "registered-users"){ // fetching registered users
	
		include_once("ad_fetchusers.php");
		
	}
	
	if($cmd == "swap-history"){ // funds swap history
	
		include_once("ad_fetchswap.php");
		
	}
	
	if($cmd == "r-fundsTopups"){ // funds Top-up history
	
		include_once("ad_fetchTopups.php");
		
	}
	
	if($cmd == "f-servicepayment"){ // Service payment history
	
		include_once("ad_fetchServicePayments.php");
		
	}
	
	if($cmd == "set-fxrate"){ // Control fx rates
	
		//include_once("ad_fetchServicePayments.php");
		if(x_validatepost("s-rate") && x_validatepost("b-rate")){
			
			$sr = xp("s-rate");
			$br = xp("b-rate");
			$timer = x_curtime(0,0);
			
			if($br > $sr){
				
				x_toasts("Selling rate must be higher than Buying rate!");
				
				exit();
				
			}
			
			if(x_count("rates","status='1'") > 0){
				
				x_updated("rates","status='1'","buying_rate='$br',selling_rate='$sr',last_updated_on='$timer'","<script>showalert('Rates updated successfully');</script>","<script>showalert('Failed updating rate');</script>");
				
			}else{
				
				x_insert("buying_rate,selling_rate,last_updated_on,status","rates","'$br','$sr','$timer','1'","<script>showalert('Rates inserted successfully');</script>","<script>showalert('Failed inserting rate');</script>");
				
			}
			
		}
		
	}
	
	if($cmd == "fetch-fxrate"){
		
		if(x_count("rates","status='1'") > 0){
		
			foreach(x_select("0","rates","status='1'","1","id") as $rate){
				$br = $rate["buying_rate"];
				$sr = $rate["selling_rate"];
				$last_time = $rate["last_updated_on"];
				?>
				<table style="border:1px dashed black;" class="table mt-4">
				<caption style="padding:10px;border:1px dashed black;text-align:center;" class="rate-table">Forex Rate Table</caption>
					<tr>
						<td>Selling Rate</td>
						<td>Buying Rate</td>
						<td>Last updated</td>
					</tr>
					<tr>
						<th class="p-color"><?php echo "NGN ".number_format($sr,2)." = USD 1.00";?></th>
						<th class="g-color"><?php echo "NGN ".number_format($br,2)." = USD 1.00";?></th>
						<th><?php echo $last_time;?></th>
					</tr>
				</table>
				
				<?php
			}
				
		}
	}
	
	if($cmd == "f-manageRequests"){ // fetch all request
	
		include_once("ad_fetchRequests.php");
	
	}
	
	if($cmd == "manage-view"){ // fetching each full profile
	
	 include_once("ad_fetcheachuser.php");	
	
	}
	
	if($cmd == "adfetch-rq-full"){ // handling request
	
		include_once("ad_fetcheachrequests.php");
	
	}
	
	if($cmd == "approveRequest"){ // approve request
	
		if(x_validatepost("request_id")){
			
			$id = xp("request_id");
			$amt = xp("amount");
			
			if(x_count("quotes_request","id='$id' LIMIT 1") > 0){
				
				if(x_count("quotes_request","id='$id' AND status='1' LIMIT 1") > 0){
					
					x_toasts("Quotes was approved already!");
					
				}else{
					x_updated("quotes_request","id='$id'","amount_agreed='$amt' , status='1'","<script>showalert('Quotes request was approved successfully');</script>","<script>showalert('Quotes request failed to approve');</script>");
				}
				
			}
			
		}
	
	}
	
	if($cmd == "rejectRequest"){ // reject request
	
		if(x_validatepost("request_id")){
			
			$id = xp("request_id");
			
			if(x_count("quotes_request","id='$id' LIMIT 1") > 0){
				
				if(x_count("quotes_request","id='$id' AND status='2' LIMIT 1") > 0){
					
					x_toasts("Quotes was rejected already!");
					
				}else{
					x_updated("quotes_request","id='$id'","status='2'","<script>showalert('Quotes request was rejected successfully!');</script>","<script>showalert('Quotes request failed to reject!');</script>");
				}
				
			}
			
		}
	
	}
	
	if($cmd == "deleteRequest"){ // delete request
	
		if(x_validatepost("request_id") && x_validatepost("ref_id") ){
			
			$id = xp("request_id");
			$rid = xp("ref_id");
			
			if(x_count("quotes_request","id='$id' LIMIT 1") > 0){
				
				if(x_count("filelogs","post_id='$rid' LIMIT 1") > 0){
					
					foreach(x_select("file_path","filelogs","post_id='$rid'","200","id") as $file){
						$link = $file["file_path"];
						
						if(file_exists($link)){
							unlink($link);
						}
						
					}
					
				}
				
				x_del("quotes_request","id='$id'","<script>showalert('Quotes was deleted successfully!');</script>","<script>showalert('Quotes failed to delete.');</script>");
				
			}
			
		}
	
	}

?>
