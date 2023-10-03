<?php
if(!isset($PageToken)){
	exit();
}

if(x_validatepost("banks")){
	
	$amount = x_clean(x_post("amount")); // Top-up Amount
	$banks = x_clean(x_post("banks")); // Transaction Options
	
	// current logged in user details
	
	$userid = x_clean($_SESSION["CARRIAGE_PAL_ID"]); // User ID
	$email = x_clean($_SESSION["CARRIAGE_PAL_EMAIL"]); // Email
	
	$name = x_clean($_SESSION["CARRIAGE_PAL_NAME"]); // Name
	$token = x_clean($_SESSION["CARRIAGE_PAL_TOKEN"]); // Token
	
	$orderid = md5($token.strtoupper(uniqid())); // order unique id
	
	?>
	<script>
	function autoverify_payment(ref,optcmd,amount){
		var resultx = ".topup-alert";
		var formid = "#payModalProcessor";
		var closeForm = ".closePaymentModal";
		$.ajax({
			url: "payment_verify?ref="+ref+"&optcmd="+optcmd+"&total="+amount,
			type: "GET",
			success: function(data){
				//retrieve_balance(); // referesh balance
				$(formid).hide();
				$(resultx).show(500);
				$(resultx).html(data);
				setTimeout(function(){
					$(closeForm).click();
				},3000);
			},
			error: function(){
				$(resultx).show(500);
				$(resultx).html("<p class='alert-txt'>Callbacks failed to initialize!</p>");
			} 	        
		});	
	}
	</script>
	<?php
	if($banks == "mbt"){ // Manual transfer
	
		$tdate = x_clean(x_post("date")); // transaction date
		$tdetail = x_clean(x_post("tdetails")); // Transaction description
		$banks_acct = x_clean(x_post("bank_details")); // Company bank account ID
		
		if(!x_checkdate($tdate)){ // checking for valid date
		
			echo "<p class='alert-txt'>Invalid date format detected!<p>";
			
		}else{
			
			// current logged in user details
			
			$pay_id = $userid.str_shuffle(DATE('YmdHis').uniqid().substr(sha1($orderid),0,5)); // Transaction id for transfer
			$trx_token = sha1($pay_id); // Transaction Token
		
			if(x_count("manual_transfer_fee","id='1' AND status='1' LIMIT 1") > 0){
				
				$fee = x_getsingleupdate("manual_transfer_fee","amount","id='1' AND status='1'"); // fees 
				
			}else{
				
				$fee = 0 ;// fees charges
				
			}
			
			$total_amount = $fee + $amount; // amount with charges
			
			$timer = x_curtime(0,1); $os = xos(); $br = xbr(); $ip = xip();
			
			$curbal = x_crwbalance("NGN" , $userid); // Getting current balance
			
			x_insert("user_id,bank_account_id,transfer_description,transferdate,currency,tranx_type,user_token,status,payment_id,credit_amount,fee_amount ,total_amount,paid_on,tranx_token,approval_date,os,br,ip,balance_before,balance_after","topup_details","'$token','$banks_acct','$tdetail','$tdate','NGN','manual','$user_hash_token','0','$pay_id','$amount','$fee','$total_amount','$timer','$trx_token','','$os','$br','$ip','$curbal',''","<p class='alert-txt'>Your alert was sent successfully! You have to wait for payment verification which might take up to 48Hrs before your wallet can be credited.<b>Please do not resend this alert.</b></p>","<p class='alert-txt'>Failed to send alert</p>");
		}
		
	}elseif($banks == "ps"){ // Paystack company
	
		$pkey = x_getsingle("SELECT publickey FROM paymentkeys WHERE company='paystack' AND status='1' LIMIT 1","paymentkeys WHERE company='paystack' AND status='1' LIMIT 1","publickey"); // Getting public key
		
		$skey = x_getsingle("SELECT secretkey FROM paymentkeys WHERE company='paystack' AND status='1' LIMIT 1","paymentkeys WHERE company='paystack' AND status='1' LIMIT 1","secretkey"); // Getting secret key
		
		$fee = x_pstkfees($amount);
		?>
			 <script type="text/javascript">
				function payWithPaystack(){
						var handler = PaystackPop.setup({
						  currency: 'NGN', //This can only be either NGN or USD
						  key: '<?php echo $pkey;?>',
						  email: "<?php echo $email;?>",
						  amount: <?php echo ($amount+$fee)*100;?>, // Amount + gateway charges
						  ref: "<?php echo $orderid.rand(1,1000);;?>",
						  metadata: {
							 custom_fields: [
								{
									display_name: "<?php echo $name;?>",
									variable_name: "<?php echo $email;?>",
									value: "<?php echo $email;?>"
								}
							 ]
						  },
						  callback: function(response){
							  var ref = response.reference;
							  var optcmd = "paystack";
							  var amt = <?php echo $amount;?>;
							  //autoverify_payment(ref,optcmd,amount);
							  var amount = parseFloat(amt);
							   autoverify_payment(ref,optcmd,amount);	
						  },
						  onClose: function(){
							
						  }
						});
						handler.openIframe();
					  }
					  payWithPaystack();
			</script>
		<?php
	
	}elseif($banks == "fw"){ // Flutter waves company
	
		$fpkey = x_getsingle("SELECT publickey FROM paymentkeys WHERE company='flutters' AND status='1' LIMIT 1","paymentkeys WHERE company='flutters' AND status='1' LIMIT 1","publickey"); // Getting public key
		
		$fskey = x_getsingle("SELECT secretkey FROM paymentkeys WHERE company='flutters' AND status='1' LIMIT 1","paymentkeys WHERE company='flutters' AND status='1' LIMIT 1","secretkey"); // Getting secret key
		
		$fee = x_fwfees($amount); // flutters fees
		?>
			<script>
				  function flutterwavePayment() {
					const modal = FlutterwaveCheckout({
					  public_key: "<?php echo $fpkey;?>",
					  tx_ref: "<?php echo $orderid.time();?>",
					  amount: <?php echo ($amount+$fee);?>,
					  currency: "NGN",
					  payment_options: "card, banktransfer, ussd",
					  redirect_url: "payment_verify?optcmd=flutter&debited=<?php echo $amount;?>",
					  meta: {
						consumer_id: <?php echo $userid;?>,
						consumer_mac: "<?php echo $orderid;?>",
					  },
					  customer: {
						email: "<?php echo $email;?>",
						phone_number: "",
						name: "<?php echo $name;?>",
					  },
					  customizations: {
						title: "Carriage Pal",
						description: "Online logistics platform",
						logo: "",
					  },
					  callback: function(payment) {
					  
					   var ref = payment.id;
					   var optcmd = "flutter";
					   var amt = <?php echo $amount;?>;
					   var amount = parseFloat(amt);
					   //autoverify_payment(ref,optcmd,amount);
					   
					   modal.close();
					 },
					   onclose: function(incomplete) {
						  if (incomplete === true) {
							// Record event in analytics
						  }
						},
					});
				  }
				  flutterwavePayment();
			</script>
		<?php
		
	}else{
		x_print("Out of scope!");
		exit();
	}
}

?>