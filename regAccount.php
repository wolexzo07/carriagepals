<?php include("validatePage.php");?>

<div class="container-fluid" id="registerPanel">
<div class="row">
		<div class="col-12 col-md-3 col-lg-3"></div>
		<div class="col-12 col-md-6 col-lg-6">
		
		<form id="validate-appRegister"  method="POST" autocomplete="off">
		
		<h3 class="h-text mb-4"><i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;CREATE NEW ACCOUNT</h3>
		<div class="x-result-reg mt-3 mb-3"></div>
		<div class="row">
			<div class="col-12 col-md-6 col-lg-6">
					<input id="fname" type="text" autocomplete="off" required="required" class="form-control fname-reg mt-3 mb-4" placeholder="Enter first name" name="fname" />
			</div>
			<div class="col-12 col-md-6 col-lg-6">
					<input id="lname" type="text" autocomplete="off" required="required" class="form-control lname-reg mt-3 mb-4" placeholder="Enter last name" name="lname" />
			</div>
		</div>
		
			<input id="email" type="email" autocomplete="off" required="required" class="form-control email-reg mt-0 mb-4" placeholder="Enter email..." name="email" />
			
			<input id="mobile" type="text" autocomplete="off" required="required" class="form-control mobile-reg mt-0 mb-4" placeholder="Mobile number" name="mobile" />
			
			<input type="password" id="pass" autocomplete="off" required="required" placeholder="Password..." class="form-control pass-reg mb-4" name="pass" />
			
			<button type="submit" class="btn btn-info btn-round btn-createx">CREATE ACCOUNT</button>
			
			<input type="hidden" name="_token" value="<?php echo sha1(uniqid());?>"/>
			
			
		</form>
		
		<div class="row">
						<div class="col-12 f-styler mt-3">
							<a href="#" class="showLogin">Login account</a>&nbsp; | 
							&nbsp;<a href="#" class="showReset">Reset password</a>
						</div>
		</div>
		
		</div>
		<div class="col-12 col-md-3 col-lg-3"></div>
		
	</div>
</div>
