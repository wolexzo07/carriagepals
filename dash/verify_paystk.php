<?php
if(isset($pageExtension)){ //not modified to work with carriagepal yet
	
	if(x_count("paymentkeys","status='1' AND company='paystack' LIMIT 1") > 0){	
	
	require 'Paystack.php'; 
	
	$py = $ref;
	
	foreach(x_select("secretkey,publickey","paymentkeys","status='1' AND company='paystack'","1","id") as $key){
		$sk = $key["secretkey"];$pk = $key["publickey"];
		
		$paystack = new Paystack($sk);
		$trx = $paystack->transaction->verify(
			[
			 'reference'=>$py
			]
		);
		if(!$trx->status){
			exit($trx->message);
		}

		if('success' == $trx->data->status){
			
				if(x_count("topup_details","tranx_type='paystack' AND payment_id='$ref' AND status='1' LIMIT 1") > 0){ // Handling successful Tranx!;
					echo "<p class='msg-txt'>Duplicate Transaction Detected!</p>";
				}else{
					// insert transaction details
					
					// current logged in user details
					$userid = x_clean($_SESSION["ER_ID_2022_VI"]); // User ID
					$email = x_clean($_SESSION["ER_EMAIL_2022_VI"]); // Email
					$name = x_clean($_SESSION["ER_NAME_2022_VI"]); // Name
					$token = x_clean($_SESSION["ER_TOKEN_2022_VI"] ); // token
					
					$orderid = x_clean($_SESSION["XELOW_COMMERCE_ORDER_ID"]); // order unique id
					$pay_id = $orderid; 
					$trx_token = sha1($orderid); // Transaction Token
					
					
					$user_hash_token = eptoks($token); // hashed user token
					$amount = $total; // amount without gateway
					$fee = x_pstkfees($amount); // fees charges
					$total_amount = $fee + $amount; // amount with charges
					
					$timer = x_curtime(0,1);$os = xos();$br = xbr();$ip = xip();
					
					// Getting user current balance
					
					if(x_count("ep_wallets","utoken='$user_hash_token' LIMIT 1") > 0){
						
						$curbal = x_getsingle("SELECT wallet_balance FROM ep_wallets WHERE utoken='$user_hash_token' LIMIT 1","ep_wallets WHERE utoken='$user_hash_token' LIMIT 1","wallet_balance");// current balance
						
						$newbalance = $curbal + $amount;
						
						x_update("ep_wallets","utoken='$user_hash_token'","wallet_balance='$newbalance'","&nbsp;","<p class='alert-txt'>Error:Failed to update balance!</p>"); // updating wallet balance
						
					}else{
						echo "<p class='alert-txt'>No wallets attached to user</p>";
						exit();
					}
					
					x_insert("user_id,currency,tranx_type,user_token,status,payment_id,credit_amount,fee_amount ,total_amount,paid_on,tranx_token,approval_date,os,br,ip,balance_before,balance_after","topup_details","'$token','NGN','paystack','$user_hash_token','1','$pay_id','$amount','$fee','$total_amount','$timer','$trx_token','$timer','$os','$br','$ip','$curbal','$newbalance'","<center><img src='../image/success.jpg' style='wid' class='img-fluid'/></center>","<center><img src='../image/failed.png' class='img-fluid'/></center>");
				}
			
			}
		
		}
	
	}else{
		echo "Payment key deactivated!";
		}
		
}
?>