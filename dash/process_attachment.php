<?php
if(!isset($ref)){
	exit();
}
	$post_id = $ref;
	$dirname = "requestPhotos"; 
	 if(!is_dir($dirname)){
		 mkdir($dirname);
	 }
	 
	$files = array_filter($_FILES['upload']['name']); 
	$total_count = count($_FILES['upload']['name']);
	
	$filter_upload = $_FILES['upload']['tmp_name'][0];// used to check if any file was uploaded
	
			if(is_uploaded_file($filter_upload)){
				
				for( $i=0 ; $i < $total_count ; $i++ ) {
				$file_num = $i+1;
				$file_no = "#".$file_num;
				// getting file size 
				$fsize = $_FILES['upload']['size'][$i];
				$final_size = x_getsize($fsize); // returns size in kb , mb
				$getlimit = 512000; // 5mb*2 limit
				// getting file extension
				$file_ext = explode(".",$_FILES['upload']['name'][$i]);
				$final_ext = end($file_ext);
				// Filter allowed extension
				$allowed_ext = "jpg,png,gif,jpeg";
				$allowed = explode(",",$allowed_ext);
				
				if(!in_array(strtolower($final_ext),$allowed)){
					
					$msg = "Invalid format (Allowed :: $allowed_ext) for #$i ";
					x_toasts($msg);
				
				}elseif($fsize > $getlimit){
					$limit = x_getsize($getlimit) ;
					$msg = "File upload must not exceed $limit for $file_no";
					x_toasts($msg);
				
				}else{
					
			   //The temp file path is obtained
			   
			   $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
			   
			   // checking for uploaded file
			   
			   if(!is_uploaded_file($tmpFilePath)){
				  
				   x_toasts("No file was uploaded for #$i");
			   }
			   if ($tmpFilePath != ""){
				   
				  $newFilePath = "$dirname/" . sha1(uniqid().DATE('YmdHis').$_FILES['upload']['name'][$i]. $userid).".".$final_ext;
				  
				  // File is uploaded to temp dir
				  
				  if(move_uploaded_file($tmpFilePath, $newFilePath)){
					  $ct[] = 1;
				  }else{  
					x_toasts("Failed to upload file #$i!");
					exit();
				  }
				  x_insert("post_id,file_path,file_type,file_size,status","filelogs","'$post_id','$newFilePath','$final_ext','$final_size','0'","&nbsp;","<script>showalert('Failed to insert data')</script>");
			   }
			}
			}
			
			$tl = count($ct);
			
			x_update("filelogs","post_id='$post_id'","status='1'","&nbsp;","<script>showalert('Failed to update filelogs data')</script>");
			
			x_update("quotes_request","ref='$post_id'","is_images='1',images_count='$tl'","&nbsp;","<script>showalert('Failed to update quotes data')</script>");
			
			}else{
				
			x_update("quotes_request","ref='$post_id'","is_images='0'","&nbsp;","<script>showalert('Failed to update data')</script>");
			
			}
?>