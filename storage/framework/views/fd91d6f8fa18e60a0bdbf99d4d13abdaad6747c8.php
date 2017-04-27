<?php 
// ** Data User logged ** //
     $user = Auth::user();
	  ?>


<?php $__env->startSection('title'); ?> <?php echo e(trans('users.account_settings')); ?> - <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site"><?php echo e(trans('users.account_settings')); ?></h2>
      </div>
    </div>

<div class="container margin-bottom-40">
	
			<!-- Col MD -->
		<div class="col-md-8 margin-bottom-20">
	
			<?php if(session('notification')): ?>
			<div class="alert alert-success btn-sm alert-fonts" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            		<?php echo e(session('notification')); ?>

            		</div>
            	<?php endif; ?>
            	
			<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			
			
		
		<!-- *********** AVATAR ************* -->
		
		<form action="<?php echo e(url('upload/avatar')); ?>" method="POST" id="formAvatar" accept-charset="UTF-8" enctype="multipart/form-data">
    		<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    		
    		<div class="text-center">
    			<img src="<?php echo e(asset('public/avatar').'/'.Auth::user()->avatar); ?>" alt="User" width="100" height="100" class="img-rounded avatarUser"  />
    		</div>
    		
    		<div class="text-center">
    			<button type="button" class="btn btn-default btn-border btn-sm" id="avatar_file" style="margin-top: 10px;">
	    		<i class="icon-camera myicon-right"></i> <?php echo e(trans('misc.change_avatar')); ?>

	    		</button>
	    		<input type="file" name="photo" id="uploadAvatar" accept="image/*" style="visibility: hidden;">
    		</div>
			
			</form><!-- *********** AVATAR ************* -->
		

			
		<!-- ***** FORM ***** -->	
       <form action="<?php echo e(url('account')); ?>" method="post" name="form">
          		
          	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            
            <!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default"><?php echo e(trans('misc.full_name_misc')); ?></label>
              <input type="text" class="form-control login-field custom-rounded" value="<?php echo e(e( $user->name )); ?>" name="full_name" placeholder="<?php echo e(trans('misc.full_name_misc')); ?>" title="<?php echo e(trans('misc.full_name_misc')); ?>" autocomplete="off">
             </div><!-- ***** Form Group ***** -->
			
            <!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default">Phone Number</label>
              <input type="text" class="form-control login-field custom-rounded" value="<?php echo e(e( $user->telpon )); ?>" name="telpon" placeholder="Insert Phone Number" title="Phone Number" autocomplete="off">
             </div><!-- ***** Form Group ***** -->

			<!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default"><?php echo e(trans('auth.email')); ?></label>
              <input type="email" class="form-control login-field custom-rounded" value="<?php echo e($user->email); ?>" name="email" placeholder="<?php echo e(trans('auth.email')); ?>" title="<?php echo e(trans('auth.email')); ?>" autocomplete="off">
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

<?php $__env->startSection('javascript'); ?>

<script type="text/javascript">

	//<<<<<<<=================== * UPLOAD AVATAR  * ===============>>>>>>>//
    $(document).on('change', '#uploadAvatar', function(){
    
    $('.wrap-loader').show();
    
   (function(){
	 $("#formAvatar").ajaxForm({
	 dataType : 'json',	
	 success:  function(e){
	 if( e ){
        if( e.success == false ){
		$('.wrap-loader').hide();
		
		var error = '';
                        for($key in e.errors){
                        	error += '' + e.errors[$key] + '';
                        }
		swal({   
    			title: "<?php echo e(trans('misc.error_oops')); ?>",   
    			text: ""+ error +"",   
    			type: "error",   
    			confirmButtonText: "<?php echo e(trans('users.ok')); ?>" 
    			});
		
			$('#uploadAvatar').val('');

		} else {
			
			$('#uploadAvatar').val('');
			$('.avatarUser').attr('src',e.avatar);
			$('.wrap-loader').hide();
		}
		
		}//<-- e
			else {
				$('.wrap-loader').hide();
				swal({   
    			title: "<?php echo e(trans('misc.error_oops')); ?>",   
    			text: '<?php echo e(trans("misc.error")); ?>',   
    			type: "error",   
    			confirmButtonText: "<?php echo e(trans('users.ok')); ?>" 
    			});
    			
				$('#uploadAvatar').val('');
			}
		   }//<----- SUCCESS
		}).submit();
    })(); //<--- FUNCTION %
});//<<<<<<<--- * ON * --->>>>>>>>>>>
//<<<<<<<=================== * UPLOAD AVATAR  * ===============>>>>>>>//
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>