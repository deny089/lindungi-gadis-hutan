<?php $settings = App\Models\AdminSettings::first(); ?>


<?php $__env->startSection('title'); ?>
<?php echo e(trans('auth.sign_up')); ?> -
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site"><?php echo e(trans('auth.sign_up')); ?></h1>
        <p class="subtitle-site"><strong><?php echo e($settings->title); ?></strong></p>
      </div>
    </div>

<div class="container margin-bottom-40">
	
	<div class="row">
<!-- Col MD -->
<div class="col-md-12">	
	
	<h2 class="text-center position-relative"><?php echo e(trans('auth.sign_up')); ?></h2>
	
	<div class="login-form">
		
		<?php if(session('notification')): ?>
						<div class="alert alert-success text-center">
							
							<div class="btn-block text-center margin-bottom-10">
								<i class="glyphicon glyphicon-ok ico_success_cicle"></i>
								</div>
								
							<?php echo e(session('notification')); ?>

						</div>
					<?php endif; ?>
					
		<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	            	
          	<form action="<?php echo e(url('register')); ?>" method="post" name="form" id="signup_form">
            
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">          
            
            
            <!-- FORM GROUP -->
            <div class="form-group has-feedback">
              <input type="text" class="form-control login-field custom-rounded" value="<?php echo e(old('name')); ?>" name="name" placeholder="<?php echo e(trans('users.name')); ?>" title="<?php echo e(trans('users.name')); ?>" autocomplete="off">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div><!-- ./FORM GROUP -->
            
             <!-- FORM GROUP -->
            <div class="form-group has-feedback">
              <input type="text" class="form-control login-field custom-rounded" value="<?php echo e(old('email')); ?>" name="email" placeholder="<?php echo e(trans('auth.email')); ?>" title="<?php echo e(trans('auth.email')); ?>" autocomplete="off">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div><!-- ./FORM GROUP -->
            
         
         <!-- FORM GROUP -->
         <div class="form-group has-feedback">
              <input type="password" class="form-control login-field custom-rounded" name="password" placeholder="<?php echo e(trans('auth.password')); ?>" title="<?php echo e(trans('auth.password')); ?>" autocomplete="off">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         </div><!-- ./FORM GROUP -->
         
         <div class="form-group has-feedback">
			<input type="password" class="form-control" name="password_confirmation" placeholder="<?php echo e(trans('auth.confirm_password')); ?>" title="<?php echo e(trans('auth.confirm_password')); ?>" autocomplete="off">
			<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
		</div>
		
		<?php if( $settings->captcha == 'on' ): ?>    
            <div class="form-group has-feedback">
              <input type="text" class="form-control login-field" name="captcha" id="lcaptcha" placeholder="" title="">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            
              <div class="alert alert-danger btn-sm margin-top-alert" id="errorCaptcha" role="alert" style="display: none;">
            		<strong><i class="glyphicon glyphicon-alert myicon-right"></i> <?php echo e(Lang::get('auth.error_captcha')); ?></strong>
            	</div>
            </div>
            <?php endif; ?>
         
           <button type="submit" id="buttonSubmit" class="btn btn-block btn-lg btn-main custom-rounded"><?php echo e(trans('auth.sign_up')); ?></button>
          </form>
     </div><!-- Login Form -->
		
 </div><!-- /COL MD -->
 
</div><!-- ROW -->
 
 </div><!-- row -->
 
 <!-- container wrap-ui -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	
	<script type="text/javascript">

 <?php if( $settings->captcha == 'on' ): ?>     
/*
 *  ==============================================  Captcha  ============================== * /
 */
   var captcha_a = Math.ceil( Math.random() * 5 );
   var captcha_b = Math.ceil( Math.random() * 5 );
   var captcha_c = Math.ceil( Math.random() * 5 );
   var captcha_e = ( captcha_a + captcha_b ) - captcha_c;
  
function generate_captcha( id ) {
	var id = ( id ) ? id : 'lcaptcha';
	$("#" + id ).html( captcha_a + " + " + captcha_b + " - " + captcha_c + " = ").attr({'placeholder' : captcha_a + " + " + captcha_b + " - " + captcha_c, title: 'Captcha = '+captcha_a + " + " + captcha_b + " - " + captcha_c });
}
$("input").attr('autocomplete','off');
generate_captcha('lcaptcha');

$('#buttonSubmit').click(function(e){
   	e.preventDefault();
   	var captcha        = $("#lcaptcha").val();
    	if( captcha != captcha_e ){
				var error = true;
		        $("#errorCaptcha").fadeIn(500);
		        $('#lcaptcha').focus();
		        return false;
		      } else {
		      	$(this).css('display','none');
    			$('.auth-social').css('display','none');
    			$('<div class="btn-block text-center"><i class="fa fa-cog fa-spin fa-3x fa-fw fa-loader"></i></div>').insertAfter('#signup_form');
   				$('#signup_form').submit();
		      }
    });
    
    <?php else: ?>
    	
	$('#buttonSubmit').click(function(){
    	$(this).css('display','none');
    	$('.auth-social').css('display','none');
    	$('<div class="btn-block text-center"><i class="fa fa-cog fa-spin fa-3x fa-fw fa-loader"></i></div>').insertAfter('#signup_form');
    });
    
    <?php endif; ?>
    
    <?php if(count($errors) > 0): ?>
    	scrollElement('#dangerAlert');
    <?php endif; ?>
    
    <?php if(session('notification')): ?>
    	$('#signup_form, #dangerAlert').remove();
    <?php endif; ?>

</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>