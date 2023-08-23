<?php include("validatePage.php");?>

<div class="container-fluid" id="loginPanel">

<div class="row">
	<div class="col-12 col-md-3 col-lg-3"></div>
		<div class="col-12 col-md-6 col-lg-6">
		
			<form id="validate-appLogin" method="POST" autocomplete="off">
			
			<h3 class="h-text mb-4"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;SIGN-IN ACCOUNT</h3>
			
				<div class="x-result-log mt-3"></div>
				
				<input  type="text" autocomplete="off" required="required" class="form-control mt-0 mb-4" placeholder="Mobile or email..." name="username"/>
				
				<input type="password" autocomplete="off" required="required" placeholder="Password..." class="form-control mb-4" name="password" />
				
				<button type="submit" class="btn btn-info btn-round">SIGN IN</button>
				
				<input type="hidden" name="_token" value="<?php echo sha1(uniqid());?>"/>
			
			</form>
		
			<div class="row">
				<div class="col-12 f-styler mt-3">
					<a href="#" class="showCreate">Create account</a>&nbsp; | 
					&nbsp;<a href="#" class="showReset">Reset password</a>
				</div>
			</div>
		
		</div>
		<div class="col-12 col-md-3 col-lg-3"></div>
</div>

</div>
	
