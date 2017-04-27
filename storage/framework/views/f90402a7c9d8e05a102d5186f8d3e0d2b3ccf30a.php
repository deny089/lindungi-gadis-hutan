<?php 
// ** Data User logged ** //
     $user = Auth::user();
	 $settings = App\Models\AdminSettings::first();
	 
	 $data = App\Models\Donations::leftJoin('campaigns', function($join) {
      $join->on('donations.campaigns_id', '=', 'campaigns.id');
    })
    ->where('campaigns.user_id',Auth::user()->id)
	->select('donations.*')
	->addSelect('campaigns.title')
	->orderBy('donations.id','DESC')
    ->paginate(20);
	 	 
	  ?>


<?php $__env->startSection('title'); ?> <?php echo e(trans('misc.donations')); ?> - <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site"><?php echo e(trans('misc.donations')); ?></h2>
      </div>
    </div>

<div class="container margin-bottom-40">
	
		<!-- Col MD -->
		<div class="col-md-8 margin-bottom-20">

<div class="table-responsive">
   <table class="table table-striped"> 
   	
   	<?php if( $data->total() !=  0 && $data->count() != 0 ): ?>
   	<thead> 
   		<tr>
   		 <th class="active">ID</th>
          <th class="active"><?php echo e(trans('auth.full_name')); ?></th>
          <th class="active"><?php echo e(trans_choice('misc.campaigns_plural', 1)); ?></th>
          <th class="active"><?php echo e(trans('auth.email')); ?></th>
          <th class="active"><?php echo e(trans('misc.donation')); ?></th>
          <th class="active"><?php echo e(trans('admin.date')); ?></th>
          </tr>
   		  </thead> 
   		  
   		  <tbody> 
   		      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                      <td><?php echo e($donation->id); ?></td>
                      <td><?php echo e($donation->fullname); ?></td>
                      <td><a href="<?php echo e(url('campaign',$donation->campaigns_id)); ?>" target="_blank"><?php echo e(str_limit($donation->title, 10, '...')); ?> <i class="fa fa-external-link-square"></i></a></td>
                      <td><?php echo e($donation->email); ?></td>
                      <td><?php echo e($settings->currency_symbol.number_format($donation->donation)); ?></td>
                      <td><?php echo e(date('d M, y', strtotime($donation->date))); ?></td>
                    </tr><!-- /.TR -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    
                    <?php else: ?>
                    <hr />
                    	<h3 class="text-center no-found"><?php echo e(trans('misc.no_results_found')); ?></h3>

                    <?php endif; ?>   		  		 		
   		  		 		</tbody> 
   		  		 		</table>
   		  		 		</div>
   		  		 	
   		  		 	<?php if( $data->lastPage() > 1 ): ?>	
   		  		 		<?php echo e($data->links()); ?>

   		  		 	<?php endif; ?>
   		  		 	
		</div><!-- /COL MD -->
		
		<div class="col-md-4">
			<?php echo $__env->make('users.navbar-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		
 </div><!-- container -->
 
 <!-- container wrap-ui -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>