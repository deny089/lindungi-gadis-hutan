

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('public/plugins/iCheck/all.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            <?php echo e(trans('admin.admin')); ?> 
            	<i class="fa fa-angle-right margin-separator"></i> 
            		<?php echo e(trans('misc.payment_settings')); ?>

            		
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">
        	
        	 <?php if(Session::has('success_message')): ?>
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
		       <i class="fa fa-check margin-separator"></i> <?php echo e(Session::get('success_message')); ?>	        
		    </div>
		<?php endif; ?>

        	<div class="content">
        		
        		<div class="row">
    
        	<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo e(trans('misc.payment_settings')); ?></h3>
                </div><!-- /.box-header -->
               
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="<?php echo e(url('panel/admin/payments')); ?>" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">	
			
					<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					
									
                      <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.currency_code')); ?></label>
                      <div class="col-sm-10">
                      	<select name="currency_code" class="form-control">
						<!-- edited cacip -->
                      		<option <?php if( $settings->currency_code == 'RP' ): ?> selected="selected" <?php endif; ?> value="RP">RP</option>
						<!-- end edited cacip -->
                      		<option <?php if( $settings->currency_code == 'USD' ): ?> selected="selected" <?php endif; ?> value="USD">USD</option>
						  	<option <?php if( $settings->currency_code == 'EUR' ): ?> selected="selected" <?php endif; ?>  value="EUR">EUR</option>
						  	<option <?php if( $settings->currency_code == 'GBP' ): ?> selected="selected" <?php endif; ?> value="GBP">GBP</option>
						  	<option <?php if( $settings->currency_code == 'AUD' ): ?> selected="selected" <?php endif; ?> value="AUD">AUD</option>
						  	<option <?php if( $settings->currency_code == 'JPY' ): ?> selected="selected" <?php endif; ?> value="JPY">JPY</option>
						  	
						  	<option <?php if( $settings->currency_code == 'BRL' ): ?> selected="selected" <?php endif; ?> value="BRL">BRL</option>
						  	<option <?php if( $settings->currency_code == 'MXN' ): ?> selected="selected" <?php endif; ?>  value="MXN">MXN</option>
						  	<option <?php if( $settings->currency_code == 'SEK' ): ?> selected="selected" <?php endif; ?> value="SEK">SEK</option>
						  	<option <?php if( $settings->currency_code == 'CHF' ): ?> selected="selected" <?php endif; ?> value="CHF">CHF</option>
						  	
						  	
						  	
						  	<option <?php if( $settings->currency_code == 'SGD' ): ?> selected="selected" <?php endif; ?> value="SGD">SGD</option>
						  	<option <?php if( $settings->currency_code == 'DKK' ): ?> selected="selected" <?php endif; ?> value="DKK">DKK</option>
						  	<option <?php if( $settings->currency_code == 'RUB' ): ?> selected="selected" <?php endif; ?> value="RUB">RUB</option>
                          </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                    
					<!-- edited cacip -->
					<!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Kode Pohon</label>
                      <div class="col-sm-10">
                         <input type="text" value="<?php echo e($settings->kode_pohon); ?>" name="kode_pohon" class="form-control" placeholder="Kode yang digunakan untuk pohon">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
				  <!-- end edited cacip -->
				  
                   <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('misc.fee_donation')); ?></label>
                      <div class="col-sm-10">
                      	<select name="fee_donation" class="form-control">
                      		<option <?php if( $settings->fee_donation == '1' ): ?> selected="selected" <?php endif; ?> value="1">1%</option>
                      		<option <?php if( $settings->fee_donation == '2' ): ?> selected="selected" <?php endif; ?> value="2">2%</option>
						  	<option <?php if( $settings->fee_donation == '3' ): ?> selected="selected" <?php endif; ?>  value="3">3%</option>
						  	<option <?php if( $settings->fee_donation == '4' ): ?> selected="selected" <?php endif; ?> value="4">4%</option>
						  	<option <?php if( $settings->fee_donation == '5' ): ?> selected="selected" <?php endif; ?> value="5">5%</option>
						  	
						  	<option <?php if( $settings->fee_donation == '6' ): ?> selected="selected" <?php endif; ?> value="6">6%</option>
						  	<option <?php if( $settings->fee_donation == '7' ): ?> selected="selected" <?php endif; ?> value="7">7%</option>
						  	<option <?php if( $settings->fee_donation == '8' ): ?> selected="selected" <?php endif; ?> value="8">8%</option>
						  	<option <?php if( $settings->fee_donation == '9' ): ?> selected="selected" <?php endif; ?> value="9">9%</option>
						  	
						  	<option <?php if( $settings->fee_donation == '10' ): ?> selected="selected" <?php endif; ?> value="10">10%</option>
						  	<option <?php if( $settings->fee_donation == '10' ): ?> selected="selected" <?php endif; ?> value="15">15%</option>
                          </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('misc.payment_gateway')); ?></label>
                      <div class="col-sm-10">
                      	<select name="payment_gateway" class="form-control">
                      		<option <?php if( $settings->payment_gateway == 'Paypal' ): ?> selected="selected" <?php endif; ?> value="Paypal">Paypal</option>
                      		<option <?php if( $settings->payment_gateway == 'Stripe' ): ?> selected="selected" <?php endif; ?> value="Stripe">Stripe</option>
                          </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                            
                     <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.paypal_account')); ?></label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->paypal_account); ?>" name="paypal_account" class="form-control" placeholder="<?php echo e(trans('admin.paypal_account')); ?>">
                      	<p class="help-block"><?php echo e(trans('admin.paypal_account_donations')); ?></p>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Paypal Sandbox</label>
                      <div class="col-sm-10">
                      	
                      	<div class="radio">
                        <label class="padding-zero">
                          <input type="radio" name="paypal_sandbox" <?php if( $settings->paypal_sandbox == 'true' ): ?> checked="checked" <?php endif; ?> value="true" checked>
                          On
                        </label>
                      </div>
                      
                      <div class="radio">
                        <label class="padding-zero">
                          <input type="radio" name="paypal_sandbox" <?php if( $settings->paypal_sandbox == 'false' ): ?> checked="checked" <?php endif; ?> value="false">
                          Off
                        </label>
                      </div>
                      
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                                   

           <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Stripe</h3>
                </div><!-- /.box-header -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Stripe Secret Key</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->stripe_secret_key); ?>" name="stripe_secret_key" class="form-control">
                      	<p class="help-block"><a href="https://stripe.com/dashboard" target="_blank">https://stripe.com/dashboard</a></p>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Stripe Publishable Key</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->stripe_public_key); ?>" name="stripe_public_key" class="form-control">
                      	<p class="help-block"><a href="https://stripe.com/dashboard" target="_blank">https://stripe.com/dashboard</a></p>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success"><?php echo e(trans('admin.save')); ?></button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
        			        		
        		</div><!-- /.row -->
        		
        	</div><!-- /.content -->
        	
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	
	<!-- icheck -->
	<script src="<?php echo e(asset('public/plugins/iCheck/icheck.min.js')); ?>" type="text/javascript"></script>
	
	<script type="text/javascript">
		//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });
        
	</script>
	

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>