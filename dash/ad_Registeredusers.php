<?php include_once("admin_auth.php");?>
 <div class="container-fluid">
  
		<div class="row mt-2">
  
			  <div class="col-lg-12 col-md-12 col-12">
			  
				<ul class="list-group">
					<li class="list-group-item">
						<h3 class="wallet-hd mb-3"> &nbsp;MANAGE <span class="g-color">USERS </span></h3>
						
						<div class="row">
						
							<div class="col-12 col-lg-12 col-md-12">
								<div class="r-users"></div>
							</div>
							
						</div>
						
						
					</li>
				</ul>
			  
			  </div>
			  
  
		</div>

</div>
  
  
  <script>
	$(document).ready(function(){
		//formpusher("#update-photo",".update-photo","uphoto"); // change password
		viewManager(".r-users","registered-users");
	});
  </script>