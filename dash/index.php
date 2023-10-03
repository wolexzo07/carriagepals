<?php
	session_start();
	include("../xe-library/xe-library74.php");
	include("../siteinfo.php");
	
	if(x_validatesession("CARRIAGE_PAL_ID")){
		
		$currentuser = x_session("CARRIAGE_PAL_ID");
		
	}else{
		finish("../","Invalid session! Login");
		exit();
	}
	
	if(x_validatesession("XCAPE_HACKS")){
		
		$pageToken = $_SESSION["XCAPE_HACKS"];
		
	}else{
		finish("../","Missing parameter");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $sitename;?> :: <?php echo $metades;?></title>
  <?php include("library.php");?>
</head>

<body>

	<?php include("navigated.php");?>

	<div class="PageFetcher"></div>


	<script>
	$(document).ready(function(){
		//showalert("Login successful!");
		viewManager(".img-control","profile-photo");
		pageLoader("homedash",".PageFetcher");
	});
	</script>
	
  <?php
	if(x_validateget("pay_messages")){ // get
		$getinfo = xg("pay_messages");
		x_toasts("$getinfo");
		?>
		<script>
		setTimeout(function(){
			window.location="./";
		},5000);
		</script>
		<?php
	}
  ?>
	
<script>
 function ad_viewManager(user_id,result,cmd){
	  $(result).slideDown("100");
	  $(result).html("<center><img src='../img/ajax-loader.gif' style='width:20px;'/></center>");
		$.ajax({
				url:"manageController?uid="+user_id+"&hashkey=<?php echo $_SESSION['XCAPE_HACKS']?>&cmd="+cmd,
				method:"GET",
				success:function(response){
					$(result).html(response);
				},
				error:function(){}
			});
	}
	
 function viewManager(result,cmd){
	  $(result).html("<center><img src='../img/ajax-loader.gif' style='width:20px;'/></center>");
		$.ajax({
				url:"manageController?hashkey=<?php echo $_SESSION['XCAPE_HACKS']?>&cmd="+cmd,
				method:"GET",
				success:function(response){
					$(result).html(response);
				},
				error:function(){}
			});
	}
	
 function formpusher(formid,resultid,cmdvalue){
	  $(formid).submit(function(e){
			e.preventDefault();
			let cmd = cmdvalue;
			$(resultid).html("<img src='../img/ajax-loader.gif' style='width:20px;'/> ");
			$.ajax({
				method:"POST",
				url:"manageController?hashkey=<?php echo $_SESSION['XCAPE_HACKS'];?>&cmd="+cmd,
				data:new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success:function(response){
					$(resultid).html(response);
					
					if(cmdvalue == "swap-funds"){
						viewManager("#get-usd","usd-balance");
						viewManager("#get-ngn","ngn-balance");
					}
					
					if(cmdvalue == "set-fxrate"){
						viewManager(".r-managefx","fetch-fxrate");
						$("#resetRate").click();
					}
					
					if(cmdvalue == "uphoto"){
						$(".img-prev").attr("src","userphoto/avatar.png");
						$(".reset-btn").click();
						viewManager(".img-control","profile-photo");
					}
					
					if(cmdvalue == "upassword"){
						$("input").val("");
					}
				},
				error:function(){}
			});
		});
    }
	
	function imagesManager(result,post_ref,cmd){
	  $(result).html("<center><img src='../img/ajax-loader.gif' style='width:20px;'/></center>");
		$.ajax({
				url:"manageController?hashkey=<?php echo $_SESSION['XCAPE_HACKS']?>&cmd="+cmd+"&ref="+post_ref,
				method:"GET",
				success:function(response){
					$(result).html(response);
				},
				error:function(){}
			});
	}
	
</script>
	
</body>
</html>