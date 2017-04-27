<?php if( $data->count() != 0 ): ?>

<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

	<?php echo $__env->make('includes.ajax-updates-campaign', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

<?php echo e($data->links('vendor.pagination.loadmore')); ?>


<?php endif; ?>
