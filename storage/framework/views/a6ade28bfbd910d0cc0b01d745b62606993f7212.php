<?php if( $data->count() != 0 ): ?>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <?php 
    $letter = str_slug(mb_substr( $donation->fullname, 0, 1,'UTF8')); 
    
	if( $letter == '' ) {
		$letter = 'N/A';
	} 
	
	if( $donation->anonymous == 1 ) {
		$letter = 'N/A';
		$donation->fullname = trans('misc.anonymous');
	}
    ?>

	<?php echo $__env->make('includes.listing-donations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<?php echo e($data->links('vendor.pagination.loadmore')); ?>

<?php endif; ?>
