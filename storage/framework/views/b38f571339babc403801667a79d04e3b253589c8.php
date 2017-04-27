<?php $__env->startSection('title'); ?><?php echo e(trans('misc.categories').' - '); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site"><?php echo e(trans('misc.categories')); ?></h2>
        <p class="subtitle-site"><strong><?php echo e(trans('misc.browse_by_category')); ?></strong></p>
      </div>
    </div>

<div class="container margin-bottom-40">
	
	    		<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	        				<?php echo $__env->make('includes.categories-listing', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	        			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

 </div><!-- container wrap-ui -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>