<?php 
$settings = App\Models\AdminSettings::first(); 
$total_raised_funds = App\Models\Donations::sum('donation');
$total_campaigns    = App\Models\Campaigns::where('status','active')->count();
$total_members      = App\Models\User::count();
?>


<?php $__env->startSection('content'); ?>
<div class="jumbotron index-header jumbotron_set jumbotron-cover <?php if( Auth::check() ): ?> session-active-cover <?php endif; ?>">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site txt-left" id="titleSite"><?php echo e($settings->welcome_text); ?></h1>
        <p class="subtitle-site txt-left"><strong><?php echo e($settings->welcome_subtitle); ?></strong></p>
      </div><!-- container wrap-jumbotron -->
</div><!-- jumbotron -->


<?php if( $data->total() != 0 ): ?>
	<div class="container margin-bottom-40">
		
		<div class="row margin-bottom-40">
		<!-- edited cacip -->
		<div class="container">
			<div class="col-md-4 border-stats">
				<h1 class="btn-block text-center class-montserrat margin-bottom-zero none-overflow"><span class=".numbers-with-commas counter"><?php echo html_entity_decode( App\Helper::formatNumbersStats($total_members) ) ?></span></h1>
				<h5 class="btn-block text-center class-montserrat subtitle-color text-uppercase"><?php echo e(trans('misc.members')); ?></h5>
			</div><!-- col-md-3 -->
				
			<div class="col-md-4 border-stats">
				<h1 class="btn-block text-center class-montserrat margin-bottom-zero none-overflow"><span class=".numbers-with-commas counter"><?php echo html_entity_decode( App\Helper::formatNumbersStats($total_campaigns) ) ?></span></h1>
				<h5 class="btn-block text-center class-montserrat subtitle-color text-uppercase"><?php echo e(trans('misc.campaigns')); ?></h5>
			</div><!-- col-md-3 -->
				
			<div class="col-md-4 border-stats">
				<h1 class="btn-block text-center class-montserrat margin-bottom-zero none-overflow"><?php echo e($settings->currency_symbol); ?>   <?php echo html_entity_decode( App\Helper::formatNumbersStats($total_raised_funds) ) ?></h1>
				<h5 class="btn-block text-center class-montserrat subtitle-color text-uppercase"><?php echo e(trans('misc.funds_raised')); ?></h5>
			</div><!-- col-md-3 -->
			

		</div><!-- row -->
		<!-- edited cacip -->
		</div>	
			
		<div class="col-md-12 btn-block margin-bottom-40">
			<h1 class="btn-block text-center class-montserrat margin-bottom-zero none-overflow"><?php echo e(trans('misc.campaigns')); ?></h1>
			<h5 class="btn-block text-center class-montserrat subtitle-color"><?php echo e(trans('misc.recent_campaigns')); ?></h5>
		</div>			
		
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



	
	<div class="jumbotron jumbotron-bottom margin-bottom-zero jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site"><?php echo e(trans('misc.title_cover_bottom')); ?></h1>
        <p class="subtitle-site txt-center"><strong><?php echo e($settings->welcome_subtitle); ?></strong></p>

      </div><!-- container wrap-jumbotron -->
</div><!-- jumbotron -->

<!-- edited cacip -->
<div class="col-xs-4 col-xs-offset-4 margin-top-40 margin-bottom-40">
<h4 class="btn-block text-center class-montserrat margin-bottom-20 none-overflow"><center>Partner</center></h4>
<div class="container ">
<?php $__currentLoopData = $partner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partners): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<div class="col-sx-1 col-md-1 col-thumb col-centered ">
<a href="#" class="thumbnail">
<img src="<?php echo e(asset('public/img-partner').'/'.$partners->gambar); ?>" title="<?php echo e(e($partners->nama)); ?>">
</a>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</div>
</div>
<!-- end edited cacip -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('public/plugins/jquery.counterup/jquery.counterup.min.js')); ?>"></script>
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