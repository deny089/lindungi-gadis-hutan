<?php 
 if( $category->image == '' ) {
$_image = 'default.jpg';
 } else {
 	$_image = $category->image;
 }
 ?>								
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 row-margin-20">
<a href="<?php echo e(url('category',$category->slug)); ?>">
  <img class="img-responsive btn-block custom-rounded" src="<?php echo e(asset('public/img-category')); ?>/<?php echo e($_image); ?>" alt="<?php echo e($category->name); ?>">
</a>

<h1 class="title-services">
	<a href="<?php echo e(url('category',$category->slug)); ?>">
		<?php echo e($category->name); ?> (<?php echo e($category->campaigns()->count()); ?>)
	</a>
	</h1>
  </div><!-- col-md-3 row-margin-20 -->