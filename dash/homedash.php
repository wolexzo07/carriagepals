<?php
	session_start();
	include("../xe-library/xe-library74.php");

	if(x_validatesession("XCAPE_HACKS")){
			
			$pageToken = x_session("XCAPE_HACKS");
			
		}else{
			echo "<div class='alert alert-success' role='alert'>Missing parameter! Unable to load Dashboard</div>";
			finish("0","Missing parameter");
			exit();
		}
?>
  <div class="container-fluid">
  
		<div class="row mt-2">
  
			  <div class="col-12 col-md-6 col-lg-6">
			  
				<ul class="list-group">
					<li class="list-group-item">
						<h3 class="wallet-hd">NAIRA - WALLET
						<button id="top-upbtn" class="btn btn-primary pull-right btn-font top-upbtn">
						<i class="fa fa-upload"></i>&nbsp;&nbsp; FUND</button>
						</h3>
						<h3 id="get-ngn" class="wallet-bl"></h3>
						
					</li>
				</ul>
			  
			  </div>
			  
			  <div class="col-12 col-md-6 col-lg-6">
			  
				<ul class="list-group">
					<li class="list-group-item">
						<h3 class="wallet-hd">DOLLAR - WALLET 
						<button class="btn btn-success pull-right btn-font swap-button"><i class="fa fa-upload"></i>&nbsp;&nbsp; SWAP</button>
						</h3>
						<h3 id="get-usd" class="wallet-bl"></h3>
						
					</li>
				</ul>
			  
			  </div>
			  
		</div>
		
		<div class="row mt-2">
  
			  <div class="col-12 col-md-3 col-lg-3">
				 <ul class="list-group">
					<li class="list-group-item">
						<h3 class="sub-cards">Pending Requests</h3>
						<h3 id="pending-request" class="sub-cards-sm">2</h3>
					</li>
				 </ul>
			  </div>
			  
			   <div class="col-12 col-md-3 col-lg-3">
			    <ul class="list-group">
					<li class="list-group-item">
						<h3 class="sub-cards">Approved Requests</h3>
						<h3 id="approved-request" class="sub-cards-sm">2</h3>
					</li>
				</ul>
			  </div>
			  
			  <div class="col-12 col-md-3 col-lg-3">
			   <ul class="list-group">
					<li class="list-group-item">
						<h3 class="sub-cards">Rejected Requests</h3>
						<h3 id="rejected-request" class="sub-cards-sm">2</h3>
					</li>
				</ul>
			  </div>
			  
			  <div class="col-12 col-md-3 col-lg-3">
			  <ul class="list-group">
					<li class="list-group-item">
						<h3 class="sub-cards">Amount Spent </h3>
						<h3 id="amount-spent" class="sub-cards-sm">2</h3>
					</li>
				</ul>
			  </div>
			  
			  
	    </div>
		
		<div class="row mt-2">
			<div class="col-12 col-md-6 col-lg-6">
			
			  <div class="swap-details"></div>
			  
			</div>
			  
			  <div class="col-12 col-md-6 col-lg-6">
			  
				<div class="quotes-details"></div>
				
			  </div>
		</div>

  </div>
  

  
  <?php include("swap-funds.php");?>
  <?php include("paymentModal.php");?>

  <script>
	$(document).ready(function(){
		
		viewManager("#get-usd","usd-balance");
		viewManager("#get-ngn","ngn-balance");
		
		viewManager("#pending-request","pending-request");
		viewManager("#approved-request","approved-request");
		viewManager("#rejected-request","rejected-request");
		viewManager("#amount-spent","amount-spent");
		
		viewManager(".swap-details","fetch-swap");
		viewManager(".quotes-details","fetch-rq");
		formpusher("#funds-mover",".swap-result","swap-funds");
		
		$(".swap-button").click(function(){
			$(".swap-funds").show("500");
		});
		$(".swap-close").click(function(){
			$(".swap-funds").hide("500");
		});
	});
	</script>