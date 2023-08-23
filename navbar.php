<?php include("validatePage.php");?> 
 <section data-bs-version="5.1" class="menu menu2 cid-tFVTb4vmvR" once="menu" id="menu2-0">
    
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container">
            <div class="navbar-brand">
                <span class="navbar-logo">
					   <?php
						if($is_mobile){
							?>
						<img src="assets/images/roundlogo.png" alt="Logo" style="height:3rem;"/>
							<?php
						}
						?>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-7" href="#"><?php
				if($is_desktop){
					?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
				}
				?>CarriagePals</a></span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item"><a class="nav-link link text-black display-4" href="#">
                            About us</a></li><li class="nav-item"><a class="nav-link link text-black display-4" href="#">Request Quotes</a></li><li class="nav-item"><a class="nav-link link text-black display-4" href="#">Track &amp; Trace</a></li></ul>
                
                <div class="navbar-buttons mbr-section-btn"><a class="btn btn-primary-outline display-4" id="showMemberPanel" href="#">LOGIN / SIGN UP</a></div>
            </div>
        </div>
    </nav>
	<?php
	if($is_desktop){
		?>
		<div class="hbox">
			<img src="assets/images/roundlogo.png" alt="Logo" class="hlogo" />
		</div>
		<style>
			.hbox{
				width:130px;
				height:130px;
				background:white;
				padding:0px;
				border-radius:500px;
				z-index:2000;
				position: fixed;
			}
			.hlogo{
				width:100px;
				height:100px;
				display:block;
				margin-left:10pt;
				margin-top:10px;
				border-radius:30px;
			}
		</style>
		<?php
	}
	?>
	
	
</section>




