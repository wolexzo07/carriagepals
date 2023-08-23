<?php include("validatePage.php");
$pageToken = sha1(uniqid());
?>

<div class="member-Panel">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<span id="close_one_btn"  class="pull-right fa fa-close close_one_btn"></span>
			</div>
		</div>
	</div>
		
		<?php include("loginAccount.php");?>
		<?php include("regAccount.php");?>
		<?php include("resetForm.php");?>

</div>

 
