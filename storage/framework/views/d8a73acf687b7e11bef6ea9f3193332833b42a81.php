<div class="col-xs-12 col-sm-6 col-md-3 col-thumb">
 <?php 

   $settings = App\Models\AdminSettings::first();
   
	if( str_slug( $key->title ) == '' ) {
		$slugUrl  = '';
	} else {
		$slugUrl  = '/'.str_slug( $key->title );
	}
	
	$url = url('campaign',$key->id).$slugUrl;
	$percentage = round($key->donations()->sum('donation') / $key->goal * 100);
	
	if( $percentage > 100 ) {
		$percentage = 100;
	} else {
		$percentage = $percentage;
	}	   
?>
<div class="thumbnail padding-top-zero">

				<a class="position-relative btn-block img-grid" href="<?php echo e($url); ?>">
					<img title="<?php echo e(e($key->title)); ?>" src="<?php echo e(asset('public/campaigns/small').'/'.$key->small_image); ?>" class="image-url img-responsive btn-block radius-image" />
				</a>
    			
    			<div class="caption">
    				<h1 class="title-campaigns font-default">
    					<a title="<?php echo e(e($key->title)); ?>" class="item-link" href="<?php echo e($url); ?>">
    					 <?php echo e(e($key->title)); ?>

    					</a>
    				</h1>
    			
    				<p class="desc-campaigns">
    					<?php if( isset($key->user()->id) ): ?>
    					<img src="<?php echo e(asset('public/avatar').'/'.$key->user()->avatar); ?>" width="20" height="20" class="img-circle avatar-campaign" /> <?php echo e($key->user()->name); ?>

    					<?php else: ?>
    					<img src="<?php echo e(asset('public/avatar/default.jpg')); ?>" width="20" height="20" class="img-circle avatar-campaign" /> <?php echo e(trans('misc.user_not_available')); ?>

    					<?php endif; ?>
    				</p>
    				
    				<p class="desc-campaigns text-overflow">
    					 <?php echo e(str_limit(strip_tags($key->description),80,'...')); ?>

    				</p>
    				<!-- edited cacip -->
    				<p class="desc-campaigns">
    						<span class="stats-campaigns">
    							<span class="pull-left">
    								<strong><?php echo e($settings->kode_pohon.number_format($key->donations()->sum('donation'))); ?></strong> 
    								<?php echo e(trans('misc.raised')); ?>

    								</span> 
    							<span class="pull-right"><strong><?php echo e($percentage); ?>%</strong></span> 
    							</span>
	    					
	    					<span class="progress">
	    						<span class="percentage" style="width: <?php echo e($percentage); ?>%" aria-valuemin="0" aria-valuemax="100" role="progressbar"></span>
	    					</span>
    				</p>
    				
    				<h6 class="margin-bottom-zero">
    					<em><strong><?php echo e(trans('misc.goal')); ?> <?php echo e($settings->kode_pohon.number_format($key->goal)); ?></strong></em>
    				</h6>
    				<!-- end edited cacip -->
					
    			</div><!-- /caption -->
    		  </div><!-- /thumbnail -->
    	   </div><!-- /col-sm-6 col-md-4 -->