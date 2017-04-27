<?php 
// ** Data User logged ** //
     $user = Auth::user();
	 $settings = App\Models\AdminSettings::first();	 	 	 
	  ?>


<?php $__env->startSection('title'); ?> <?php echo e(trans('misc.withdrawals')); ?> <?php echo e(trans('misc.configure')); ?> - <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site"><?php echo e(trans('misc.withdrawals')); ?> <?php echo e(trans('misc.configure')); ?> </h2>
      </div>
    </div>

<div class="container margin-bottom-40">
	
		<!-- Col MD -->
<div class="col-md-8 margin-bottom-20">
	
	<?php if(session('error')): ?>
			<div class="alert alert-danger btn-sm alert-fonts" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            		<?php echo e(session('error')); ?>

            		</div>
            	<?php endif; ?>
            	
            	<?php if(session('success')): ?>
			<div class="alert alert-success btn-sm alert-fonts" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            		<?php echo e(session('success')); ?>

            		</div>
            	<?php endif; ?>
            	
           <?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<h5><?php echo e(trans('misc.select_method_payment')); ?> - <strong><?php echo e(trans('misc.default_withdrawal')); ?></strong>: <?php if( Auth::user()->payment_gateway == '' ): ?> <?php echo e(trans('misc.unconfigured')); ?> <?php else: ?> <?php echo e(Auth::user()->payment_gateway); ?> <?php endif; ?></h5>

	<a class="btn btn-primary pp btn-block" role="button" data-toggle="collapse" href="#paypal" aria-expanded="false" aria-controls="paypal">
	  <i class="fa fa-paypal myicon-right"></i> Paypal
	</a>
	
	<!-- collapse -->
	<div class="collapse margin-top-15" id="paypal">
	<form method="post" action="<?php echo e(url('withdrawals/configure/paypal')); ?>">
		<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
	  <div class="form-group">
	    <input type="text" class="form-control" value="<?php echo e(Auth::user()->paypal_account); ?>" id="email_paypal" name="email_paypal" placeholder="Email Paypal">
	  </div>
	  
	  <div class="form-group">
	    <input type="text" class="form-control" name="email_paypal_confirmation" placeholder="<?php echo e(trans('misc.confirm_email')); ?>">
	  </div>
	  
	  <button type="submit" class="btn btn-success"><?php echo e(trans('misc.submit')); ?></button>
	</form>
	</div><!-- collapse -->

	<button class="btn btn-default bank margin-top-10 btn-block" type="button" data-toggle="collapse" data-target="#bank" aria-expanded="false" aria-controls="bank">
	  <i class="fa fa-university myicon-right"></i> <?php echo e(trans('misc.bank_transfer')); ?> 
	</button>

   

	<!-- collapse -->
	<div class="collapse margin-top-15" id="bank">
	<form method="post" action="<?php echo e(url('withdrawals/configure/bank')); ?>">
		<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
	  <div class="form-group">
	    <textarea class="form-control" rows="5" id="bank_form" name="bank" placeholder="<?php echo e(trans('misc.bank_details')); ?>"><?php echo e(Auth::user()->bank); ?></textarea>
	  </div>
	  <button type="submit" class="btn btn-success"><?php echo e(trans('misc.submit')); ?></button>
	</form>
	</div><!-- collapse -->
	  		 			
</div><!-- /COL MD -->
		
		<div class="col-md-4">
			<?php echo $__env->make('users.navbar-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		
 </div><!-- container -->
 
 <!-- container wrap-ui -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<script type="text/javascript">

	$(document).on('click','.pp',function(s){
		$('#bank').collapse('hide');
		$('#email_paypal').focus();
	});
	
	$(document).on('click','.bank',function(s){
		$('#paypal').collapse('hide');
		$('#bank_form').focus();
	});
	
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>