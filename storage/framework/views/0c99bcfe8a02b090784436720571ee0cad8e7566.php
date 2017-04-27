<?php $__env->startSection('title'); ?> <?php echo e($title); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site"><?php echo e($response->title); ?></h2>
      </div>
    </div>

<div class="container margin-bottom-40">
	
	<div class="row"></div>
<!-- Col MD -->
<div class="col-md-12">	
		
	<ol class="breadcrumb bg-none">
          	<li><a href="<?php echo e(URL::to('/')); ?>"><i class="glyphicon glyphicon-home myicon-right"></i></a></li>
          	<li class="active"><?php echo e($response->title); ?></li>
          </ol>
	<hr />
     	
     <dl>
     	<dd>
     		<?php echo html_entity_decode($response->content) ?>
     	</dd>
     </dl>	
 </div><!-- /COL MD -->
 
 </div><!-- row -->
 
 <!-- container wrap-ui -->
<?php $__env->stopSection(); ?>

<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-585020448840e9d1"></script> 

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>