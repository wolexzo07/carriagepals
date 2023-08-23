<?php
if(!isset($pageToken)){
	exit();
}
?>

<form id="request-quotes" enctype="multipart/form-data" autocomplete="off">
	<p class="text-rq f-bold">Title:</p>
	<input type="text" required="" class="form-control " placeholder="Specify Request Title" maxlength="70" name="title"/>
	<p class="text-rq f-bold mt-2">Shipping Type:</p>
	<div class="row">
		<div class="col-12 col-lg-3 col-md-3  mt-1">
			<input type="radio" class="" name="shtype" value="air"/>&nbsp;&nbsp; Air Shipping
		</div>
		
		<div class="col-12 col-lg-3 col-md-3  mt-1">
			<input type="radio" class="" name="shtype" value="sea"/>&nbsp;&nbsp; Sea Shipping
		</div>
		
		<div class="col-12 col-lg-3 col-md-3  mt-1">
			<input type="radio" class="" name="shtype" value="road"/>&nbsp;&nbsp; Road Shipping
		</div>
		<div class="col-12 col-lg-3 col-md-3  mt-1"></div>
	</div>

    <p class="text-rq  mt-2 f-bold">Item Weight:</p>
	<div class="row">
		<div class="col-12 col-lg-6 col-md-6  mt-1">
		<select required="required" name="item-weight-type" class="form-control ">
			<option value="">Unit of measurement</option>
			<option value="lb">Weight in Pounds(LB)</option>
			<option value="dimen">Dimensions(Lenght x Breadth x height) in centimeters</option>
			<option value="other">Other units (specify)</option>
		</select>
		</div>
		<div class="col-12 col-lg-6 col-md-6  mt-1">
			<input type="text" required="" class="form-control " name="item-weight" placeholder="Weight in pound (LB)"/>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12 col-lg-6 col-md-6  mt-1">
			<p class="text-rq  mt-1 mb-1 f-bold">Order Type:</p>
			<select required="required" name="order-type" class="form-control ">
				<option value="single">Single Order</option>
				<option value="bulk">Bulky Order</option>
			</select>
		</div>
		<div class="col-12 col-lg-6 col-md-6  mt-1">
			<p class="text-rq  mt-1 mb-1 f-bold">Preferred Shipping Date:</p>
			<input type="date" name="date" required="required" class="form-control ">
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-12 col-lg-6 col-md-6  mt-1">
			<p class="text-rq  mt-2 mb-1 f-bold">Service in Details:</p>
			<textarea name="message" placeholder="Explain in details the service needed" required="required" class="form-control " ></textarea>
		</div>
		<div class="col-12 col-lg-6 col-md-6  mt-1">
		<p class="text-rq  mt-2 mb-1 f-bold">Attach photos (optional  || Max : 500kb) :</p>
		<input type="file" multiple="" style="padding-top:20px;padding-bottom:50px;" class="form-control" name="upload[]"/>
		</div>
	</div>

	
	<input type="hidden" name="_token" value="<?php echo $pageToken;?>"/>
	
	<button class="btn btn-success mt-2" type="submit"><i class="fa fa-send"></i> &nbsp;&nbsp;Send request</button>
	
</form>

<div class="request_id"></div>