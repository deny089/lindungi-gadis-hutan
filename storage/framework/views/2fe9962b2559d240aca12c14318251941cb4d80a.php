<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           <?php echo e(trans('admin.admin')); ?> <i class="fa fa-angle-right margin-separator"></i> <?php echo e(trans('admin.pages')); ?> (<?php echo e($data->count()); ?>)
          </h4>
     
        </section>

        <!-- Main content -->
        <section class="content">
        	       	
		    <?php if(Session::has('success_message')): ?>
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
		      <i class="fa fa-check margin-separator"></i> <?php echo e(Session::get('success_message')); ?>	        
		    </div>
		<?php endif; ?>
		    
        	<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo e(trans('admin.pages')); ?></h3>
                  <div class="box-tools">
                    <a href="<?php echo e(url('panel/admin/pages/create')); ?>" class="btn btn-sm btn-success no-shadow pull-right">
	        		<i class="glyphicon glyphicon-plus myicon-right"></i> <?php echo e(trans('misc.add_new')); ?>

	        		</a>
                  </div>
                </div><!-- /.box-header -->
                
                
		
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
               <tbody>

               	<?php if( $data->count() !=  0 ): ?>
                   <tr>
                      <th class="active">ID</th>
                      <th class="active"><?php echo e(trans('admin.title')); ?></th>
                      <th class="active"><?php echo e(trans('admin.slug')); ?></th>
                      <th class="active"><?php echo e(trans('admin.actions')); ?></th>
                    </tr>
                  
                  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                      <td><?php echo e($page->id); ?></td>
                      <td><?php echo e($page->title); ?></td>
                      <td><?php echo e(strtolower($page->slug)); ?></td>
                      <td>
                      	<a href="<?php echo e(route('pages.edit', $page->id)); ?>" class="btn btn-success btn-xs padding-btn">
                      		<?php echo e(trans('admin.edit')); ?>

                      	</a> 
                     
                     <?php if( $data->count() != 1 ): ?>
                   
                   <?php echo Form::open([
			            'method' => 'DELETE',
			            'route' => ['pages.destroy', $page->id],
			            'id' => 'form'.$page->id,
			            'class' => 'displayInline'
				        ]); ?>

	            	<?php echo Form::submit(trans('admin.delete'), ['data-url' => $page->id, 'class' => 'btn btn-danger btn-xs padding-btn actionDelete']); ?>

	        	<?php echo Form::close(); ?>

	       
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
	var id     = element.attr('data-url');
	var form    = $(element).parents('form');
	
	element.blur();
	
	swal(
		{   title: "<?php echo e(trans('misc.delete_confirm')); ?>",  
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
		    	 	form.submit();  
		    	 	//$('#form' + id).submit();
		    	 	}
		    	 });
		    	 
		    	 
		 });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>