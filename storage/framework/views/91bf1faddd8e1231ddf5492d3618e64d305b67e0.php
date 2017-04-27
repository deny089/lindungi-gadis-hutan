<?php 

	$settings = App\Models\AdminSettings::first();
	
	$percentage = round($response->donations()->sum('donation') / $response->goal * 100);
	
	if( $percentage > 100 ) {
		$percentage = 100;
	} else {
		$percentage = $percentage;
	}
	
	// All Donations
	$donations = $response->donations()->orderBy('id','desc')->paginate(10);
	
	// Updates
	$updates = $response->updates()->orderBy('id','desc')->paginate(1);
	
	if( str_slug( $response->title ) == '' ) {
		$slug_url  = '';
	} else {
		$slug_url  = '/'.str_slug( $response->title );
	}

 ?>


<?php $__env->startSection('title'); ?><?php echo e($response->title.' - '); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<!-- Current locale and alternate locales -->
<meta property="og:locale" content="en_US" />
<meta property="og:locale:alternate" content="es_ES" />

<!-- Og Meta Tags -->
<link rel="canonical" href="<?php echo e(url("campaign/$response->id").'/'.str_slug($response->title)); ?>"/>
<meta property="og:site_name" content="<?php echo e($settings->title); ?>"/>
<meta property="og:url" content="<?php echo e(url("campaign/$response->id").'/'.str_slug($response->title)); ?>"/>
<meta property="og:image"
      content="<?php echo e(url('public/campaigns/large',$response->large_image)); ?>"/>

<meta property="og:title" content="<?php echo e($response->title); ?>"/>
<meta property="og:description" content="<?php echo e(str_limit($response->description, 200, '...')); ?>"/>
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:image" content="<?php echo e(url('public/campaigns/large',$response->large_image)); ?>" />
<meta name="twitter:title" content="<?php echo e($response->title); ?>" />
<meta name="twitter:description" content="<?php echo e(str_limit($response->description, 200, '...')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
      </div>
    </div>
    
<div class="container margin-bottom-40 padding-top-40">
	
	<?php if(session()->has('donation_cancel')): ?>
	<div class="alert alert-danger text-center btn-block margin-bottom-20  custom-rounded" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
			<i class="fa fa-remove myicon-right"></i> <?php echo e(trans('misc.donation_cancel')); ?>

		</div>
		
		<?php endif; ?>
						
			<?php if(session('donation_success')): ?>
	<div class="alert alert-success text-center btn-block margin-bottom-20  custom-rounded" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
			<i class="fa fa-check myicon-right"></i> <?php echo e(trans('misc.donation_success')); ?>

		</div>
		
		<?php endif; ?>

	
<!-- Col MD -->
<div class="col-md-8 margin-bottom-20"> 
	
	<div class="text-center margin-bottom-20">
		<img class="img-responsive img-rounded" style="display: inline-block;" src="<?php echo e(url('public/campaigns/large',$response->large_image)); ?>" />
</div>

<h1 class="font-default title-image none-overflow margin-bottom-20">
	 		<?php echo e($response->title); ?>

		</h1>
		
		<hr />
		
		<div class="row margin-bottom-30">
			<div class="col-md-4">
				<a class="btn btn-block btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url('campaign',$response->id).'/'.str_slug($response->title)); ?>" target="_blank"><i class="fa fa-facebook myicon-right"></i> <?php echo e(trans('misc.share_on')); ?> Facebook</a>
			</div>
			
			<div class="col-md-4">
				<a class="btn btn-twitter btn-block" href="https://twitter.com/intent/tweet?url=<?php echo e(url('campaign',$response->id)); ?>&text=<?php echo e(e( $response->title )); ?>" data-url="<?php echo e(url('campaign',$response->id)); ?>" target="_blank"><i class="fa fa-twitter myicon-right"></i> <?php echo e(trans('misc.tweet')); ?></a>
			</div>

		<div class="col-md-4">
				<a class="btn btn-google-plus btn-block" href="https://plus.google.com/share?url=<?php echo e(url('campaign',$response->id).'/'.str_slug($response->title)); ?>" target="_blank"><i class="fa fa-google-plus myicon-right"></i> <?php echo e(trans('misc.share_on')); ?> Google+</a>
			</div>
		</div>

<ul class="nav nav-tabs nav-justified margin-bottom-20">
  <li class="active"><a href="#desc" aria-controls="home" role="tab" data-toggle="tab" class="font-default"><strong><?php echo e(trans('misc.story')); ?></strong></a></li>
	 		<li><a href="#updates" aria-controls="home" role="tab" data-toggle="tab" class="font-default"><strong><?php echo e(trans('misc.updates')); ?></strong> <span class="badge update-ico"><?php echo e(number_format($updates->total())); ?></span></a></li>
</ul>

<div class="tab-content">		
		<?php if( $response->description != '' ): ?>
		<p role="tabpanel" class="tab-pane fade in active description"id="desc">
		<?php echo $response->description; ?>

		</p>
		<?php endif; ?>
		
		<p role="tabpanel" class="tab-pane fade description margin-top-30" id="updates">
		
		<?php if( $updates->total() == 0 ): ?>	
			<span class="btn-block text-center">
	    			<i class="icon-history ico-no-result"></i>
	    		</span>
			<span class="text-center btn-block"><?php echo e(trans('misc.no_results_found')); ?></span>
			
			<?php else: ?>
			
			<?php $__currentLoopData = $updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<?php echo $__env->make('includes.ajax-updates-campaign', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				
				 <?php echo e($updates->links('vendor.pagination.loadmore')); ?>

				
			<?php endif; ?>
			
		</p>
</div>
       
 </div><!-- /COL MD -->
 
 <div class="col-md-4">

<?php if( Auth::check() && Auth::user()->id == $response->user()->id && $response->finalized == 0 ): ?> 	
 	<div class="row margin-bottom-20">
 		
			<div class="col-md-12">
				<a class="btn btn-success btn-block margin-bottom-5" href="<?php echo e(url('edit/campaign',$response->id)); ?>"><?php echo e(trans('misc.edit_campaign')); ?></a>
			</div>
			
			<div class="col-md-12">
				<a class="btn btn-info btn-block margin-bottom-5" href="<?php echo e(url('update/campaign',$response->id)); ?>"><?php echo e(trans('misc.post_an_update')); ?></a>
			</div>
		
			<div class="col-md-12">
				<a href="#" class="btn btn-danger btn-block" id="deleteCampaign" data-url="<?php echo e(url('delete/campaign',$response->id)); ?>"><?php echo e(trans('misc.delete_campaign')); ?></a>
			</div>
		</div>
		<?php endif; ?>

<!-- Start Panel -->
 	<div class="panel panel-default panel-transparent">
	  <div class="panel-body">
	    <div class="media none-overflow">
			  <div class="media-center margin-bottom-5">
			      <img class="img-circle center-block" src="<?php echo e(url('public/avatar',$response->user()->avatar)); ?>" width="60" height="60" >
			  </div>
			  <div class="media-body text-center">
			  	
			    	<h4 class="media-heading">
			    		<?php echo e($response->user()->name); ?>

			    	
			    	<?php if( Auth::guest() ): ?>				    		
			    		<a href="#" title="<?php echo e(trans('misc.contact_organizer')); ?>" data-toggle="modal" data-target="#sendEmail">
			    				<i class="fa fa-envelope myicon-right"></i>
			    		</a>
			    		<?php endif; ?>
			    		</h4>
			    		
			    <small class="media-heading text-muted btn-block margin-zero"><?php echo e(trans('misc.created')); ?> <?php echo e(date('M d, Y', strtotime($response->date) )); ?></small>
			    <?php if( $response->location != '' ): ?>
			    <small class="media-heading text-muted btn-block"><i class="fa fa-map-marker myicon-right"></i> <?php echo e($response->location); ?></small>
			    <?php endif; ?>
			  </div>
			</div>
	  </div>
	</div><!-- End Panel -->
	
<?php if( $response->finalized == 0 ): ?>
 	<div class="btn-group btn-block margin-bottom-20 <?php if( Auth::check() && Auth::user()->id == $response->user()->id ): ?> display-none <?php endif; ?>">
		<a href="<?php echo e(url('donate/'.$response->id.$slug_url)); ?>" class="btn btn-main btn-lg btn-block custom-rounded">
			<?php echo e(trans('misc.donate')); ?>

			</a>
		</div>
		
		<?php else: ?>
		
		<div class="alert boxSuccess text-center btn-block margin-bottom-20  custom-rounded" role="alert">
			<i class="fa fa-check myicon-right"></i> <?php echo e(trans('misc.campaign_ended')); ?>

		</div>
		
		<?php endif; ?>
		
	<!-- Start Panel -->
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="btn-block margin-zero" style="line-height: inherit;">
				<strong class="font-default"><?php echo e($settings->currency_symbol.number_format($response->donations()->sum('donation'))); ?></strong> 
				<small><?php echo e(trans('misc.of')); ?> <?php echo e($settings->currency_symbol.number_format($response->goal)); ?> <?php echo e(strtolower(trans('misc.goal'))); ?></small>
				</h3>
				
				<span class="progress margin-top-10 margin-bottom-10">
					<span class="percentage" style="width: <?php echo e($percentage); ?>%" aria-valuemin="0" aria-valuemax="100" role="progressbar"></span>
				</span>
				
				<small class="btn-block margin-bottom-10 text-muted">
					<?php echo e($percentage); ?>% <?php echo e(trans('misc.raised')); ?> <?php echo e(trans('misc.by')); ?> <?php echo e(number_format($response->donations()->count())); ?> <?php echo e(trans_choice('misc.donation_plural',$response->donations()->count())); ?>

				</small>
				
				<?php if( $response->categories_id != '' ): ?>
				<?php if( isset( $response->category->id ) && $response->category->mode == 'on' ): ?>
				<small class="btn-block">
					<a href="<?php echo e(url('category',$response->category->slug)); ?>" title="<?php echo e($response->category->name); ?>">
						<i class="icon-tag myicon-right"></i> <?php echo e(str_limit($response->category->name, 18, '...')); ?>

						</a>
				</small>
				<?php endif; ?>
				<?php endif; ?>
										
		</div>
	</div><!-- End Panel -->
		
<ul class="list-group" id="listDonations">
       <li class="list-group-item"><i class="fa fa-clock-o myicon-right"></i> <strong><?php echo e(trans('misc.recent_donations')); ?></strong> (<?php echo e(number_format($response->donations()->count())); ?>)</li>
       
    <?php $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    
    <?php 
    $letter = str_slug(mb_substr( $donation->fullname, 0, 1,'UTF8')); 
    
	if( $letter == '' ) {
		$letter = 'N/A';
	} 
	
	if( $donation->anonymous == 1 ) {
		$letter = 'N/A';
		$donation->fullname = trans('misc.anonymous');
	}
    ?>
    
     <?php echo $__env->make('includes.listing-donations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     
       	 <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
       	 
       	 <?php if( $response->donations()->count() == 0 ): ?>
       	 <li class="list-group-item"><?php echo e(trans('misc.no_donations')); ?></li>
       	 <?php endif; ?>
       	 
       	 <?php echo e($donations->links('vendor.pagination.loadmore')); ?>

       	        	 
	</ul>

<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-hidden="true">
     		<div class="modal-dialog">
     			<div class="modal-content"> 
     				<div class="modal-header headerModal">
				        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				        
				        <h4 class="modal-title text-center" id="myModalLabel">
				        	<?php echo e(trans('misc.contact_organizer')); ?>

				        	</h4>
				     </div><!-- Modal header -->
				     
				      <div class="modal-body listWrap text-center center-block modalForm">
				    
				    <!-- form start -->
			    <form method="POST" class="margin-bottom-15" action="<?php echo e(url('contact/organizer')); ?>" enctype="multipart/form-data" id="formContactOrganizer">
			    	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			    	<input type="hidden" name="id" value="<?php echo e($response->user()->id); ?>">  	
				    
				    <!-- Start Form Group -->
                    <div class="form-group">
                    	<input type="text" required="" name="name" class="form-control" placeholder="<?php echo e(trans('users.name')); ?>">
                    </div><!-- /.form-group-->
                    
                    <!-- Start Form Group -->
                    <div class="form-group">
                    	<input type="text" required="" name="email" class="form-control" placeholder="<?php echo e(trans('auth.email')); ?>">
                    </div><!-- /.form-group-->
                    
                    <!-- Start Form Group -->
                    <div class="form-group">
                    	<textarea name="message" rows="4" class="form-control" placeholder="<?php echo e(trans('misc.message')); ?>"></textarea>
                    </div><!-- /.form-group-->
                   						
                    <!-- Alert -->
                    <div class="alert alert-danger display-none" id="dangerAlert">
							<ul class="list-unstyled text-left" id="showErrors"></ul>
						</div><!-- Alert -->

                  
                   <button type="submit" class="btn btn-lg btn-main custom-rounded" id="buttonFormSubmit"><?php echo e(trans('misc.send_message')); ?></button>
                   
                    </form>
                    
                                        <!-- Alert -->
                    <div class="alert alert-success display-none" id="successAlert">
							<ul class="list-unstyled" id="showSuccess"></ul>
						</div><!-- Alert -->


				      </div><!-- Modal body -->
     				</div><!-- Modal content -->
     			</div><!-- Modal dialog -->
     		</div><!-- Modal -->
     			
 </div><!-- /COL MD -->
 
 </div><!-- container wrap-ui -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">

$(document).on('click','#updates .loadPaginator', function(r){
	r.preventDefault();
	 $(this).remove();
			$('<a class="list-group-item text-center loadMoreSpin"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i></a>').appendTo( "#updates" );
			
			var page = $(this).attr('href').split('page=')[1];
			$.ajax({
				url: '<?php echo e(url("ajax/campaign/updates")); ?>?id=<?php echo e($response->id); ?>&page=' + page
			}).done(function(data){
				if( data ) {
					$('.loadMoreSpin').remove();
					
					$( data ).appendTo( "#updates" );
					jQuery(".timeAgo").timeago();
					Holder.run({images:".holderImage"})
				} else {
					bootbox.alert( "<?php echo e(trans('misc.error')); ?>" );
				}
				//<**** - Tooltip
			});
	});

$(document).on('click','#listDonations .loadPaginator', function(e){
			e.preventDefault();
			$(this).remove();
			//$('<li class="list-group-item position-relative spinner spinnerList loadMoreSpin"></li>').appendTo( "#listDonations" )
			$('<a class="list-group-item text-center loadMoreSpin"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i></a>').appendTo( "#listDonations" );
			
			var page = $(this).attr('href').split('page=')[1];
			$.ajax({
				url: '<?php echo e(url("ajax/donations")); ?>?id=<?php echo e($response->id); ?>&page=' + page
			}).done(function(data){
				if( data ) {
					$('.loadMoreSpin').remove();
					
					$( data ).appendTo( "#listDonations" );
					jQuery(".timeAgo").timeago();
					Holder.run({images:".holderImage"})
				} else {
					bootbox.alert( "<?php echo e(trans('misc.error')); ?>" );
				}
				//<**** - Tooltip
			});
		});
		
		<?php if( Auth::check() ): ?> 
		
$("#deleteCampaign").click(function(e) {
   	e.preventDefault();
   	   	
   	var element = $(this);
	var url     = element.attr('data-url');
	
	element.blur();
	
	swal(
		{   title: "<?php echo e(trans('misc.delete_confirm')); ?>",  
		 text: "<?php echo e(trans('misc.confirm_delete_campaign')); ?>",  
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
		
		<?php endif; ?>
		 
</script>

<?php $__env->stopSection(); ?>
<?php  session()->forget('donation_cancel')  ?>
<?php  session()->forget('donation_success')  ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>