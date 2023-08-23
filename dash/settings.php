  <?php
	session_start();
	include("../xe-library/xe-library74.php");

	if(x_validatesession("XCAPE_HACKS")){
			
			$pageToken = x_session("XCAPE_HACKS");
			
		}else{
			echo "<div class='alert alert-success' role='alert'>Missing parameter! Unable to load Settings</div>";
			finish("0","Missing parameter");
			exit();
		}
?>
 <div class="container-fluid">
  
		<div class="row mt-2">
  
			  <div class="col-lg-12 col-md-12 col-12">
			  
				<ul class="list-group">
					<li class="list-group-item">
						<h3 class="wallet-hd mb-3"> &nbsp;MANAGE <span class="g-color">ACCOUNT </span></h3>
						
						<div class="row">
							<div class="col-12 col-lg-6 col-md-6">
								<div class="list-group">
									<div class="list-group-item">
										<h4 class="txt-settings">CHANGE <span class="">PASSWORD</span></h4>
										
										<?php include("updatePassword.php");?>
										
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-6 col-md-6">
							    <div class="list-group">
									<div class="list-group-item">
										<h4 class="txt-settings">UPDATE<span class=""> PHOTO</span></h4>
										
										<?php include("updatePhotos.php");?>
										
									</div>
								</div>
							</div>
						</div>
						
						
					</li>
				</ul>
			  
			  </div>
			  
  
		</div>

</div>
  
  
  <script>
	$(document).ready(function(){
		formpusher("#update-password",".update-password","upassword"); // change password
		formpusher("#update-photo",".update-photo","uphoto"); // change password
		//viewManager("#features3-aaa","list-services");
	});
  </script>