<?php 
// ** Data User logged ** //
     $user = Auth::user();
	  ?>


<?php $__env->startSection('title'); ?> <?php echo e(trans('auth.password')); ?> - <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site"><?php echo e(trans('auth.password')); ?></h2>
      </div>
    </div>

<div class="container margin-bottom-40">
	
		<!-- Col MD -->
		<div class="col-md-8 margin-bottom-20">
			<?php if(Session::has('notification')): ?>
			<div class="alert alert-success btn-sm alert-fonts" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            		<?php echo e(Session::get('notification')); ?>

            		</div>
            	<?php endif; ?>
            	
            	 <?php if(Session::has('incorrect_pass')): ?>
			<div class="alert alert-danger btn-sm alert-fonts" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            		<?php echo e(Session::get('incorrect_pass')); ?>

            		</div>
            	<?php endif; ?>
            	
			<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					
		<!-- ***** FORM ***** -->	
       <form action="<?php echo e(url('account/password')); ?>" method="post" name="form">
          		
          	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            
            <!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default"><?php echo e(trans('misc.old_password')); ?></label>
              <input type="password" class="form-control login-field custom-rounded" name="old_password" placeholder="<?php echo e(trans('misc.old_password')); ?>" title="<?php echo e(trans('misc.old_password')); ?>" autocomplete="off">
             </div><!-- ***** Form Group ***** -->
		
         
         <!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default"><?php echo e(trans('misc.new_password')); ?></label>
              <input type="password" class="form-control login-field custom-rounded" name="password" placeholder="<?php echo e(trans('misc.new_password')); ?>" title="<?php echo e(trans('misc.new_password')); ?>" autocomplete="off">
         </div><!-- ***** Form Group ***** -->

           
           <button type="submit" id="buttonSubmit" class="btn btn-block btn-lg btn-main custom-rounded"><?php echo e(trans('misc.save_changes')); ?></button>
       </form><!-- ***** END FORM ***** -->

		</div><!-- /COL MD -->
		
		<div class="col-md-4">
			<?php echo $__env->make('users.navbar-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		
 </div><!-- container -->
 
 <!-- container wrap-ui -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>