<?php $settings = App\Models\AdminSettings::first(); ?>


<?php $__env->startSection('title'); ?><?php echo e($category->name.' - '); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site"><?php echo e($category->name); ?></h2>
       
       
       <?php if( $data->total() != 0 ): ?>
        	<p class="subtitle-site"><strong>(<?php echo e(number_format($data->total())); ?>) <?php echo e(trans_choice('misc.campaign_available_category',$data->total() )); ?></strong></p>
        <?php else: ?>
        	<p class="subtitle-site"><strong><?php echo e($settings->title); ?></strong></p>
        <?php endif; ?>
      </div>
    </div>

<div class="container margin-bottom-40">
	
<!-- Col MD -->
<div class="col-md-12 margin-top-20 margin-bottom-20">	

	<?php if( $data->total() != 0 ): ?>	

	     <?php echo $__env->make('includes.campaigns', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	     			    		 
	  <?php else: ?>
	  <div class="btn-block text-center">
	    			<i class="icon-search ico-no-result"></i>
	    		</div>
	    		
	    		<h3 class="margin-top-none text-center no-result no-result-mg">
	    		<?php echo e(trans('misc.no_results_found')); ?>

	    	</h3>
	  <?php endif; ?>
	    	
     </div><!-- /COL MD -->
 </div><!-- container wrap-ui -->
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
						url: '<?php echo e(url("ajax/category")); ?>?slug=<?php echo e($category->slug); ?>&page=' + page,
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
		
		</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>