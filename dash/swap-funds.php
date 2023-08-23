  <div class="swap-funds">
  
	<div class="container-fluid">
		
		<div class="row mt-0">
		<div class="col-12 col-md-12 col-lg-12">
			  <span class="pull-right"><i class="fa fa-close fa-2x swap-close"></i></span></div>
		</div>
		
		<div class="row mt-2">
			  
			  <div class="col-12 col-md-4 col-lg-4"></div>
			  <div class="col-12 col-md-4 col-lg-4">
			  <h4 class="mb-2">FUNDS SWAPING</h4>
				<form autocomplete="off" id="funds-mover">
					<select name="option" class="form-control input-lg">
						<option value="n2d">Swap Naira to Dollar</option>
						<option value="d2n">Swap Dollar to Naira</option>
					</select>
					<input type="text" class="form-control input-lg mt-2" placeholder="Amount to swap" min="" max="" name="amount" />
					<input type="hidden" name="_token" value="<?php echo $pageToken;?>" />
					<input type="submit" class="btn btn-info input-lg mt-2" value="Swap"/>
					
				</form>
				<div class="swap-result mt-1"></div>
				
			  </div>
			   <div class="col-12 col-md-4 col-lg-4"></div>
			  
		</div>
		
	</div>
		
  </div>