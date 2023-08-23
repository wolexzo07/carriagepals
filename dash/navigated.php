  <nav style="z-index:10;" class="navbar">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
         <i class="fa fa-align-center"></i>
        </button>
        <a class="navbar-brand f-bold" href="#">CARRIAGE-PALS</a>
      </div>
	  
      <div id="navbar" class="navbar-collapse collapse">
	  
	  <div class="img-control"></div>
	  
	  <button class="btn btn-default m-1" title="">
	  <?php echo "Hi, <b>".substr($_SESSION["CARRIAGE_PAL_NAME"],0,30);?></b></button>
	  
	  
        <ul class="nav navbar-nav">
          <li><a href="#" onclick="pageLoader('homedash?token=<?php echo $pageToken;?>','.PageFetcher')">Dashboard</a></li>
		  <?php
		  if(x_count("manageaccount","id='$currentuser' AND is_big='1'") > 0){
			 ?>
		   <li><a href="#" onclick="pageLoader('ad_Registeredusers?token=<?php echo $pageToken;?>','.PageFetcher')">Registered users</a></li>
           <li><a href="#" onclick="pageLoader('manageRequest?token=<?php echo $pageToken;?>','.PageFetcher')">Funds TopUp</a></li>
           <li><a href="#" onclick="pageLoader('manageRequest?token=<?php echo $pageToken;?>','.PageFetcher')">Swap History</a></li>
           <li><a href="#" onclick="pageLoader('manageRequest?token=<?php echo $pageToken;?>','.PageFetcher')">Manage Request</a></li>
			 <?php 
		  }else{
			 ?>
		  <li><a href="#" onclick="pageLoader('requestQuotes?token=<?php echo $pageToken;?>','.PageFetcher')">Request Quotes</a></li>
          <li><a href="#" onclick="pageLoader('manageRequest?token=<?php echo $pageToken;?>','.PageFetcher')">Manage Request</a></li>
			 <?php 
		  }
		  ?>
          
          <li><a href="#" onclick="pageLoader('settings?token=<?php echo $pageToken;?>','.PageFetcher')">Settings</a></li>
          <li><a href="logout?token=<?php echo $pageToken;?>">Logout</a></li>
        </ul>
		
      </div>
    </div>
  </nav>
  
  <style>
  .img-responsive{
	  border-radius:20px;
  }
  nav{
	  background:Tomato;
	  color:white;
	}
  a{
	  color:white;
  }
  .img-control{
	  height:180px;
	  overflow:hidden;
	  width:85%;
	  padding-left:20px;
  }
  </style>