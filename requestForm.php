<?php
if(!isset($pageToken)){
	exit();
}
?>
<form action="" method="POST" class="mbr-form form-with-styler" data-form-title="Form Name">

<div class="dragArea row">
<div class="col-lg-12 col-md-12 col-sm-12">
<h4 class="mbr-fonts-style display-1">Request for Quotes</h4>
</div>
<div class="col-lg-12 col-md-12 col-sm-12">
<hr>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 form-group">
<label class="form-control-label mbr-fonts-style display-7">Name and Email:</label>
<div class="row">
<div class="col">
<input type="text" name="nameFirst" placeholder="First Name" data-form-field="nameFirst" class="form-control text-multiple" required="required" value="" id="nameFirst-formbuilder-f">
</div>
<div class="col">
<input type="text" name="nameLast" placeholder="Last Name" data-form-field="nameLast" class="form-control text-multiple" required="required" value="" id="nameLast-formbuilder-f">
</div>
</div>
</div>
<div data-for="email" class="col-lg-12 col-md-12 col-sm-12 form-group">
<input type="email" name="email" placeholder="Email" data-form-field="email" required="required" class="form-control display-7" value="" id="email-formbuilder-f">
</div>
<div data-for="radio" class="col-lg-12 col-md-12 col-sm-12 form-group" style="">
<div class="form-control-label">
</div>
<div class="form-check form-check-inline ms-2">
<input type="radio" name="radio" data-form-field="radio" class="form-check-input display-7" value="Air shipping" checked="" id="radio-formbuilder-f">
<label class="form-check-label display-7">Air shipping</label>
</div>
<div class="form-check form-check-inline ms-2">
<input type="radio" name="radio" data-form-field="radio" class="form-check-input display-7" value="Sea Shipping" id="radio-formbuilder-f">
<label class="form-check-label display-7">Sea Shipping</label>
</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="number" style="">
<label for="number-formbuilder-f" class="form-control-label mbr-fonts-style display-7">Item Weight</label>
<input type="number" name="number" placeholder="Weight in pound (LB)" max="100" min="0" step="1" data-form-field="number" class="form-control display-7" value="" id="number-formbuilder-f">
</div>
<div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="select">
<select name="select" data-form-field="select" class="form-control form-select display-7" id="select-formbuilder-f">
<option value="Order Type">Order Type</option>
<option value="Bulk Order">Bulk Order</option>
<option value="Single Order">Single Order</option>
</select>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="date">
<label for="date-formbuilder-f" class="form-control-label mbr-fonts-style display-7">Preferred Shipping Date:</label>
<input type="date" name="date" data-form-field="date" required="required" class="form-control display-7" value="2018-07-22" id="date-formbuilder-f">
</div>
<div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="message">
<label for="message-formbuilder-f" class="form-control-label mbr-fonts-style display-7">Service in Details</label>
<textarea name="message" placeholder="Explain in details the service needed" data-form-field="message" required="required" class="form-control display-7" id="message-formbuilder-f"></textarea>
</div>
<div class="col-auto">
<button type="submit" class="w-100 w-100 w-100 w-100 w-100 btn btn-primary display-7">Submit</button>
</div>
</div>
</form>