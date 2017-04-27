<?php $settings = App\Models\AdminSettings::first(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="<?php echo $__env->yieldContent('description_custom'); ?><?php echo e($settings->description); ?>">
    <meta name="keywords" content="<?php echo e($settings->keywords); ?>" />
    <link rel="shortcut icon" href="<?php echo e(asset('public/img/favicon.png')); ?>" />

	<title><?php $__env->startSection('title'); ?><?php echo $__env->yieldSection(); ?> <?php if( isset( $settings->title ) ): ?><?php echo e($settings->title); ?><?php endif; ?></title>
	
	<?php echo $__env->make('includes.css_general', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Raleway:100,600' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<?php echo $__env->yieldContent('css'); ?>
	
	<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    
</head>
<body>
	<div class="popout font-default"></div>
	<div class="wrap-loader">
		<i class="fa fa-cog fa-spin fa-3x fa-fw cog-loader"></i>
		<i class="fa fa-cog fa-spin fa-3x fa-fw cog-loader-small"></i>
	</div>
	<?php echo $__env->make('includes.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
		<?php echo $__env->yieldContent('content'); ?>

			<?php echo $__env->make('includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
		<?php echo $__env->make('includes.javascript_general', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<?php echo $__env->yieldContent('javascript'); ?>
	
</body>
</html>
