		  <div class="paymentModal">
				
			<div class="row">
				<div class="col-12 col-md-12 col-lg-12">
				  <span class="pull-right p-1"><i class="fa fa-close fa-2x closePaymentModal"></i></span>
				</div>
			</div>
				
	<!--<script src="https://js.paystack.co/v1/inline.js"></script>--->
	<script src="https://checkout.flutterwave.com/v3.js"></script>
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
		<div id="adjustModals" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 paymentList">
			
			<div id="alert-msg"></div>
			<!--- <script src="js/cartProcessor.js" type="text/javascript"></script>--->
			<form id="payModalProcessor">
				<ul class="list-group">
					<li class="list-group-item"><i class="fa fa-credit-card"></i> &nbsp;&nbsp;ADD <b>FUNDS</b>
					
					</li>
					
					<li class="list-group-item pl-2 pr-2">
					
					<div class="row">
						<div class="col-12">
						<button style="padding:10px;margin-top:-30px;margin-right:5px;" class="btn btn-primary btn-sm pull-right" id="payButton"><i class="fa fa-cc-mastercard"></i> &nbsp;  PAY</button>
						</div>
					</div>
					
					
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 t-amts">
						<?php
						if(x_count("top_uplimit","status='1'") > 0){
								foreach(x_select("0","top_uplimit","status='1'","1","id") as $amtchange){
									$min = $amtchange["min_amount"];
									$max = $amtchange["max_amount"];
								?>
						<p class="txt-top mt-1">ENTER AMOUNT:</p>
						<input type="number" min="<?php echo $min;?>" max="<?php echo $max;?>" required class="form-control mb-0" placeholder="Amount" name="amount" id="top-upAmt"/>
								<?php	
							}
						}	
						?>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 t-dates">
						<p class="txt-top mt-1">CHOOSE DATE:</p>
						<input type="date" class="form-control mb-0" placeholder="Date of payment" name="date" id="top-upDate"/>
						</div>
					</div>
					
					
					<div class="row t-details">
						<div class="col-12 col-lg-12 col-md-12">
						<p class="txt-top mt-2">TRANSACTIONS DETAILS:</p>
							<textarea id="top-descrip" class="form-control" style="resize:none;" name="tdetails" placeholder="Transfer Bank / Description"></textarea>
						</div>
					</div>
					
					
					</li>
					
					<li class="list-group-item">
					<p class="txt-top mt-0">PAYMENT OPTIONS</p>
					
						<?php
							if(x_count("payment_types","status='1'") > 0){
								$countPay=0;
								foreach(x_select("0","payment_types","status='1'","5","id") as $banks){
									$countPay++;
									$company = $banks["company"];
									$cvalue = $banks["cvalues"];
									$clogo = $banks["logo"];
									?>
									<input required id="payOptions<?php echo $countPay;?>" type="radio" value="<?php echo $cvalue;?>" name="banks"/>&nbsp;&nbsp; <?php echo $company;?><br/><br/>
									<?php
								}
							}
						?>
						
						<?php
						if(x_count("company_accounts","status='1'") > 0){
							?>
							<div class="listBanks">
							<ul class="list-group">
							<?php
								foreach(x_select("0","company_accounts","status='1'","5","id") as $banks){
										$account_name = $banks["account_name"];
										$account_number = $banks["account_number"];
										$bank_name = $banks["bank_name"];
										$id = $banks["id"];
										?>
										<li class="list-group-item">
											<p class="bank_name">
											<input class="blists" type="radio" value="<?php echo $id;?>" name="bank_details"/>
											<?php echo $bank_name;?> - <?php echo $account_number;?></p>
											<p class="acct_name"><?php echo $account_name;?></p>
											
										</li>
										<?php
								}
							?>
							</ul>
						</div>
							<?php
						}
						?>
							
					</li>
					<!---<li class="list-group-item"></li>--->
				</ul>
			</form>
			
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
	</div>
	
		  </div>
		  
		  <script>
		  $(document).ready(function(){
		  
			  $(".t-dates").hide();
			  $(".t-details").hide();
			  $(".t-amts").attr("class","col-12 t-amts");
			  
			  $(".closePaymentModal").click(function(){
				  $(".paymentModal").hide(500);
			  });
			  
			  $(".top-upbtn").click(function(){
				  $(".paymentModal").show(500);
			  });

			  $("#payOptions3").click(function(){
				  $("#payButton").html("<i class='fa fa-inbox'></i> &nbsp;  ALERT US");
				  $("#payButton").attr("class","btn btn-danger btn-sm pull-right");
				  $(".t-amts").attr("class","col-lg-6 col-md-6 col-sm-12 col-xs-12 t-amts");
				  $(".t-dates").show(500);
				  $(".t-details").show(500);
				  $(".listBanks").toggle(500);
				  $("#top-upDate").attr("required","required");			
				  $("#top-descrip").attr("required","required");			
				  $(".blists").attr("required","required");
			  });
			  
			  $("#payOptions1").click(function(){
				  $("#payButton").html("<i class='fa fa-cc-mastercard'></i> &nbsp;  PAY");
				   $("#payButton").attr("class","btn btn-primary btn-sm pull-right");
				  $(".listBanks").hide(500);
				  $(".t-dates").hide();
				  $(".t-details").hide();
				  $(".t-amts").attr("class","col-12 t-amts");
				  $("#top-upDate").removeAttr("required");			
				  $("#top-descrip").removeAttr("required");			
				  $(".blists").removeAttr("required");
			  });
			  
			  $("#payOptions2").click(function(){
				  $("#payButton").html("<i class='fa fa-cc-mastercard'></i> &nbsp;  PAY");
				  $("#payButton").attr("class","btn btn-primary btn-sm pull-right");
				  $(".listBanks").hide(500);
				  $(".t-dates").hide();
				  $(".t-details").hide();
				  $(".t-amts").attr("class","col-12 t-amts");
				  $("#top-upDate").removeAttr("required");			
				  $("#top-descrip").removeAttr("required");			
				  $(".blists").removeAttr("required");
			  });
		  
		  });
		  </script>
		  
<style>
#adjustModals{
	
}
.txt-top{
	font-size:9pt;
	font-weight:bold;
	color:green;
}
.bank_name{
	font-weight:bold;
	font-size:10pt;
}
.acct_name{
	font-size:10pt;
}
.listBanks{
	display:none;
} 
#alert-msg{
	color:green;
	padding-bottom:10px;
	display:none;
}
.paymentModal{
	position:fixed;
	background:white;
	opacity:0.9;
	z-index:1000;
	box-shadow:10px 10px 10px lightgray;
	-webkit-box-shadow:10px 10px 10px lightgray;
	-moz-box-shadow:10px 10px 10px lightgray;
	-o-box-shadow:10px 10px 10px lightgray;
	-ms-box-shadow:10px 10px 10px lightgray;
	overflow:auto;
	padding-bottom:20px;
	display:none;
	top:5%;
	bottom:;
	right:5%;
	left:5%;
	width:85%;
	height:500px;
}

.closePaymentModal{
	padding:0px;
}

.paymentList{

}
</style>