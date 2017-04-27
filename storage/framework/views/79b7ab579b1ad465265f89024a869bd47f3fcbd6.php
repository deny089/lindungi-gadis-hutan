<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           <?php echo e(trans('admin.admin')); ?> <i class="fa fa-angle-right margin-separator"></i> <?php echo e(trans('misc.withdrawals')); ?> (<?php echo e($data->total()); ?>)
          </h4>
     
        </section>

        <!-- Main content -->
        <section class="content">
        	
        	<?php if(Session::has('success_message')): ?>
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
		      <i class="fa fa-check margin-separator"></i>  <?php echo e(Session::get('success_message')); ?>	        
		    </div>
		<?php endif; ?>
        	 		      			    
        	<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> 
                  		<?php echo e(trans('misc.withdrawals')); ?>                    		
                  	</h3>
                </div><!-- /.box-header -->
		
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
               <tbody>

               	<?php if( $data->total() !=  0 && $data->count() != 0 ): ?>
                   <tr>
                      <th class="active">ID</th>
			   		  <th class="active"><?php echo e(trans('misc.campaign')); ?></th>
			          <th class="active"><?php echo e(trans('admin.amount')); ?></th>
			          <th class="active"><?php echo e(trans('misc.method')); ?></th>
			          <th class="active"><?php echo e(trans('admin.status')); ?></th>
			          <th class="active"><?php echo e(trans('admin.date')); ?></th>
			          <th class="active"><?php echo e(trans('admin.actions')); ?></th>
                    </tr><!-- /.TR -->
                  
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
	        	
                      	<a href="<?php echo e(url('panel/admin/withdrawal',$withdrawal->id)); ?>" class="btn btn-xs btn-success" title="<?php echo e(trans('admin.view')); ?>">
                      		<?php echo e(trans('admin.view')); ?>

                      	</a>
                      	
                      	</td>

                    </tr><!-- /.TR -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    
                    <?php else: ?>
                    <hr />
                    	<h3 class="text-center no-found"><?php echo e(trans('misc.no_results_found')); ?></h3>

                    <?php endif; ?>   		  		 		

                                        
                  </tbody>
                  
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <?php if( $data->lastPage() > 1 ): ?>
             <?php echo e($data->links()); ?>

             <?php endif; ?>
            </div>
          </div>        	
        	
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>