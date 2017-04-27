<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h4>
           <?php echo e(trans('admin.admin')); ?> <i class="fa fa-angle-right margin-separator"></i> <?php echo e(trans('misc.withdrawals')); ?> #<?php echo e($data->id); ?>

          </h4>
        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="row">
            <div class="col-xs-12">
              <div class="box">
              	
              	<div class="box-body">
              		<dl class="dl-horizontal">
					  
					  <!-- start -->
					  <dt>ID</dt>
					  <dd><?php echo e($data->id); ?></dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <dt><?php echo e(trans_choice('misc.campaigns_plural', 1)); ?></dt>
					  <dd><a href="<?php echo e(url('campaign',$data->campaigns()->id)); ?>" target="_blank"><?php echo e($data->campaigns()->title); ?> <i class="fa fa-external-link-square"></i></a></dd>
					  <!-- ./end -->
					
					<?php if( $data->gateway == 'Paypal' ): ?>  
					  <!-- start -->
					  <dt><?php echo e(trans('admin.paypal_account')); ?></dt>
					  <dd><?php echo e($data->account); ?></dd>
					  <!-- ./end -->
					  
					  <?php else: ?>
					   <!-- start -->
					  <dt><?php echo e(trans('misc.bank_details')); ?></dt>
					  <dd><?php echo App\Helper::checkText($data->account); ?></dd>
					  <!-- ./end -->
					  
					  <?php endif; ?>
					  
					  <!-- start -->
					  <dt><?php echo e(trans('admin.amount')); ?></dt>
					  <dd><strong class="text-success"><?php echo e($settings->currency_symbol.number_format( $data->amount  )); ?></strong></dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <dt><?php echo e(trans('misc.payment_gateway')); ?></dt>
					  <dd><?php echo e($data->gateway); ?></dd>
					  <!-- ./end -->

					  
					  <!-- start -->
					  <dt><?php echo e(trans('admin.date')); ?></dt>
					  <dd><?php echo e(date('d M, y', strtotime($data->date))); ?></dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <dt><?php echo e(trans('admin.status')); ?></dt>
					  <dd>
					  	<?php if( $data->status == 'paid' ): ?>
                      	<span class="label label-success"><?php echo e(trans('misc.paid')); ?></span>
                      	<?php else: ?>
                      	<span class="label label-warning"><?php echo e(trans('misc.pending_to_pay')); ?></span>
                      	<?php endif; ?>
					  </dd>
					  <!-- ./end -->
					
					<?php if( $data->status == 'paid' ): ?>  
					  <!-- start -->
					  <dt><?php echo e(trans('misc.date_paid')); ?></dt>
					  <dd>
					  	<?php echo e(date('d M, y', strtotime($data->date_paid))); ?>

					  </dd>
					  <!-- ./end -->
					  <?php endif; ?>
					  
					  
					  
					</dl>
              	</div><!-- box body -->
              	
              	<div class="box-footer">
                  	 <a href="<?php echo e(url('panel/admin/withdrawals')); ?>" class="btn btn-default"><?php echo e(trans('auth.back')); ?></a>
                 
                 <?php if( $data->gateway == 'Paypal' ): ?>	
                 
                 <?php
                 if ( $settings->paypal_sandbox == 'true') {
					// SandBox
					$action = "https://www.sandbox.paypal.com/cgi-bin/webscr";
					} else {
					// Real environment
					$action = "https://www.paypal.com/cgi-bin/webscr";
					}
					
                 ?>
                                  
                 <form name="_xclick" action="<?php echo e($action); ?>" method="post" class="displayInline">
				        <input type="hidden" name="cmd" value="_xclick">
				        <input type="hidden" name="return" value="<?php echo e(url('panel/admin/withdrawals')); ?>">
				        <input type="hidden" name="cancel_return"   value="<?php echo e(url('panel/admin/withdrawals')); ?>">
				        <input type="hidden" name="notify_url" value="<?php echo e(url('paypal/withdrawal/ipn')); ?>">
				        <input type="hidden" name="currency_code" value="<?php echo e($settings->currency_code); ?>">
				        <input type="hidden" name="amount" id="amount" value="<?php echo e($data->amount); ?>">
				        <input type="hidden" name="custom" value="<?php echo e($data->id); ?>">
				        <input type="hidden" name="item_name" value="<?php echo e(trans('misc.payment_campaigning').' '.$data->campaigns()->title); ?>">
				        <input type="hidden" name="business" value="<?php echo e($data->account); ?>">
				        <button type="submit" class="btn btn-default pull-right"><i class="fa fa-paypal"></i> <?php echo e(trans('misc.paid_paypal')); ?></button>
				        </form>
	        	
	        	<?php endif; ?>
	        	 
                  <?php if( $data->status == 'pending' ): ?>	 
                
                <?php echo Form::open([
			            'method' => 'POST',
			            'url' => "panel/admin/withdrawals/paid/$data->id",
			            'class' => 'displayInline'
				        ]); ?>

				        				        
	            	<?php echo Form::submit(trans('misc.mark_paid'), ['class' => 'btn btn-success pull-right myicon-right']); ?>

	        	<?php echo Form::close(); ?>

	        	
	        	<?php endif; ?>
                  	 
                  </div><!-- /.box-footer -->
              	
              </div><!-- box -->
            </div><!-- col -->
         </div><!-- row -->
        	
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>