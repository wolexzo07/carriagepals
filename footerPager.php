<?php include("validatePage.php");?>
<!----<section class="elb-widgets eb-chats-widget cid-tFVYyHw5kd" once="chat" id="eb-chats-widget-7"><script src="https://s.electricblaze.com/widget.js" defer=""></script>
<div class="electricblaze-id-2Uhx9Cl"></div></section>---->

<script src="js/jquery-3.7.0.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/parallax/jarallax.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/ytplayer/index.js"></script>
<script src="assets/smart-cart/minicart.js"></script>
<script src="assets/smart-cart/minicart-customizer.js"></script>
<script src="assets/dropdown/js/navbar-dropdown.js"></script>
<script src="assets/formoid.min.js"></script>
  
<script>
$(document).ready(function(){
	$("#showMemberPanel").click(function(){
		$(".member-Panel").show(500);
	});
	
	$("#close_one_btn").click(function(){
		$(".member-Panel").hide(500);
	});
	
	$(".showCreate").click(function(){
		$("#loginPanel").hide(500);
		$("#registerPanel").show(500);
		$("#resetPanel").hide(500);
	});
	
	$(".showLogin").click(function(){
		$("#loginPanel").show(500);
		$("#registerPanel").hide(500);
		$("#resetPanel").hide(500);
	});
	
	$(".showReset").click(function(){
		$("#resetPanel").show(500);
		$("#loginPanel").hide(500);
		$("#registerPanel").hide(500);
	});
	
});
</script>

<script>
$(document).ready(function(){
	formpusher("#validate-appLogin",".x-result-log","lg"); // login
	formpusher("#validate-appRegister",".x-result-reg","rg"); // register
	formpusher("#validate-appReset",".x-result-reset","rt"); // reset
	viewManager("#features3-aaa","list-services");
});

  function viewManager(result,cmd){
	  $(result).html("<center><img class='mt-3 mb-3' src='img/ajax-loader.gif' style='width:20px;'/> Loading. Please wait</center>");
		$.ajax({
				url:"retrieve_Corevalues?hashkey=<?php echo $_SESSION['XCAPE_HACKS']?>&cmd="+cmd,
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
			$(resultid).html("<img src='img/ajax-loader.gif' style='width:15px;'/> ");
			$.ajax({
				method:"POST",
				url:"manageUserController?hashkey=<?php echo $_SESSION['XCAPE_HACKS'];?>&cmd="+cmd,
				data:new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success:function(response){

					if(cmd == "lg"){
							$(resultid).html(response);
							//$(".username").val("");
							//$(".passkey").val("");
							//$(".username").attr("disabled","disabled");
							//$(".passkey").attr("disabled","disabled");
						
					}else if(cmd == "rg"){
						
							if(response == "created"){
								
									$(resultid).html("<div class='alert alert-primary' role='alert'>Account was created!</div>");
									showalert("Account was created successfully!");
									$(".fname-reg").val("");
									$(".lname-reg").val("");
									$(".email-reg").val("");
									$(".mobile-reg").val("");
									$(".pass-reg").val("");
									$(".btn-createx").attr("disabled","disabled");
									
								}else{
									$(resultid).html(response);
									}
								
						}else{
							$(resultid).html(response);
						}
					
				},
				error:function(){}
			});
		});
    }
</script>
