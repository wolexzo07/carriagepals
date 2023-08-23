
		<div class="resultbox">
		<h2 class="tbox">MAKE <span class="insidetext">NEW POST</span></h2>
	
		<form id="initiate_posting" method="POST" autocomplete="off" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		
		<button class="btn btn-success btnb">POST DATA</button>
				<select name="category" style="margin-bottom:10pt;width:100%;height:40px;">
					<option value="">CHOOSE POST CATEGORY</option>
					<?php 
					
					$lists = array("list services","slides","know more","News","Faq","Services","Core Values","Team","Terms of use","Privacy Policy","Testimonial","Cookies Policy","Refund policy");
					if(count($lists) > 0){
						foreach($lists as $list){
						?>
							<option value="<?php echo $list;?>"><?php echo $list;?></option>
						<?php
						}
					}
					
					?>
					

				
				</select>
				<input type="text" required name="title" placeholder="Enter Post Title" style="margin-bottom:10pt;width:99.3%;height:40px;"/>
				
				<textarea id="editor" required name="content"></textarea>
				<script>initSample();</script>
				
				<input type="hidden" name="cmd" value="<?php echo sha1(uniqid())?>"/>
				
			
				<div class="uploadsystem">
				<p class="txt">Add link (Optional)</p>
					<input type="text" name="url" placeholder="Enter link" style="margin-bottom:10pt;width:450px;height:40px;"/>
					
					<p class="txt">Attachments (png, jpg, jpeg, gif | max => 5MB | Optional)</p>
					<input type="file" multiple="multiple" name="upload[]"/>
				</div>
				
				
				
		
		</form>
		
			<div class="post-result" id="post-result"></div>
		
		
		</div>
		
		
<script>
$(document).ready(function(){
	formpusher("#initiate_posting",".post-result","manage-posting"); // login
	//viewManager("#features3-aaa","list-services"); // login	
});
	function viewManager(result,cmd){
	  $(result).html("<center><img class='mt-3 mb-3' src='img/ajax-loader.gif' style='width:20px;'/> Loading. Please wait</center>");
		$.ajax({
				url:"retrievingResult?hashkey=<?php echo $_SESSION['XCAPE_HACKS'];?>&cmd="+cmd,
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
				url:"manageApplication?hashkey=<?php echo $_SESSION['XCAPE_HACKS'];?>&cmd="+cmd,
				data:new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success:function(response){

				},
				error:function(){}
			});
		});
    }
</script>