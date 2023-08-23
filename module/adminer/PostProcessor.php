<?php
	if(x_validatepost("cmd") && x_justvalidate($pageToken)){
		
		echo "Hi I am working now";
		exit();
		
		$content = x_clean(x_post("content"));
		$title = x_clean(x_post("title"));
		$category = x_clean(x_post("category")); // type
		$url = x_clean(x_post("url")); // url
		$post_id = strtoupper(md5(str_shuffle(uniqid().DATE("Ymdhis"))));
		$date = x_curtime(0,1);
		$dated = x_curtime(0,0);
		
		if(empty($title) || empty($content) || empty($category)){
			finish("postnew","Missing important field!!!");
			exit();
		}
		
		$filter_no_img = array("Terms of use","Privacy Policy","Cookies Policy","Refund policy","Core Values","History","Faq","CampSave");
		
		$create = x_dbtab("filelogs","
			 post_id VARCHAR(255) NOT NULL,
			 file_path TEXT NOT NULL,
			 file_type VARCHAR(20) NOT NULL,
			 file_size VARCHAR(50) NOT NULL,
			 status ENUM('0','1') NOT NULL
	 
			","myISAM");
			
			$create2 = x_dbtab("general_post","
			 post_id VARCHAR(255) NOT NULL,
			 url VARCHAR(255) NOT NULL,
			 type VARCHAR(255) NOT NULL,
			 title TEXT NOT NULL,
			 content TEXT NOT NULL,
			 is_images ENUM('0','1') NOT NULL,
			 count_images DOUBLE NOT NULL,
			 status ENUM('0','1') NOT NULL,
			 date_added VARCHAR(255) NOT NULL,
			 date_stamp DATETIME NOT NULL
	 
			","myISAM");
	
	if(!$create || !$create2){
		finish("postnew","Failed to create tables!");
		exit();
	}
	
	// creating qrcode directory
	$dirname = "general_post"; 
	 if(!is_dir($dirname)){
		 mkdir($dirname);
	 }
	
	
	// checking for duplicate post_id
	
	if(x_count("general_post","post_id='$post_id' LIMIT 1") > 0){
		
		finish("postnew","Post with id #$post_id already taken!");
		
	}else{
		
	$files = array_filter($_FILES['upload']['name']); 
	$total_count = count($_FILES['upload']['name']);
	
	$filter_upload = $_FILES['upload']['tmp_name'][0];// used to check if any file was uploaded
	
	//$success = "<script> alert('Content was posted successfully under $category!');window.location='postnew';</script>";
	$success = "<script> alert('Content was posted successfully under $category!');</script>";
	//$failed = "<script> alert('Failed to post content under $category!');</script>";
	$failed = "<script> alert('Failed to post content under $category!');</script>";
	
	if(is_uploaded_file($filter_upload)){
		
		for( $i=0 ; $i < $total_count ; $i++ ) {
		$file_no = "#".$i+1;
		// getting file size 
		$fsize = $_FILES['upload']['size'][$i];
		$final_size = x_getsize($fsize); // returns size in kb , mb
		$getlimit = 5242880*2; // 5mb*2 limit
		// getting file extension
		$file_ext = explode(".",$_FILES['upload']['name'][$i]);
		$final_ext = end($file_ext);
		// Filter allowed extension
		$allowed_ext = "jpg,png,gif,jpeg";
		$allowed = explode(",",$allowed_ext);
		
		if(!in_array(strtolower($final_ext),$allowed)){
			
			$msg = "Invalid format (Allowed :: $allowed_ext) for #$i ";
			finish("0","$msg");
		
		}elseif($fsize > $getlimit){
			$limit = x_getsize($getlimit) ;
			$msg = "File upload must not exceed $limit for $file_no";
			finish("0","$msg");
		
		}else{
	   //The temp file path is obtained
	   $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
	   // checking for uploaded file
	   if(!is_uploaded_file($tmpFilePath)){
		   finish("0","No file was uploaded for #$i");
	   }
	   if ($tmpFilePath != ""){
		   
		  $newFilePath = "$dirname/" . sha1($_FILES['upload']['name'][$i]).".".$final_ext;
		  
		  // File is uploaded to temp dir
		  
		  if(move_uploaded_file($tmpFilePath, $newFilePath)) {
			
			$failedd = "<script>alert('Failed to create upload record for #$i!');</script>";
			
			x_insert("post_id,file_path,file_type,file_size,status","filelogs","'$post_id','$newFilePath','$final_ext','$final_size','0'","&nbsp;","$failed");
			 
		  }else{
			 $failed = "<script>alert('Failed to upload file #$i!');</script>";
		  }
	   }
		}
	}
	
	x_update("filelogs","post_id='$post_id'","status='1'","&nbsp;","$failed");
	
	x_insert("url,post_id,type,title,content,is_images,count_images,status,date_added,date_stamp","general_post","'$url','$post_id','$category','$title','$content','1','$total_count','1','$date','$dated'","$success","$failed");
	
	}else{
		// No file was uploaded
		
		x_insert("url,post_id,type,title,content,is_images,count_images,status,date_added,date_stamp","general_post","'$url','$post_id','$category','$title','$content','0','0','1','$date','$dated'","$success","$failed");
	}
		
	}
	
	}

?>