<html>
	<head>
		<title>Flutters : Payment Verification</title>
	</head>
<body>
<script>
	function response_sh(){
		setTimeout(function(){
			window.location="./?payments-msg=Wallet was topped-up successful";
		},3000);
	}
	function response_dp(){
		setTimeout(function(){
			window.location="./?payments-msg=Failed to top-up wallet! Duplicate Transaction.";
		},3000);
	}
	function response_fl(){
		setTimeout(function(){
			window.location="./?payments-msg=Failed to top-up wallet! Failed Transaction.";
		},3000);
	}
</script>
<?php
if(isset($pageExtension)){

	if(isset($ref) && isset($total) && isset($optcmd)){
		
		if(x_count("paymentkeys","company='flutters' AND status='1' LIMIT 1") > 0){
		
			$fskey = x_getsingleupdate("paymentkeys","secretkey","company='flutters' AND status='1'"); // Getting payment keys
		
		}else{
			
			echo "<p class='alert-txt'>Payment keys not found in db!</p>";
			exit();
			
		}		
		
			if(x_justvalidate($fskey)){ // validating the existence of the secret key
			
				$txid = $ref; // Transaction reference
				// initiating call to flutter verification API
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
					CURLOPT_HTTPHEADER => array(
					  "Content-Type: application/json",
					  "Authorization: Bearer $fskey"
					),
				  ));
				  
				  $response = curl_exec($curl);
				  
				  curl_close($curl);
				  
				  $res = json_decode($response);
				  
				  $status = $res->status;
				  
				  $amount_due = $total; // Transaction amount without fee
				  
				  $fee = x_fwfees($total); // flutters fees
				
				  if(($status=="success"))
				  {
					  $currency = $res->data->currency ;// Our transaction ref
					  $tx_ref = $res->data->tx_ref ;// Our transaction ref
					  $tx_id = $res->data->id; // Our transaction id from flutters
					  $amountCharged = $res->data->charged_amount;
					  $amountToPay = $total + $fee; // All amount involved
						
					  if($amountCharged >= $amountToPay){

				if(x_count("topup_details","tranx_type='flutter' AND payment_id='$txid' AND status='1' LIMIT 1") > 0){
					x_toasts("Duplicate Transaction Detected!");
					
				}else{
					// current logged in user details
					
					$userid = x_clean($_SESSION["CARRIAGE_PAL_ID"]); // User ID
					$email = x_clean($_SESSION["CARRIAGE_PAL_EMAIL"]); // Email
					
					$name = x_clean($_SESSION["CARRIAGE_PAL_NAME"]); // Name
					$token = x_clean($_SESSION["CARRIAGE_PAL_TOKEN"]); // Token
					
					$orderid = md5($token.strtoupper(uniqid())); // order unique id
					$pay_id = $txid; 
					$trx_token = sha1($pay_id); // Transaction Token
					
					$amount = $amountToPay - $fee; // amount without gateway fees
					$total_amount = $amountToPay; // amount with charges
					
					$timer = x_curtime(0,1);$os = xos();$br = xbr();$ip = xip();

					$curbal = x_crwbalance("NGN" , $userid);// current balance
						
					$newbalance = $curbal + $amount; // new balance
						
					x_update("manageaccount","id='$userid'","wallet_ngn='$newbalance'","&nbsp;","<p class='alert-txt'>Error:Failed to update balance!</p>"); // updating wallet balance
						
						
					x_insert("user_id,currency,tranx_type,status,payment_id,credit_amount,fee_amount ,total_amount,paid_on,tranx_token,approval_date,os,br,ip,balance_before,balance_after","topup_details","'$userid','NGN','flutter','1','$pay_id','$amount','$fee','$total_amount','$timer','$trx_token','$timer','$os','$br','$ip','$curbal','$newbalance'","<script>response_sh();</script>","<script>response_fl();</script>");
				}
						}
						else{
							
							  // Fraudulent transaction 
							  //x_toasts("Fraudulent transaction detected");
							  
							  echo "<script>response_dp();</script>";
						}
				  }
				  else{
					  
					  // Transaction Failed
					  //x_toasts("transaction Failed!");
					  
					  echo "<script>response_fl();</script>";
					  
				  }
			}

	}
            
}
?>

</body>
</html>
