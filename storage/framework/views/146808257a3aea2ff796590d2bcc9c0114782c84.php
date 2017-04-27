

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           <?php echo e(trans('admin.admin')); ?> <i class="fa fa-angle-right margin-separator"></i> <?php echo e(trans('misc.campaigns')); ?> (<?php echo e($data->total()); ?>)
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
                  		<?php echo e(trans('misc.campaigns')); ?>                    		
                  	</h3>
                </div><!-- /.box-header -->
		
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
               <tbody>

               	<?php if( $data->total() !=  0 && $data->count() != 0 ): ?>
                   <tr>
                      <th class="active">ID</th>
                      <th class="active"><?php echo e(trans('misc.title')); ?></th>
                      <th class="active"><?php echo e(trans('admin.user')); ?></th>
                      <th class="active"><?php echo e(trans('misc.goal')); ?></th>
                      <th class="active"><?php echo e(trans('misc.funds_raised')); ?></th>
                      <th class="active"><?php echo e(trans('admin.status')); ?></th>
                      <th class="active"><?php echo e(trans('admin.date')); ?></th>
                      <th class="active"><?php echo e(trans('admin.actions')); ?></th>
                    </tr><!-- /.TR -->
                  
                  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                      <td><?php echo e($campaign->id); ?></td>
                      <td><img src="<?php echo e(asset('public/campaigns/small').'/'.$campaign->small_image); ?>" width="20" /> 
                      	<a title="<?php echo e($campaign->title); ?>" href="<?php echo e(url('campaign',$campaign->id)); ?>" target="_blank"><?php echo e(str_limit($campaign->title,20,'...')); ?> <i class="fa fa-external-link-square"></i></a>
                      	</td>
                      <td><?php echo e($campaign->user()->name); ?></td>
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
                      <td> <a href="<?php echo e(url('panel/admin/campaigns/edit',$campaign->id)); ?>" class="btn btn-success btn-xs padding-btn">
                      		<?php echo e(trans('admin.edit')); ?>

                      	</a> 
                        <a href="<?php echo e(url('panel/admin/campaigns/pantau',$campaign->id)); ?>" class="btn btn-success btn-xs padding-btn">
                          pantau
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