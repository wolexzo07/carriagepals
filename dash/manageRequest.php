 <?php
	session_start();
	include("../xe-library/xe-library74.php");

	if(x_validatesession("XCAPE_HACKS")){
			
			$pageToken = x_session("XCAPE_HACKS");
			
		}else{
			echo "<div class='alert alert-success' role='alert'>Missing parameter! Unable to load Manage Request</div>";
			finish("0","Missing parameter");
			exit();
		}
?>
 <div class="container-fluid">
  
		<div class="row mt-2">
  
			  <div class="col-lg-12 col-md-12 col-12">
			  
				<ul class="list-group">
					<li class="list-group-item">
						<h3 class="wallet-hd"> &nbsp;MANAGE <span class="g-color">REQUESTS </span></h3>
						
						<div class="row mt-2 pb-5">
  
							<div class="col-lg-2 col-md-2 col-12"></div>
							<div class="col-lg-8 col-md-8 col-12">
								
								<div class="quotes-details"></div>
							
							</div>
							<div class="col-lg-2 col-md-2 col-12"></div>
						
						</div>
						
						
					</li>
				</ul>
			  
			  </div>
			  
  
		</div>

</div>
  
  
 <script>
	$(document).ready(function(){
		viewManager(".quotes-details","fetch-rq-full");
	});
</script>