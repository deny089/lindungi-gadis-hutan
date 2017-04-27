<?php 
// ** Data User logged ** //
     $user = Auth::user();
	 $settings = App\Models\AdminSettings::first();
	 $data = App\Models\Campaigns::where('user_id',Auth::user()->id)
	 ->orderBy('id','DESC')
	 ->paginate(20);
	 	 	 
	  ?>


<?php $__env->startSection('title'); ?> <?php echo e(trans('misc.campaigns')); ?> - <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site"><?php echo e(trans('misc.campaigns')); ?></h2>
      </div>
    </div>

<div class="container margin-bottom-40">
	
		<!-- Col MD -->
		<div class="col-md-8 margin-bottom-20">
			
			<?php if(session('notification')): ?>
			<div class="alert alert-warning btn-sm alert-fonts" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            		<?php echo e(session('notification')); ?> <a href="<?php echo e(url('account/withdrawals/configure')); ?>"><?php echo e(trans('misc.configure')); ?> <i class="fa fa-long-arrow-right"></i></a>
            		</div>
            	<?php endif; ?>

<?php if(  $settings->payment_gateway == 'Paypal' && $data->total() !=  0 && $data->count() != 0 ): ?>
<h6>* <?php echo e(trans('misc.fund_detail_alert')); ?> <?php echo e($settings->fee_donation); ?>% + (PayPal 5.4% + 0.3) = 10.4% + 0.3</h6>
<?php endif; ?>

<?php if(  $settings->payment_gateway == 'Stripe' && $data->total() !=  0 && $data->count() != 0 ): ?>
<h6>* <?php echo e(trans('misc.fund_detail_alert')); ?> <?php echo e($settings->fee_donation); ?>% + (Stripe 2.9% + 0.3) = 7.9% + 0.3</h6>
<?php endif; ?>

<div class="table-responsive">
   <table class="table table-striped"> 
   	
   	<?php if( $data->total() !=  0 && $data->count() != 0 ): ?>
   	<thead> 
   		<tr>
   		 <th class="active">ID</th>
   		  <th class="active"><?php echo e(trans('misc.title')); ?></th>
          <th class="active"><?php echo e(trans('misc.goal')); ?></th>
          <th class="active"><?php echo e(trans('misc.funds_raised')); ?></th>
          <th class="active"><?php echo e(trans('admin.status')); ?></th>
          <th class="active"><?php echo e(trans('admin.date')); ?></th>
          <th class="active"><?php echo e(trans('admin.actions')); ?></th> 
          </tr>
   		  </thead> 
   		  
   		  <tbody> 

   		      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
   		      
   <?php
   		      
      $amount = $campaign->donations()->sum('donation');
	
	if(  $settings->payment_gateway == 'Paypal' ) {
		$fee       = 5.4;
	}  elseif(  $settings->payment_gateway == 'Stripe' ) {
		$fee       = 2.9;
	}
	  
	  
	  $_funds  = $amount - (  $amount * $fee/100 - .3 ); // Fee Paypal
	  $funds    = $_funds - (  $_funds * $settings->fee_donation/100  ); // Fee Site
	    		      
   	?>
   		      
                    <tr>
                      <td><?php echo e($campaign->id); ?></td>
                      <td><img src="<?php echo e(asset('public/campaigns/small').'/'.$campaign->small_image); ?>" width="20" /> 
                      	<a title="<?php echo e($campaign->title); ?>" href="<?php echo e(url('campaign',$campaign->id)); ?>" target="_blank"><?php echo e(str_limit($campaign->title,20,'...')); ?> <i class="fa fa-external-link-square"></i></a>
                      	</td>
                      <td><?php echo e($settings->currency_symbol.number_format($campaign->goal)); ?></td>
                      <td><?php echo e($settings->currency_symbol.number_format( $funds  )); ?></td>
                      <td>
                      	<?php if( $campaign->finalized == 0 ): ?>
                      	<span class="label label-success"><?php echo e(trans('misc.active')); ?></span>
                      	<?php else: ?>
                      	<span class="label label-default"><?php echo e(trans('misc.finalized')); ?></span>
                      	<?php endif; ?>
                      </td>
                      <td><?php echo e(date('d M, y', strtotime($campaign->date))); ?></td>
                      <td> 
                     
                     <?php if( $campaign->finalized == 0 ): ?>
                      	<a href="<?php echo e(url('edit/campaign',$campaign->id)); ?>" class="btn btn-success btn-xs">
                      		<?php echo e(trans('admin.edit')); ?>

                      	</a> 
                      	<?php else: ?>
                      	
                      	<?php if( isset( $campaign->withdrawals()->id ) && $campaign->withdrawals()->status == 'pending'  ): ?>
                      		<span class="label label-warning"><?php echo e(trans('misc.pending_to_pay')); ?></span>
                      		
                      		<?php elseif( isset( $campaign->withdrawals()->id ) && $campaign->withdrawals()->status == 'paid'  ): ?>
                      		
                      		<span class="label label-success"><?php echo e(trans('misc.paid')); ?></span>
                      		
                      		<?php else: ?>
                     
                     <?php if( number_format($funds) != 0 ): ?>
                     
                     <?php echo Form::open([
			            'method' => 'POST',
			            'url' => "campaign/withdrawal/$campaign->id",
			            'class' => 'displayInline'
				        ]); ?>

				        				        
	            	<?php echo Form::submit(trans('misc.make_withdrawal'), ['class' => 'btn btn-success btn-xs padding-btn']); ?>

	        	<?php echo Form::close(); ?>


                      	<?php else: ?>
                      	<?php echo e(trans('misc.finalized')); ?>

                      	<?php endif; ?>
                      		
                      	<?php endif; ?>
                      	                      	
                      	<?php endif; ?>
                      	
                      	</td>
                    </tr><!-- /.TR -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    
                    <?php else: ?>
                    <hr />
                    	<h3 class="text-center no-found"><?php echo e(trans('misc.no_results_found')); ?></h3>

                    <?php endif; ?>   		  		 		
   		  		 		</tbody> 
   		  		 		</table>
   		  		 		</div>
   		  		 	
   		  		 	<?php if( $data->lastPage() > 1 ): ?>	
   		  		 		<?php echo e($data->links()); ?>

   		  		 		<?php endif; ?>
   		  		 		
		</div><!-- /COL MD -->
		
		<div class="col-md-4">
			<?php echo $__env->make('users.navbar-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		
 </div><!-- container -->
 
 <!-- container wrap-ui -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>