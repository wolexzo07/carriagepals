<?php
if(!isset($pageToken)){
	exit();
}
?>
<script>
	function changephoto(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload = function (e) {
		$(".img-prev").attr('src' , e.target.result);
		};
		reader.readAsDataURL(input.files[0]);

	}
}
</script>
<form id="update-photo" method="POST">
		
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="img-upload"><input type="file" onchange="changephoto(this)" required="required" class="files" name="upload"/></div>
			</div>
			<div class="col-lg-6 col-md-6 col-12">
				<div class="img-styler">
					<img style="width:100px;height:100px;margin-bottom:20px;" src="userphoto/avatar.png" class="img-prev mt-1"/>
				</div>
			</div>
		</div>

		<input type="hidden" name="_token" value="<?php echo $_SESSION['XCAPE_HACKS'];?>" />
		<input type="reset" style="display:none;" class="reset-btn" name="reset" />
		
		<div class="row">
			<div class="col-lg-12 col-md-12 col-12">		
			  <button class="btn btn-primary mt-1 mb-1" id="bup"><i class="fa fa-image"></i> &nbsp;&nbsp;Update photo</button>
			</div>
		</div>
</form>

<div class="update-photo"></div>

<style>
.img-upload{
	padding-top:30pt;
}

.img-styler{
	
}
</style>