<?php 
// ** Data User logged ** //
     $user = Auth::user();
	 $settings = App\Models\AdminSettings::first();
	 $data = App\Models\Campaigns::where('user_id',Auth::user()->id)
	 ->orderBy('id','DESC')
	 ->paginate(20);
	  ?>


<?php $__env->startSection('title'); ?> <?php echo e(trans('misc.campaigns')); ?> - <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site"><?php echo e(trans('misc.campaigns')); ?></h2>
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
   		  <th class="active"><?php echo e(trans('misc.title')); ?></th>
          <th class="active"><?php echo e(trans('misc.goal')); ?></th>
          <th class="active"><?php echo e(trans('misc.funds_raised')); ?></th>
          <th class="active"><?php echo e(trans('admin.status')); ?></th>
          <th class="active"><?php echo e(trans('admin.date')); ?></th>
          <th class="active"><?php echo e(trans('admin.actions')); ?></th> 
          </tr>
   		  </thead> 
   		  
   		  <tbody> 
   		      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                      <td><?php echo e($campaign->id); ?></td>
                      <td><img src="<?php echo e(asset('public/campaigns/small').'/'.$campaign->small_image); ?>" width="20" /> 
                      	<a title="<?php echo e($campaign->title); ?>" href="<?php echo e(url('campaign',$campaign->id)); ?>" target="_blank"><?php echo e(str_limit($campaign->title,20,'...')); ?> <i class="fa fa-external-link-square"></i></a>
                      	</td>
                      <td><?php echo e($settings->currency_symbol.number_format($campaign->goal)); ?></td>
                      <td><?php echo e($settings->currency_symbol.number_format($campaign->donations()->sum('donation'))); ?></td>
                      <td>
                      	<?php if( $campaign->finalized == 0 ): ?>
                      	<span class="label label-success"><?php echo e(trans('misc.active')); ?></span>
                      	<?php else: ?>
                      	<span class="label label-default"><?php echo e(trans('misc.finalized')); ?></span>
                      	<?php endif; ?>
                      </td>
                      <td><?php echo e(date('d M, y', strtotime($campaign->date))); ?></td>
                      <td> 
                     
                     <?php if( $campaign->finalized == 0 ): ?>
                      	<a href="<?php echo e(url('edit/campaign',$campaign->id)); ?>" class="btn btn-success btn-xs padding-btn">
                      		<?php echo e(trans('admin.edit')); ?>

                      	</a> 
                      	<?php else: ?>
                      	 <?php echo e(trans('misc.finalized')); ?>

                      	<?php endif; ?>
                      	
                      	</td>
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