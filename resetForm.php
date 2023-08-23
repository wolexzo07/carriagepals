<?php include("validatePage.php");?>

<div class="container-fluid" id="resetPanel">

<div class="row">
	<div class="col-12 col-md-3 col-lg-3"></div>
		<div class="col-12 col-md-6 col-lg-6">
		
			<form id="validate-appReset" method="POST" autocomplete="off">
			
			<h3 class="h-text mb-4"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;PASSWORD RECOVERY</h3>
			
				<input id="email" type="text" autocomplete="off" required="required" class="form-control mt-0 mb-4" placeholder="Enter account email" name="email"/>
				
				<button type="submit" class="btn btn-info btn-round">RESET</button>
				
				<input type="hidden" name="_token" value="<?php echo sha1(uniqid());?>"/>
				
				<input type="hidden" name="baee1e076b3fe8f3b042c51e01384904" value="7da8492bf4a864614f46ac2ffd6b04a3aeea471c"/>	
				<div class="x-result-reset mt-3"></div>
			</form>
		
			<div class="row">
				<div class="col-12 f-styler mt-3">
					<a href="#" class="showCreate">Create account</a>&nbsp; | 
					&nbsp;<a href="#" class="showLogin">Sign-In account</a>
				</div>
			</div>
		
		</div>
		<div class="col-12 col-md-3 col-lg-3"></div>
</div>

</div>
	
