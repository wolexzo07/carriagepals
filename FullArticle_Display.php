<?php
	include("xe-library/xe-library74.php");
	$PageToken = sha1(uniqid());

	if(x_validatesession("XCAPE_HACKS")){}else{
		$_SESSION['XCAPE_HACKS'] = $PageToken;
	}
	
	if(x_validateget("newstoken") && x_validateget("type")){
		$type = xg("type");
		$newstoken = xg("newstoken");
		
		$allowed = array("list services","news","know more" ,"Terms of use","Privacy Policy","Cookies Policy"); 
		
		if(!in_array($type,$allowed)){
			finish("./","Invalid url address (Options)!");
		}
		
		
		if(x_count("general_post","post_id = '$newstoken' AND type='$type' LIMIT 1") > 0){
			
			foreach(x_select("id , post_id , title , content , count_images , is_images","general_post","type='$type' AND status='1' AND post_id = '$newstoken'","10","id desc") as $gp){
				$id = $gp["id"];
				$pid = $gp["post_id"];
				$title = $gp["title"];
				$cn = $gp["content"];
				
				$is_img = $gp["is_images"];
				$img_count = $gp["count_images"];
				
				if($title == "Get to know us"){
					$title = "about campus cloud";
				}
				
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
					$getImg = "general_post/placeholder.jpg";
				}
			
			}
			
		}else{
			finish("./","Invalid post id!");
		}
		
	}else{
		finish("./","Invalid url address!");
	}
?>



<!DOCTYPE html>
<html>
<head>
  <title>C2R NEWS :: <?php echo $title;?> </title>
  <?php include("nheader.php");?>
  <!—- ShareThis BEGIN -—>
<script async src="//platform-api.sharethis.com/js/sharethis.js#property=5cb08dab477b060012f12e1e&product="sticky-share-buttons"></script>
<!—- ShareThis END -—>
</head>
<body>
  
<?php include("headSection.php");?>
<?php //include("n_searcher.php");?>



<section  data-bs-version="5.1" class="features15 cid-t2US6uKc1W" id="features16-dl">

    <div style="padding:0pt" class="container-fluid">
        <div class="content-wrapper">
            <div class="row align-items-center">
                <div class="col-12 col-lg">
					<?php
						if($is_mobile || $is_tablet){
							$optn = "mt-4";
						}else{
							$optn = "";
						}
					?>
						
				   <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style display-2 pb-5 <?php echo $optn;?>"><strong><?php echo strtoupper($title);?></strong></h6>
						
						<?php
							$allowed = array("news","CHOF","MCCN","CampAds", "CampSave" , "Campus Affairs");
							if(in_array($type,$allowed)){
									?>
						<div style="height:360px;overflow:auto;" class="image-wrapper">
							<img src="module/<?php echo $getImg;?>" alt="<?php echo $title;?>">
						</div>
								<?php
							}else{
							
							}
						?>
						
                        <div style="background:white;height:500px;overflow:auto;" class="mbr-text mbr-fonts-style p-5 display-7"><?php echo $cn;?></div>
                       
                    </div>
					
                </div>
                <!--<div class="col-12 col-lg-4"></div>-->
            </div>
        </div>
    </div>
</section>

<?php 
	if($type != "news"){
		$styopt = "none";
	}else{}
?>

<section style="display:<?php echo $styopt;?>;" data-bs-version="5.1" class="slider4 mbr-embla cid-t2YhThOql7" id="slider4-p"></section>

<?php
	include("nfooter.php");
?>
</body>
</html>