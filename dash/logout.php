<?php
session_start();
include("../xe-library/xe-library74.php");
if(isset($_SESSION["CARRIAGE_PAL_ID"])){
	unset($_SESSION["CARRIAGE_PAL_ID"]);
	unset($_SESSION["CARRIAGE_PAL_NAME"]);
	unset($_SESSION["CARRIAGE_PAL_EMAIL"]);
	unset($_SESSION["CARRIAGE_PAL_MOBILE"]);
	unset($_SESSION["CARRIAGE_PAL_TOKEN"]);
	finish("../","0");
}

?>