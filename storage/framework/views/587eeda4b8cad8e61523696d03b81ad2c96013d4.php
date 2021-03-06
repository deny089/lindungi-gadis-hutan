

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           <?php echo e(trans('admin.admin')); ?> <i class="fa fa-angle-right margin-separator"></i> <?php echo e(trans('misc.categories')); ?>

          </h4>
     
        </section>

        <!-- Main content -->
        <section class="content">
        	       	
		    <?php if(Session::has('success_message')): ?>
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
		        <?php echo e(Session::get('success_message')); ?>	        
		    </div>
		<?php endif; ?>
		    
        	<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo e(trans('misc.categories')); ?></h3>
                  <div class="box-tools">
                    <a href="<?php echo e(url('panel/admin/categories/add')); ?>" class="btn btn-sm btn-success no-shadow pull-right">
	        		<i class="glyphicon glyphicon-plus myicon-right"></i> <?php echo e(trans('misc.add_new')); ?>

	        		</a>
                  </div>
                </div><!-- /.box-header -->
                
                
		
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
               <tbody>
               	
               	<?php if( $totalCategories !=  0 ): ?>
                   <tr>
                      <th>ID</th>
                      <th><?php echo e(trans('admin.name')); ?></th>
                      <th><?php echo e(trans('admin.actions')); ?></th>
                      <th><?php echo e(trans('admin.status')); ?></th>
                    </tr>
                  
                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                      <td><?php echo e($category->id); ?></td>
                      <td><?php echo e($category->name); ?></td>
                      <td>
                      	<a href="<?php echo e(url('panel/admin/categories/edit/').'/'.$category->id); ?>" class="btn btn-success btn-xs padding-btn">
                      		<?php echo e(trans('admin.edit')); ?>

                      	</a> 
                      	
                      	<a href="javascript:void(0);" data-url="<?php echo e(url('panel/admin/categories/delete/').'/'.$category->id); ?>" class="btn btn-danger btn-xs padding-btn actionDelete">
                      		<?php echo e(trans('admin.delete')); ?>

                      		</a>
                      		
                      		</td>
                      		<?php if( $category->mode == 'on' ) {
                      			$mode = 'success';
                      		} else {
                      			$mode = 'danger';
                      		} ?>
                      <td><span class="label label-<?php echo e($mode); ?>"><?php echo e(ucfirst($category->mode)); ?></span></td>
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
            </div>
          </div>        	
        	
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	
<script type="text/javascript">

$(".actionDelete").click(function(e) {
   	e.preventDefault();
   	   	
   	var element = $(this);
	var url     = element.attr('data-url');
	
	element.blur();
	
	swal(
		{   title: "<?php echo e(trans('misc.delete_confirm')); ?>",  
		 text: "<?php echo e(trans('misc.confirm_delete_category')); ?>",  
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
		    	 	window.location.href = url;
		    	 	}
		    	 });
		    	 
		    	 
		 });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>