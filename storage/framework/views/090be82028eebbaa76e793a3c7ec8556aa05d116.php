<span class="description margin-bottom-20 btn-block">
	<strong>#<?php echo e(trans('misc.update')); ?></strong> 
	<?php if( Auth::check() && Auth::user()->id == $update->campaigns()->user_id ): ?>
		<a href="<?php echo e(url('edit/update',$update->id)); ?>" class="btn btn-success btn-xs"><i class="fa fa-pencil mycion-right"></i> <?php echo e(trans('users.edit')); ?></a>
	<?php endif; ?>
	<small class="btn-block timeAgo text-muted" style="font-size: 15px; font-style: italic;" data="<?php echo e(date('c', strtotime( $update->date ))); ?>"></small>
		<?php echo App\Helper::checkText($update->description); ?>

		<?php if( $update->image !== '' ): ?>	
		<span class="text-center btn-block">
			<img class="img-responsive img-rounded  margin-top-10" style="display: inline-block;" src="<?php echo e(url('public/campaigns/updates',$update->image)); ?>" />
		</span>
			<?php endif; ?>
</span>