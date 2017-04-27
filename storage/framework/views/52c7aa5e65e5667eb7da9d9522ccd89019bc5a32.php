<?php if($paginator->hasMorePages()): ?> 
<a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" class="list-group-item text-center loadPaginator" id="paginator">
       	 	<i class="fa fa-repeat myicon-right"></i> <?php echo e(trans('misc.loadmore')); ?>

       	 	</a>
       	 	<?php endif; ?>
