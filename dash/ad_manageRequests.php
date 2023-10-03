<?php include_once("admin_auth.php");?>
 <div class="container-fluid">
  
		<div class="row mt-2">
  
			  <div class="col-lg-12 col-md-12 col-12">
			  
				<!--<ul class="list-group">
					<li class="list-group-item">-->
					
						<h3 class="wallet-hd mb-3"> &nbsp;MANAGE <span class="g-color">REQUESTS </span></h3>
						
						<div class="row">
							<div class="col-12 col-lg-1 col-md-1"></div>
							<div class="col-12 col-lg-10 col-md-10">
								<div class="r-manageRequests"></div>
							</div>
							<div class="col-12 col-lg-1 col-md-1"></div>
							
						</div>
						
						
					<!--</li>
				</ul>-->
			  
			  </div>
			  
  
		</div>

</div>
  
  
  <script>
	$(document).ready(function(){
		viewManager(".r-manageRequests","f-manageRequests");
	});
  </script>