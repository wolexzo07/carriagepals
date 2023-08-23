<?php
if(!isset($pageToken)){
	exit();
}
?>
<form id="update-password" method="POST">
	
	
	<div class="row">
		<div class="col-12 col-lg-12 col-md-12 mt-2">

			<input type="password" id="oldp" required="required" placeholder="Enter old password" name="old" class="form-control"/>
			
		</div>
		
		<div class="col-12 col-lg-6 col-md-6 mt-2">
		
			<input type="password" id="new" required="required" placeholder="Enter new password" name="new" class="form-control"/>
		</div>
		
		<div class="col-12 col-lg-6 col-md-6 mt-2">

		   <input type="password" id="cnew" required="required" placeholder="Confirm new password" name="neww" class="form-control"/>
		   
		</div>
	</div>
	

	<input type="hidden" name="_token" value="<?php echo $_SESSION['XCAPE_HACKS'];?>"/>
				  
	<button class="btn btn-success mb-1 mt-2"><i class="fa fa-lock"></i> &nbsp;&nbsp;Update pass</button>
	
</form>
<div class="update-password"></div>