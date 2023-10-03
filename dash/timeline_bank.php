
        <div class="timeline">
          <div class="timeline__wrap">
            <div class="timeline__items">
              <div class="timeline__item">
                <div class="timeline__content">
                  <h2>Payment status</h2>
                  <p>
				  
				  <?php
				  if($is_paid == 1){
					  ?>
					  Payment was made on <b><?php echo $paid_on;?></b>.
					  <?php
				  }else{
					   ?>
					  No payment was record.
					  <?php
				  }
				  ?>
				  
				  </p>
                </div>
              </div>
              <div class="timeline__item">
                <div class="timeline__content">
                  <h2>Processing Status</h2>
                  <p>
					  <?php
					  
					  if($is_paid == 1 && $pro_status == 1){
						  ?>
						 Package processing was initialized on <b><?php echo $processed_on;?></b>.
						  <?php
					  }else{
						   ?>
						 Package processing still on <b>Hold</b>.
						  <?php
					  }
					  ?>
				  
				  </p>
                </div>
              </div>
              <div class="timeline__item">
                <div class="timeline__content">
                  <h2>Shipping Status</h2>
                  <p>
					<?php
					  
					  if($is_paid == 1 && $shipping_status == 1){
						  ?>
						 Package was shipped on <b><?php echo $shipped_on;?></b>.
						  <?php
					  }else{
						   ?>
						 Package awaits <b>Shipment</b>.
						  <?php
					  }
					  ?>
				  </p>
                </div>
              </div>
              <div class="timeline__item">
                <div class="timeline__content">
                  <h2>Delivery Status</h2>
                  <p>
				  <?php
					  
					  if($is_paid == 1 && $delivery_status == 1){
						  ?>
						 Package was delivered on <b><?php echo $delivered_on;?></b>.
						  <?php
					  }else{
						   ?>
						 Package awaits <b>Delivery.</b>
						  <?php
					  }
					  ?>
				  </p>
                </div>
              </div>
			
			</div>
          </div>
        </div>
		
	