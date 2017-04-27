<?php $settings = App\Models\AdminSettings::first(); ?>


<?php $__env->startSection('title'); ?>
<?php echo e(trans('auth.login')); ?> -
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('public/plugins/iCheck/all.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site"><?php echo e(trans('auth.login')); ?></h1>
        <p class="subtitle-site"><strong><?php echo e($settings->title); ?></strong></p>
      </div>
    </div>

<div class="container margin-bottom-40">
	
	<div class="row">
<!-- Col MD -->
<div class="col-md-12">	
	
	<h2 class="text-center line position-relative"><?php echo e(trans('misc.welcome_back')); ?></h2>
	
	<div class="login-form">
		
		<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					
					<?php if(session('login_required')): ?>
			<div class="alert alert-danger" id="dangerAlert">
            		<i class="glyphicon glyphicon-alert myicon-right"></i> <?php echo e(session('login_required')); ?>

            		</div>
            	<?php endif; ?>
	            	
          	<form action="<?php echo e(url('login')); ?>" method="post" name="form" id="signup_form">
          		
          		<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            
            <div class="form-group has-feedback">
            	
              <input type="text" class="form-control login-field custom-rounded" value="<?php echo e(old('email')); ?>" name="email" id="username_or_email" placeholder="<?php echo e(trans('auth.email')); ?>" title="<?php echo e(trans('auth.email')); ?>" autocomplete="off">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
             </div>

            
            <div class="form-group has-feedback">
              <input type="password" class="form-control login-field custom-rounded" name="password" id="password" placeholder="<?php echo e(trans('auth.password')); ?>" title="<?php echo e(trans('auth.password')); ?>" autocomplete="off">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         </div>
         
         <div class="row margin-bottom-15">
     	<div class="col-xs-7">
     		<div class="checkbox icheck margin-zero">
				<label class="margin-zero">
					<input <?php if( old('remember') ): ?> checked="checked" <?php endif; ?> id="keep_login" class="no-show" name="remember" type="checkbox" value="1">
					<span class="keep-login-title"><?php echo e(trans('auth.remember_me')); ?></span>
			</label>
		</div>
     	</div>
     	
     	<div class="col-xs-5">
     		<label class="btn-block">
		   <a href="<?php echo e(url('/password/reset')); ?>" class="label-terms recover"><?php echo e(trans('auth.forgot_password')); ?></a>
		</label>
     	</div>
     </div><!-- row -->

           
           <button type="submit" id="buttonSubmit" class="btn btn-block btn-lg btn-main custom-rounded"><?php echo e(trans('auth.sign_in')); ?></button>
     <br>
     <div class="row margin-bottom-15">

      <div class="col-xs-7">
        <label class="margin-zero">
        <a href="<?php echo e(url('register')); ?>" class="label-terms recover">Belum punya akun? Daftar</a>
      </label>
      </div>
      
     </div><!-- row -->

          </form>
                      	
     </div><!-- Login Form -->
		
 </div><!-- /COL MD -->
  
</div><!-- ROW -->
 
 </div><!-- row -->
 
 <!-- container wrap-ui -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('public/plugins/iCheck/icheck.min.js')); ?>"></script>
	
	<script type="text/javascript">
	
	$('#username_or_email').focus();
	
	$('#buttonSubmit').click(function(){
    	$(this).css('display','none');
    	$('.auth-social').css('display','none');
    	$('<div class="btn-block text-center"><i class="fa fa-cog fa-spin fa-3x fa-fw fa-loader"></i></div>').insertAfter('#signup_form');
    });
    
    
    
	$(document).ready(function(){
	  $('input').iCheck({
	  	checkboxClass: 'icheckbox_square-red',
    	radioClass: 'iradio_square-red',
	    increaseArea: '20%' // optional
	  });
	});
	
	<?php if(count($errors) > 0): ?>
    	scrollElement('#dangerAlert');
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>