

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h4>
           <?php echo e(trans('admin.admin')); ?> <i class="fa fa-angle-right margin-separator"></i> <?php echo e(trans('misc.donation')); ?> #<?php echo e($data->id); ?>

          </h4>
        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="row">
            <div class="col-xs-12">
              <div class="box">
              	
              	<div class="box-body">
              		<dl class="dl-horizontal">
					  
					  <!-- start -->
					  <dt>ID</dt>
					  <dd><?php echo e($data->id); ?></dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <dt><?php echo e(trans('auth.full_name')); ?></dt>
					  <dd><?php echo e($data->fullname); ?></dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <dt><?php echo e(trans_choice('misc.campaigns_plural', 1)); ?></dt>
					  <dd><a href="<?php echo e(url('campaign',$data->campaigns()->id)); ?>" target="_blank"><?php echo e($data->campaigns()->title); ?> <i class="fa fa-external-link-square"></i></a></dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <dt><?php echo e(trans('auth.email')); ?></dt>
					  <dd><?php echo e($data->email); ?></dd>
					  <!-- ./end -->


					  <!-- start -->
					  <dt>Phone</dt>
					  <dd><?php echo e($data->phone); ?></dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <dt><?php echo e(trans('misc.donation')); ?></dt>
					  <dd><strong class="text-success"><?php echo e($settings->currency_symbol.number_format($data->donation)); ?></strong></dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <!-- <dt><?php echo e(trans('misc.country')); ?></dt>
					  <dd><?php echo e($data->country); ?></dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <!-- <dt><?php echo e(trans('misc.postal_code')); ?></dt>
					  <dd><?php echo e($data->postal_code); ?></dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <dt><?php echo e(trans('misc.payment_gateway')); ?></dt>
					  <dd><?php echo e($data->payment_gateway); ?></dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <dt><?php echo e(trans('misc.comment')); ?></dt>
					  <dd>
					  	<?php if( $data->comment != '' ): ?>
					  	<?php echo e($data->comment); ?>

					  	<?php else: ?>
					  	-------------------------------------
					  	<?php endif; ?>
					  	</dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <dt><?php echo e(trans('admin.date')); ?></dt>
					  <dd><?php echo e(date('d M, y', strtotime($data->date))); ?></dd>
					  <!-- ./end -->
					  
					  <!-- start -->
					  <dt><?php echo e(trans('misc.anonymous')); ?></dt>
					  <dd>
					  	<?php if( $data->anonymous == '1' ): ?>
					  	<?php echo e(trans('misc.yes')); ?>

					  	<?php else: ?>
					  	<?php echo e(trans('misc.no')); ?>

					  	<?php endif; ?>
					  	</dd>
					  <!-- ./end -->
					  
					  
					</dl>
              	</div><!-- box body -->
              	
              	<div class="box-footer">
                  	<a href="<?php echo e(url('panel/admin/donations')); ?>" class="btn btn-default"><?php echo e(trans('auth.back')); ?></a>
              		<?php if($data->confirmed == 0): ?>
						<a href="<?php echo e(url('panel/admin/saveconfirmed', $data->id)); ?>" class="btn btn-primary">Konfirmasi Transfer</a>
					<?php else: ?>
						<label href="" class="btn btn-info">Sudah Konfirm</label>
					<?php endif; ?>
                  </div><!-- /.box-footer -->
              	
              </div><!-- box -->
            </div><!-- col -->
         </div><!-- row -->
        	
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>