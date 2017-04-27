<?php 
// ** Data User logged ** //
     $user = Auth::user();
	 $settings = App\Models\AdminSettings::first();	 	 	 
	  ?>


<?php $__env->startSection('title'); ?> <?php echo e(trans('misc.withdrawals')); ?> - <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site"><?php echo e(trans('misc.withdrawals')); ?></h2>
      </div>
    </div>

<div class="container margin-bottom-40">
	
		<!-- Col MD -->
		<div class="col-md-8 margin-bottom-20">

<div class="table-responsive">
   <table class="table table-striped"> 
   	
   	<h5><strong><?php echo e(trans('misc.default_withdrawal')); ?></strong>: <?php if( Auth::user()->payment_gateway == '' ): ?> <?php echo e(trans('misc.unconfigured')); ?> <?php else: ?> <?php echo e(Auth::user()->payment_gateway); ?> <?php endif; ?>
   		
   		<a class="btn btn-xs btn-success pull-right margin-bottom-5" href="<?php echo e(url('account/withdrawals/configure')); ?>">
	  <i class="fa fa-cog myicon-right"></i> <?php echo e(trans('misc.configure')); ?>

	</a>
   		
   		</h5>
   	
   	
   	<?php if( $data->total() !=  0 && $data->count() != 0 ): ?>
   	<thead> 
   		<tr>
   		 <th class="active">ID</th>
   		  <th class="active"><?php echo e(trans('misc.campaign')); ?></th>
          <th class="active"><?php echo e(trans('admin.amount')); ?></th>
          <th class="active"><?php echo e(trans('misc.method')); ?></th>
          <th class="active"><?php echo e(trans('admin.status')); ?></th>
          <th class="active"><?php echo e(trans('admin.date')); ?></th>
          <th class="active"><?php echo e(trans('admin.actions')); ?></th>
          </tr>
   		  </thead> 
   		  
   		  <tbody> 

   		      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
   		         		      
                    <tr>
                      <td><?php echo e($withdrawal->id); ?></td>
                      <td>
                      	<a title="<?php echo e($withdrawal->title); ?>" href="<?php echo e(url('campaign',$withdrawal->campaigns()->id)); ?>" target="_blank"><?php echo e(str_limit($withdrawal->campaigns()->title,20,'...')); ?> <i class="fa fa-external-link-square"></i></a>
                      	</td>
                      <td><?php echo e($settings->currency_symbol.number_format( $withdrawal->amount  )); ?></td>
                      <td><?php echo e($withdrawal->gateway); ?></td>
                      <td>
                      	<?php if( $withdrawal->status == 'paid' ): ?>
                      	<span class="label label-success"><?php echo e(trans('misc.paid')); ?></span>
                      	<?php else: ?>
                      	<span class="label label-warning"><?php echo e(trans('misc.pending_to_pay')); ?></span>
                      	<?php endif; ?>
                      </td>
                      <td><?php echo e(date('d M, y', strtotime($withdrawal->date))); ?></td>
                      <td>
                
                <?php if( $withdrawal->status != 'paid' ): ?>      	
                      	<?php echo Form::open([
			            'method' => 'POST',
			            'url' => "delete/withdrawal/$withdrawal->id",
			            'class' => 'displayInline'
				        ]); ?>

				        				        
	            	<?php echo Form::button(trans('misc.delete'), ['class' => 'btn btn-danger btn-xs deleteW']); ?>

	        	<?php echo Form::close(); ?>

	        	
	        	<?php else: ?>
	        	
	        	- <?php echo e(trans('misc.paid')); ?> -
	        	
	        	<?php endif; ?>
	        	
                      	<!--<a href="javascript:void(0);" data-url="<?php echo e(url('delete/withdrawal',$withdrawal->id)); ?>" id="deleteW" class="btn btn-xs btn-danger" title="<?php echo e(trans('misc.delete')); ?>">
                      		<i class="glyphicon glyphicon-remove-circle"></i> <?php echo e(trans('misc.delete')); ?>

                      	</a>-->
                      	
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

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">

$(".deleteW").click(function(e) {
   	e.preventDefault();
   	   	
   	var element = $(this);
	var url     = element.attr('data-url');
	
	element.blur();
	
	swal(
		{   title: "<?php echo e(trans('misc.delete_confirm')); ?>",  
		 text: "<?php echo e(trans('misc.confirm_delete_withdrawal')); ?>",  
		  type: "warning",   
		  showLoaderOnConfirm: true,
		  showCancelButton: true,   
		  confirmButtonColor: "#DD6B55",  
		   confirmButtonText: "<?php echo e(trans('misc.yes_confirm')); ?>",   
		   cancelButtonText: "<?php echo e(trans('misc.cancel_confirm')); ?>",  
		    closeOnConfirm: false,  
		    }, 
		    function(isConfirm){  
		    	 if (isConfirm) {     
		    	 	$('.displayInline').submit();
		    	 	//window.location.href = url;
		    	 	}
		    	 });
		    	 
		    	 
		 });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>