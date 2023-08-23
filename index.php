<?php
session_start();
include("xe-library/xe-library74.php");
include("siteinfo.php");
$pageToken = sha1(uniqid()).md5(DATE("YmdHis"));

//page session token
if(x_validatesession("XCAPE_HACKS")){}else{
		$_SESSION["XCAPE_HACKS"] = $pageToken ;
		}
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $sitename;?> - <?php echo $sitetitle;?></title>
  <?php include("headPage.php");?>
</head>
<body>
<?php include("navbar.php");?>
<?php include("memberPanel.php");?>

<section data-bs-version="5.1" class="header1 cid-tFVTitvX2p mbr-fullscreen mbr-parallax-background" id="header1-1">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(35, 35, 35);"></div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-7">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2"><strong>Transforming Shipping and Logistics for the Modern Era</strong></h1>
                
                <p class="mbr-text mbr-fonts-style display-7"><strong>
                    Efficient logistics solutions for seamless shipping. Simplify your supply chain, enhance tracking capabilities, and optimize operations with our innovative platform. Streamline processes, reduce costs, and stay ahead in the competitive market.</strong></p>
                <div class="mbr-section-btn mt-3"><a class="btn btn-warning display-4" href="#">GET STARTED</a></div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="features3 cid-tFW2UeipYo" id="features3-a">
<?php include("services.php");?>
</section>

<section data-bs-version="5.1" class="form1 cid-tGRki6oRxj mbr-parallax-background" id="form1-g">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(0, 0, 0);"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
<!--Formbuilder Form-->
<form action="https://mobirise.eu/" method="POST" class="mbr-form form-with-styler" data-form-title="Form Name"><input type="hidden" name="email" data-form-email="true" value="bz99TaD/LUgEyssZuxxa+FsDfXEAaqPASYVqCJjO2mEOt1Zkd9PXrBBVKOWu3Ujp/MT0PJKKufNjQiOfRiPjJ+aAr7YZM8saaBlOVEyHC0v+D/9wupQD57MZDdl3th11">
<div class="row">
<div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Thanks for filling out the form!</div>
<div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12"> Oops...! some problem! </div>
</div>
<div class="dragArea row">
<div class="col-12">
<h1 class="mbr-section-title mb-4 mbr-fonts-style align-center display-2"> Package Tracking</h1>
</div>
<div class="col-12">

</div>
<div data-for="name" class="col-md col-12 form-group mb-3">
<input type="text" name="name" placeholder="TRACKING ID" data-form-field="Name" class="form-control display-7" required="required" value="" id="name-form1-g">
</div>
<div class="col-12 col-md-auto mbr-section-btn"><button type="submit" class="w-100 w-100 btn btn-warning display-4">&nbsp;TRACK PACKAGE</button></div>
</div>
</form><!--Formbuilder Form-->
</div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="features12 cid-tFW2QKdvmu" id="features13-9">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="card-wrapper">
                    <div class="card-box align-left">
                        <h4 class="card-title mbr-fonts-style mb-4 display-2">
                            <strong>Why choose US?</strong>
                        </h4>
                        <p class="mbr-text mbr-fonts-style mb-4 display-7">
                            Your trusted choice for an excellent services, providing a "Reliable and Secure" with "Exceptional Support" to brighten your growth as a Business and Individual&nbsp; &nbsp; &nbsp; .</p>
                        <div class="mbr-section-btn"><a class="btn btn-warning display-4" href="#">learn more</a></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="mbr-iconfont mobi-mbri-globe-2 mobi-mbri"></span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title mbr-black mbr-fonts-style display-7">
                            <strong>Reliable and Secure</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Experience Unwavering Reliability and Uncompromising Security: Your Safeguarded Journey Starts Here.</h5>
                    </div>
                </div>
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="mbr-iconfont mobi-mbri-update mobi-mbri"></span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title mbr-black mbr-fonts-style display-7">
                            <strong>Cost Effective</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Discover the transformative potential of cost-effectiveness and unlock remarkable savings that fuel the growth and unparalleled value for your Business.</h5>
                    </div>
                </div>
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="mbr-iconfont mobi-mbri-user-2 mobi-mbri"></span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title mbr-black mbr-fonts-style display-7">
                            <strong>Exceptional Support</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Exceptional services mean we don't settle for mediocrity. We strive for excellence in every aspect of our operations, from prompt and efficient communication to meticulous attention to detail in every of our services.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="form cid-tGRc9bxzVr" id="formbuilder-f">
    
    <div class="mbr-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
				<?php include("requestForm.php");?>
			</div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="contacts2 cid-tGRal10L21" id="contacts2-d">
    <!---->
    

    
    
    <div class="container">
        
        <div class="row justify-content-center mt-4">
            <div class="card col-12 col-md-6">
                <div class="card-wrapper">
                    <div class="image-wrapper">
                        <span class="mbr-iconfont mobi-mbri-phone mobi-mbri"></span>
                    </div>
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style mb-1 display-5">
                            <strong>Phone</strong>
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            <a href="tel:+12345678910" class="text-primary">+44 7425 502646</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-6">
                <div class="card-wrapper">
                    <div class="image-wrapper">
                        <span class="mbr-iconfont mobi-mbri-letter mobi-mbri"></span>
                    </div>
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style mb-1 display-5">
                            <strong>Email</strong>
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            <a href="mailto:info@site.com" class="text-primary">hello@cariagepals.com</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-6">
                <div class="card-wrapper">
                    <div class="image-wrapper">
                        <span class="mbr-iconfont mobi-mbri-globe mobi-mbri"></span>
                    </div>
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style mb-1 display-5">
                            <strong>Address</strong>
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">81 Tudor Rd, Leicester LE3 5JG, United Kingdom&nbsp;<br></p>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-6">
                <div class="card-wrapper">
                    <div class="image-wrapper">
                        <span class="mbr-iconfont mobi-mbri-bulleted-list mobi-mbri"></span>
                    </div>
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style mb-1 display-5">
                            <strong>Working Hours</strong>
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            9:00 - 18:00
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="map2 cid-tGR9Z6kawb" id="map2-c">

    <div>
        <div class="google-map"><iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCt1265A4qvZy9HKUeA8J15AOC4SrCyZe4&amp;q=81 Tudor Road, Leicester, United Kingdom" allowfullscreen=""></iframe></div>
    </div>
</section>

<section data-bs-version="5.1" class="clients1 cid-tFVXFWWWYi" id="clients1-3">
    
    <div class="images-container container">
        <div class="mbr-section-head">

        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-3 card">
                <img src="assets/images/jone-240x20.png" alt="SHIPPING_LOGISTICS">
            </div>

        </div>
    </div>
</section>

<section data-bs-version="5.1" class="footer4 cid-tFVY1ecW9f" once="footers" id="footer4-6">
    
    <div class="container">
        <div class="row mbr-white">
            <div class="col-6 col-lg-3">
                <div class="media-wrap col-md-8 col-12">
                    
                        <img src="assets/images/btmimage.png" alt="Logo">
                    
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <h5 class="mbr-section-subtitle mbr-fonts-style mb-2 display-7">
                    <strong>About</strong>
                </h5>
                <p class="mbr-text mbr-fonts-style mb-4 display-4">
                    Efficient logistics solutions for seamless shipping. Simplify your supply chain, enhance tracking capabilities, and optimize operations with our innovative platform. Streamline processes, reduce costs, and stay ahead in the competitive market.</p>
                <h5 class="mbr-section-subtitle mbr-fonts-style mb-3 display-7">
                    <strong>Follow Us</strong>
                </h5>
                <div class="social-row display-7">
                    <div class="soc-item">
                        <a href="https://twitter.com/mobirise" target="_blank">
                            <span class="mbr-iconfont socicon socicon-facebook"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://twitter.com/mobirise" target="_blank">
                            <span class="mbr-iconfont socicon socicon-twitter"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://twitter.com/mobirise" target="_blank">
                            <span class="mbr-iconfont socicon socicon-instagram"></span>
                        </a>
                    </div>
                    
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <h5 class="mbr-section-subtitle mbr-fonts-style mb-2 display-7">
                    <strong>Site Info</strong></h5>
                <ul class="list mbr-fonts-style display-4">
                    <li class="mbr-text item-wrap">About us</li>
                    <li class="mbr-text item-wrap">Terms of use</li>
                    <li class="mbr-text item-wrap">Privacy Policy</li>
                    <li class="mbr-text item-wrap">Refund Policy</li>
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <h5 class="mbr-section-subtitle mbr-fonts-style mb-2 display-7">
                    <strong>Quick Links</strong></h5>
                <ul class="list mbr-fonts-style display-4">
                    <li class="mbr-text item-wrap">FAQ</li>
                    <li class="mbr-text item-wrap">Contact us</li>
                    <li class="mbr-text item-wrap">Send Quotes</li>
                    <li class="mbr-text item-wrap">Services</li>
                </ul>
            </div>
            
        </div>
    </div>
</section>

<?php //echo $chat;?>
<?php include("footerPager.php");?>
  
</body>
</html>
