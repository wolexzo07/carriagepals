<?php include_once("admin_auth.php");?>
 <div class="container-fluid">
  
		<div class="row mt-2">
  
			  <div class="col-lg-12 col-md-12 col-12">
			  
				<!--<ul class="list-group">
					<li class="list-group-item">-->
					
						<h3 class="wallet-hd mb-3"> &nbsp;MANAGE <span class="g-color">FX RATE </span></h3>
						
						<div class="row">
							<div class="col-12 col-lg-2 col-md-2"></div>
							<div class="col-12 col-lg-8 col-md-8">
							
								<div class="fx-form">
									
									<form id="fxrate">
									
										<div class="row">
											
											<div class="col-12 col-lg-6 col-md-6 mt-2">
											
												<p class="b-rate mb-1 f-bold">SELLING RATE</p>
												<input type="text" class="form-control input-lg" name="s-rate" placeholder="Enter Selling Rate"/>
												
											</div>	
											
											<div class="col-12 col-lg-6 col-md-6 mt-2">
											
												<p class="b-rate mb-1 f-bold g-color">BUYING RATE</p>
												<input type="text" class="form-control input-lg" name="b-rate" placeholder="Enter Buying Rate"/>
											
											</div>
											
										</div>
										
										<div class="row mt-2">
										
											<div class="col-12 col-lg-12 col-md-12">
											
												<input type="submit" class="btn btn-primary btn-lg" value="Set Rate">
												<input type="reset" id="resetRate" style="display:none;">
												
											
											</div>
										
										</div>

									</form>
									
									<div class="fx-formRex"></div>
									
								</div>
								
								<div class="r-managefx"></div>
							</div>
							<div class="col-12 col-lg-2 col-md-2"></div>
							
						</div>
						
						
					<!--</li>
				</ul>-->
			  
			  </div>
			  
  
		</div>

</div>
  
  
  <script>
	$(document).ready(function(){
		viewManager(".r-managefx","fetch-fxrate");
		formpusher("#fxrate",".fx-formRex","set-fxrate");
	});
  </script>