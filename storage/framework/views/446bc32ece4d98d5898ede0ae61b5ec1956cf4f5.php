<?php $settings = App\Models\AdminSettings::first(); ?>


<?php $__env->startSection('title'); ?><?php echo e(e($title)); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site"><?php echo e(trans('misc.search')); ?></h2>
        <p class="subtitle-site none-overflow"><strong>"<?php echo e($q); ?>"</strong></p>
      </div>
    </div>
    
<div class="container margin-bottom-40">
	<div class="row">
		<div class="col-md-12">
			
			<h2 class="text-center line position-relative none-overflow">
				<?php echo e(trans('misc.result_of')); ?> "<?php echo e($q); ?>" <small><?php echo e($total); ?> <?php echo e(trans_choice('misc.campaigns_plural',$total)); ?></small>
				</h2>
	
	<?php if( $data->total() != 0 ): ?>		
		<div class="margin-top-30 margin-bottom-30">
			<?php echo $__env->make('includes.campaigns', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		
		<?php else: ?>
		
		<div class="btn-block text-center margin-top-40">
	    			<i class="icon-search ico-no-result"></i>
	    		</div>
	    		
	    		<h3 class="margin-top-none text-center no-result no-result-mg">
	    	<?php echo e(trans('misc.no_results_found')); ?>

	    	</h3>
	    			
		<?php endif; ?>
			
				
	
		</div><!-- col-md-12 -->
	</div><!-- row -->
</div><!-- container -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	
	<script type="text/javascript">
		$(document).on('click','#campaigns .loadPaginator', function(r){
			r.preventDefault();
			 $(this).remove();
			 $('.loadMoreSpin').remove();
					$('<div class="col-xs-12 loadMoreSpin"><a class="list-group-item text-center"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i></a></div>').appendTo( "#campaigns" );
					
					var page = $(this).attr('href').split('page=')[1];
					$.ajax({
						url: '<?php echo e(url("ajax/search")); ?>?slug=<?php echo e($q); ?>&page=' + page,
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