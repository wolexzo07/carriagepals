<?php
	session_start();
	include("xe-library/xe-library74.php");
	$PageToken = md5(uniqid());
	if(x_validateget("hashkey") && x_validateget("cmd")){
		
		$cmd = xg("cmd");
		
		if($cmd == "list-services"){ // Teams view 

			if(x_count("general_post","type='list services' LIMIT 10") > 0){
				?>
	<div class="container-fluid">
        
        <div class="row mt-4">
				<?php
				foreach(x_select("id , post_id , title , content , count_images , is_images","general_post","type='list services' AND status='1'","10","id desc") as $gp){
					$id = $gp["id"];
					$pid = $gp["post_id"];
					$title = $gp["title"];
					$cn = $gp["content"];
					
					$is_img = $gp["is_images"];
					$img_count = $gp["count_images"];
					
					if($img_count > 0){
						if($img_count == 1){
							$getImg = x_getsingleupdate("filelogs","file_path","post_id='$pid'");
						}else{
						   foreach(x_select("file_path","filelogs","post_id='$pid'","10","id") as $getimages){
								$fp[] = $getimages["file_path"];
							}
							$getImg = $fp[0];
						}
					}else{
						$getImg = "module/adminer/general_post/placeholder.jpg";
					}
					
					?>
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <div class="item-wrapper">
                    <div class="item-img">
                        <img src="assets/images/mbr.jpg" alt="sea frieght">
                    </div>
                    <div class="item-content">
                        <h5 class="item-title mbr-fonts-style display-7"><strong>SEA FREIGHT</strong></h5>
                        
                        <p class="mbr-text mbr-fonts-style mt-3 display-7">Embrace the power of sea shipping and embark on a journey that opens up a world of opportunities for your business.</p>
                    </div>
                    <div class="mbr-section-btn item-footer mt-2"><a href="" class="btn btn-primary item-btn display-7" target="_blank">Learn more
                            &gt;</a></div>
                </div>
            </div>
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <div class="item-wrapper">
                    <div class="item-img">
                        <img src="assets/images/mbr-1.jpg" alt="Air Freight">
                    </div>
                    <div class="item-content">
                        <h5 class="item-title mbr-fonts-style display-7"><strong>AIR FREIGHT</strong></h5>
                        
                        <p class="mbr-text mbr-fonts-style mt-3 display-7">Elevate your logistics to new heights by embracing the speed, reliability, and reach of air shipping solutions.</p>
                    </div>
                    <div class="mbr-section-btn item-footer mt-2"><a href="" class="btn item-btn btn-warning display-7" target="_blank">Learn more
                            &gt;</a></div>
                </div>
            </div>
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <div class="item-wrapper">
                    <div class="item-img">
                        <img src="assets/images/mbr-5.jpg" alt="buy">
                    </div>
                    <div class="item-content">
                        <h5 class="item-title mbr-fonts-style display-7"><strong>ORDER FROM UK AND US STORES</strong></h5>
                        
                        <p class="mbr-text mbr-fonts-style mt-3 display-7">Borderless Shopping Made Effortless: seamlessly order from anywhere in the world for Global Retail Delights.<br></p>
                    </div>
                    <div class="mbr-section-btn item-footer mt-2"><a href="" class="btn btn-primary item-btn display-7" target="_blank">Learn more
                            &gt;</a></div>
                </div>
            </div>
					
					<?php
				}
				?>
        </div>
    </div><?php
			}
			?>
           
        </div>
    </div>
			<?php
		}
	
		
	}

?>



<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>  
<script src="assets/parallax/jarallax.js"></script> 
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/ytplayer/index.js"></script> 
<script src="assets/dropdown/js/navbar-dropdown.js"></script>
<script src="assets/embla/embla.min.js"></script> 
<script src="assets/embla/script.js"></script>
<script src="assets/theme/js/script.js"></script>
<script src="assets/formoid/formoid.min.js"></script>