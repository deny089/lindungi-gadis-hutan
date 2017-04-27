<?php 
$settings = App\Models\AdminSettings::first(); 


?>


<?php $__env->startSection('content'); ?>
<div class="jumbotron md index-header jumbotron_set jumbotron-cover <?php if( Auth::check() ): ?> session-active-cover <?php endif; ?>">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site txt-left" id="titleSite"><center>Kampanye Hutan</center></h2>
      </div><!-- container wrap-jumbotron -->
</div><!-- jumbotron -->
	<br>
	<!-- edited cacip -->

<?php if( $data->total() != 0 ): ?>
	<div class="container margin-bottom-40">
		
		<div class="margin-bottom-30">
			<?php echo $__env->make('includes.campaigns', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		
	</div><!-- container wrap-ui -->
	
	<?php else: ?>
	<div class="container margin-bottom-40">
		<div class="margin-bottom-30">
			<div class="btn-block text-center margin-top-40">
	    			<i class="ion ion-speakerphone ico-no-result"></i>
	    		</div>
	    		
	    		<h3 class="margin-top-none text-center no-result no-result-mg">
	    	<?php echo e(trans('misc.no_campaigns')); ?>

	    	</h3>
		</div>
	</div>
	<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('public/plugins/jquery.counterup/jquery.counterup.min.js')); ?>"></script>
	<script src="http://maps.google.com/maps/api/js?key=AIzaSyCFUkpUT8OQ_2kblunHrU8tH_raZg4yOAo" type="text/javascript"></script>

	<script src="<?php echo e(asset('public/plugins/jquery.counterup/waypoints.min.js')); ?>"></script>
	
		<script type="text/javascript">
		
		$(document).on('click','#campaigns .loadPaginator', function(r){
			r.preventDefault();
			 $(this).remove();
			 $('.loadMoreSpin').remove();
					$('<div class="col-xs-12 loadMoreSpin"><a class="list-group-item text-center"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i></a></div>').appendTo( "#campaigns" );
					
					var page = $(this).attr('href').split('page=')[1];
					$.ajax({
						url: '<?php echo e(url("ajax/campaigns")); ?>?page=' + page
					}).done(function(data){
						if( data ) {
							$('.loadMoreSpin').remove();
							
							$( data ).appendTo( "#campaigns" );
						} else {
							bootbox.alert( "<?php echo e(trans('misc.error')); ?>" );
						}
						//<**** - Tooltip
					});
			});
	
		jQuery(document).ready(function( $ ) {
			$('.counter').counterUp({
			delay: 10, // the delay time in ms
			time: 1000 // the speed time in ms
			});
		});
		
		 <?php if(session('success_verify')): ?>
    		swal({   
    			title: "<?php echo e(trans('misc.welcome')); ?>",   
    			text: "<?php echo e(trans('users.account_validated')); ?>",   
    			type: "success",   
    			confirmButtonText: "<?php echo e(trans('users.ok')); ?>" 
    			});
   		 <?php endif; ?>
   		 
   		 <?php if(session('error_verify')): ?>
    		swal({   
    			title: "<?php echo e(trans('misc.error_oops')); ?>",   
    			text: "<?php echo e(trans('users.code_not_valid')); ?>",   
    			type: "error",   
    			confirmButtonText: "<?php echo e(trans('users.ok')); ?>" 
    			});
   		 <?php endif; ?>
		
		</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>