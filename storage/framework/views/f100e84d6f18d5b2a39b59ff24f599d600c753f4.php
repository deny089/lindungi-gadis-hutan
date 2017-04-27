<div class="posts" id="posts" style="padding-top: 15px;">
	<div class="row" id="campaigns">
   
   <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    	
    	<?php echo $__env->make('includes.list-campaigns', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    	
    	  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    	 
    	 <div class="col-xs-12 loadMoreSpin">
    	 		<?php echo e($data->links('vendor.pagination.loadmore')); ?>

    	 </div> 
    	   
    	   
 </div><!-- /row -->
     	   
    	  
		 		
</div><!-- ./ End Posts -->