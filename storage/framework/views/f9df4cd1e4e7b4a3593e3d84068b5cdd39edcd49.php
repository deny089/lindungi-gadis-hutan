<?php 

	use App\Models\Pohon;
	use App\Models\Updates;
	$settings = App\Models\AdminSettings::first();
	
	$donasi = $response->donations()->where('confirmed','1')->sum('donation');
	$hargapohon = $response->hargapohon;
	   if($donasi != 0 && $hargapohon != 0){
	    $jumlahpohon = round( $donasi / $hargapohon  );
	   }else {
	        $jumlahpohon = 0;
	   }

	if($response->goal != 0){
		//$percentage = round($response->donations()->sum('donation') / $response->goal * 100);
		$percentage = round($jumlahpohon / $response->goal * 100);
	}else{
		$percentage = 0;
	}
	
	if( $percentage > 100 ) {
		$percentage = $percentage;
	} else {
		$percentage = $percentage;
	}
	
	// All Donations
	$donations 	= $response->donations()->where('confirmed','1')->orderBy('id','desc')->paginate(10);
	$top3 		= $response->donations()->where('confirmed','1')->orderBy( 'donation','desc')->paginate(3);
	
	$kategori = $response->cat_id;
    $namekat = DB::table('categories')->where('id', $kategori)->value('name');


	// Updates
	$updates = $response->updates()->orderBy('id','desc')->paginate(1);
	//update pantau
	$updatespantau = Updates::where('campaigns_id',$response->id)->orderBy('id','desc')->firstOrFail();
	$emisi = Pohon::where('id_pohon', $response->id_pohon)->value('emisi');

	$start_date = new \DateTime( date("Y-m-d" , strtotime($response->tanggal_pelaksanaan)) );
	$date = new \DateTime( date("Y-m-d") );
	$difference = $date->diff($start_date);
	if($start_date > $date){
	    $umur = 0;
	}elseif ($start_date == $date) {
	    $umur = 0;
	}elseif ($start_date < $date) {
	    $umur = $difference->days;
	}
	
	$pohonhidup 	= $updatespantau->hidup;
	$emisi 			= $emisi;
	$perkembangan 	= $updatespantau->perkembangan;
	if($emisi != 0){
		$emisipersen 	= $emisi / 100;
		$perkembanganpersen = $perkembangan / 100;
		//$a = bcmul($pohonhidup, $emisipersen, 2);
		//$b = bcmul($a, $umur, 2);
		//$emisinya = bcmul($b, $perkembanganpersen, 2);
		$emisinya = $pohonhidup * ($emisi / 100) * ($umur / 365) * ($perkembangan / 100) ;
		//$emisinya = 2000 * 50/100 * 9 * 1 ;
	}else{
		$emisinya = 0;
	}
	
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

<h3 class="btn-block text-center class-montserrat margin-bottom-zero none-overflow" style="color:#495F60">
	 		<?php echo e($response->title); ?>

		</h3>
		<br>
<?php if( $response->finalized == 0 ): ?>
	<p align="right"><a href="<?php echo e(url('donate/'.$response->id.$slug_url)); ?>" class="btn btn-info btn-lg btn-block custom-rounded"><strong>Donasi Sekarang</strong></a></p>
<?php endif; ?>
<h4 class="font-default title-image none-overflow margin-bottom-20">
		Kategori : <?php echo e($namekat); ?>

</h4>
<?php if( $response->youtube != null ): ?>
<h5 class="font-default title-image none-overflow margin-bottom-20"><strong>
	 		<?php echo e(e('Video sebelum kampanye alam ')); ?>.<?php echo e($response->title); ?></strong>
		</h5>
<div class="text-center margin-bottom-20">
	<div class="videoWrapper">
    <!-- Copy & Pasted from YouTube -->
    	<iframe width="560" height="349" src="<?php echo e($response->youtube); ?>" frameborder="0" allowfullscreen></iframe>
	</div>
</div>
<?php endif; ?>
		<hr />
<?php if( $response->youtube2 != null ): ?>
<h5 class="font-default title-image none-overflow margin-bottom-20"><strong>
	 		 <?php echo e(e('Hasil kampanye alam ')); ?>.<?php echo e($response->title); ?>.<?php echo e(e(' pada ')); ?>.<?php echo e(date('d-M-Y' , strtotime($response->tanggal_pelaksanaan))); ?>

		</strong></h5>
<div class="text-center margin-bottom-20">
	<div class="videoWrapper">
    <!-- Copy & Pasted from YouTube -->
    	<iframe width="560" height="349" src="<?php echo e($response->youtube2); ?>" frameborder="0" allowfullscreen></iframe>
	</div>
</div>
<?php endif; ?>

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
	<li><a href="#pantau" aria-controls="home" role="tab" data-toggle="tab" class="font-default"><strong>Monitoring</strong></a></li>
</ul>

<div class="tab-content">		
		<?php if( $response->description != '' ): ?>
		<div role="tabpanel" class="tab-pane fade in active description"id="desc">
			
			<?php if( $response->finalized == 0 ): ?>
				<p align="right"><a href="<?php echo e(url('donate/'.$response->id.$slug_url)); ?>" class="btn btn-info btn-lg btn-block custom-rounded"><strong>Donasi Sekarang</strong></a></p>
			<?php endif; ?>
			<?php echo $response->description; ?>

			<?php if( $response->finalized == 0 ): ?>
				<p align="right"><a href="<?php echo e(url('donate/'.$response->id.$slug_url)); ?>" class="btn btn-info btn-lg btn-block custom-rounded"><strong>Donasi Sekarang</strong></a></p>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		
		<div role="tabpanel" class="tab-pane fade description margin-top-30" id="updates">
		
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
			
		</div>

		<div role="tabpanel" class="tab-pane fade description margin-top-30" id="pantau">
		
		<?php if( $pantau ): ?>	
			
			<span class="description margin-bottom-20 btn-block">
				<h4><strong>#Pantauan terakhir - Update Informasi 3 Bulan Sekali </strong> </h4>
				
			</span>
				<!-- form start -->
                <form class="form-horizontal" >
                	
            	<!-- div class="row">
            		<div id="highcharts"></div>
            	</div -->
				

                <div class="row margin-bottom-0" id="outer">
                	<div class="col-md-4">
                		<img src="">
                		<br>
                		<label class="col-sm-7 control-label"></label>
                		<br>
                	</div>
                	<div class="col-md-4">
                		
                		<img class="img-responsive thumb-responsive" style="width: 100px; height: 100px; margin:0 auto;" src="<?php echo e(url('public/img/monitor/farmers.png')); ?>">
                		<h4 class="margin-top-zero"><center><?php echo e(($pantau->petani!='' ? $pantau->petani : 'N/A')); ?></center></h4>
                		<h5 class="margin-top-zero"><center><?php echo e(($pantau->jabatan_petani!='' ? $pantau->jabatan_petani : 'N/A')); ?></center></h5>
                	</div>
                	<div class="col-md-4">
                		<img src="">
                		<br>
                		<label class="col-sm-7 control-label"></label>
                		<br>
                	</div>
                </div>
                		<br>

                <div class="row margin-bottom-0"  id="outer">
                	<div class="col-md-4">
                		<img class="img-responsive thumb-responsive" style="margin:0 auto;width: 100px; height: 100px" src="<?php echo e(url('public/img/monitor/pohon-hidup.png')); ?>">
                		<h5 class="col-sm-12 control-label"><center>Jumlah </center></h5>
                		<h4 class="control-label"><center><?php echo e(number_format($updatespantau->hidup!=null ? $updatespantau->hidup : 0)); ?>  Pohon Hidup</center></h4>
                		<br>
                	</div>
                	<div class="col-md-4">
                		<img class="img-responsive thumb-responsive" style="margin:0 auto;width: 100px; height: 100px" src="<?php echo e(url('public/img/monitor/pohon-mati.png')); ?>">
                		<h5 class="col-sm-12 control-label"><center>Jumlah </center></h5>
                		<h4 class="control-label"><center><?php echo e(($updatespantau->mati!=null ? $updatespantau->mati : 0)); ?> Pohon Mati</center></h4>
                		<br>
                	</div>
                	<div class="col-md-4">
                		<img  class="img-responsive thumb-responsive" style="margin:0 auto;width: 100px; height: 100px" src="<?php echo e(url('public/img/monitor/diameter-pohon.png')); ?>">
                		<h5 class="col-sm-12 control-label"><center>Diameter Rata2</center></h5>
                		<h4 class="control-label"><center><?php echo e(($updatespantau->diameter!=null ? $updatespantau->diameter : 0)); ?> centimeter</center></h4>
                		<br>
                	</div>
                </div>
                		<br>
                
                <div class="row margin-bottom-0"  id="outer">
                	<div class="col-md-4">
                		<img  class="img-responsive thumb-responsive" style="margin:0 auto;width: 100px; height: 100px" src="<?php echo e(url('public/img/monitor/tinggipohon.png')); ?>">
                		<h5 class="col-sm-12 control-label"><center>Tinggi Rata2</center></h5>
                		<h4 class="control-label"><center><?php echo e(($updatespantau->tinggi!=null ? $updatespantau->tinggi : 0)); ?> centimeter</center></h4>
                		<br>
                	</div>
                	<div class="col-md-4">
                		<img class="img-responsive thumb-responsive" style="margin:0 auto;width: 100px; height: 100px" src="<?php echo e(url('public/img/monitor/waktu.png')); ?>">
	            		<h5 class="col-sm-12 control-label"><center>Umur Pohon</center></h5>
	            		<h4 class="control-label"><center><?php echo e($umur); ?> Hari</center></h4>
                		<br>
                	</div>
                	<div class="col-md-4">
                		<img class="img-responsive thumb-responsive" style="margin:0 auto;width: 100px; height: 100px"  src="<?php echo e(url('public/img/monitor/emisionco2.png')); ?>">
	            		<h5 class="col-sm-12 control-label"><center>Emisi CO2 Terserap</center></h5>
	            		<h4 class="control-label"><center><?php echo e(round($emisinya , 2)); ?> Kg</center></h4>
                		<br>
                	</div>
                </div>
                		<br>
                
                
                <div class="row margin-bottom-0">
                <div class="col-md-12">
            		<img src="">
            		<br>
            		<div class="col-md-3">
            			<h5 class="col-sm-12">Proyeksi Kedepan	: </h5>
            		</div>
            		<div class="col-md-9">
            			<p class="col-sm-12"><?php echo e($pantau->proyeksi); ?></p>
            		</div>
            		<br>
            	</div>
            	</div>


                		
                 
                 
                </form>
				 
		<?php else: ?>
			<span class="btn-block text-center">
	    			<i class="icon-history ico-no-result"></i>
	    		</span>
			<span class="text-center btn-block"><?php echo e(trans('misc.no_results_found')); ?></span>
			
				
		<?php endif; ?>
			
		</div>
</div>
       
 </div><!-- /COL MD -->
 
 <div class="col-md-4">

<?php if( Auth::check() && Auth::user()->id == $response->user()->id  ): ?> 	
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

	<!-- list anggota -->
	<div class="row margin-bottom-20">
 		<h2>Relawan</h2>
 		<table class="table table-bordered table-hover">
 			<thead>
 				<tr  class="active">
 					<th class="info" style="width: 10px">Nomer</th>
 					<th class="info">Nama</th>
 					<th class="info">Telephone</th>
 				</tr>
 			</thead>
 			<tbody>
 			<?php $no = 1; ?>
 			<?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relawan): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
 				<tr>
 					<td style="width: 10px"><?php echo e($no++); ?></td>
 					<?php echo '<td>'.$relawan->name.'</td>' ; ?>
 					<?php echo '<td>'.$relawan->telpon.'</td>' ; ?>
 				</tr>
 			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
 			</tbody>

 		</table>
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
		<!-- edited cacip -->
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Anda bisa bergabung bersama kami dalam penanaman di kampanye ini dengang meng-klik Gabung Aksi</p>
	<div class="btn-group btn-block margin-bottom-20 <?php if( Auth::check() && Auth::user()->id == $response->user()->id ): ?> display-none <?php endif; ?>">
	<?php if( $joined ): ?>
		<a href="#" class="btn btn-hover btn-lg btn-block custom-rounded" disable="disable">
			Anda Sudah Tergabung 
			</a>
	</div>
	<?php else: ?>
		<?php if(Auth::check()): ?>
		<a href="<?php echo e(url('home/join')); ?>" class="btn btn-primary btn-lg btn-block custom-rounded ">Gabung Aksi</a>
		<?php else: ?>
		<a href="<?php echo e(url('login')); ?>" class="btn btn-primary btn-lg btn-block custom-rounded ">Gabung Aksi</a>
		<?php endif; ?>
	<?php endif; ?>
		<!-- End edited cacip -->
<?php else: ?>
		
	<div class="text-center btn-default margin-bottom-20  custom-rounded" role="alert">
		<i class="fa fa-check myicon-right"></i> <?php echo e(trans('misc.campaign_ended')); ?>

	</div>
		
<?php endif; ?>
		
	<!-- Start Panel -->
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="btn-block margin-zero" style="line-height: inherit;">
			<!-- edited cacip -->
				<strong class="font-default"><?php echo e(number_format( $jumlahdonasi ).' '.$settings->kode_pohon); ?></strong> 
				<small>dari total <?php echo e(strtolower(trans('misc.goal'))); ?> <?php echo e(number_format($response->goal).' '.$settings->kode_pohon); ?> </small>
				</h3>
			<!-- end edited cacip -->
				<span class="progress margin-top-10 margin-bottom-10">
					<span class="percentage" style="width: <?php echo e($percentage); ?>%" aria-valuemin="0" aria-valuemax="100" role="progressbar"></span>
				</span>
				
				<small class="btn-block margin-bottom-10 text-muted">
					<?php echo e($percentage); ?> %  <?php echo e($settings->kode_pohon); ?> Didonasikan dari <?php echo e(number_format($response->donations()->where('donations.confirmed','1')->count())); ?> <?php echo e(trans_choice('misc.donation_plural',$response->donations()->count())); ?>

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

<ul class="nav nav-tabs nav-justified">
 	<li class="active"><a href="#top3" aria-controls="home" role="tab" data-toggle="tab" class="font-default"><strong>3 Donatur Terbanyak</strong></a></li>
	<li><a href="#now" aria-controls="home" role="tab" data-toggle="tab" class="font-default"><strong>Donatur Terkini</strong></a></li>
</ul>
<div class="tab-content">
	<div role="tabpanel" class="tab-pane fade in active" id="top3">
		<ul class="list-group">
		   
		    <?php $__currentLoopData = $top3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top3s): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
		    
			    <?php 
				    $letter = str_slug(mb_substr( $top3s->fullname, 0, 1,'UTF8')); 
				    
					if( $letter == '' ) {
						$letter = 'N/A';
					} 
					
					if( $top3s->anonymous == 1 ) {
						$letter = 'N/A';
						$top3s->fullname = trans('misc.anonymous');
					}
			    ?>
			    
			    <?php echo $__env->make('includes.list-top3-donations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
		     
		     <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		       	 
		</ul>
	</div>

	<div role="tabpanel" class="tab-pane fade" id="now">
		<ul class="list-group" id="listDonations">
		       
		       
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
		       	 
		       	 <?php if( $response->donations()->where('confirmed','1')->count() == 0 ): ?>
		       	 <li class="list-group-item"><?php echo e(trans('misc.no_donations')); ?></li>
		       	 <?php endif; ?>
		       	 
		       	 <?php echo e($donations->links('vendor.pagination.loadmore')); ?>

		       	        	 
		</ul>
	</div>
</div>

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

$(".joinCampaign").click(function(e) {
   	e.preventDefault();
   	   	
   	var element = $(this);
	var url     = element.attr('data-url');
	
	element.blur();
	
	swal(
		{   title: "Gabung Aksi",  
		 text: "Anda yakin ingin bergabung dengan aksi ini?",  
		  type: "warning", 
		  showLoaderOnConfirm: true,  
		  showCancelButton: true,   
		  confirmButtonColor: "#DD6B55",  
		   confirmButtonText: "Yakin",   
		   cancelButtonText: "Batalkan",  
		    closeOnConfirm: false,  
		    }, 
		    function(isConfirm){  
		    	 if (isConfirm) {     
		    	 	window.location.href = url;
		    	 	}
		    	 });
		    	 
		    	 
		 });
</script>
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


$(document).on('click','#pantau .loadPaginator', function(r){
	r.preventDefault();
	 $(this).remove();
			$('<a class="list-group-item text-center loadMoreSpin"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i></a>').appendTo( "#pantau" );
			
			var page = $(this).attr('href').split('page=')[1];
			$.ajax({
				url: '<?php echo e(url("ajax/campaign/updates")); ?>?id=<?php echo e($response->id); ?>&page=' + page
			}).done(function(data){
				if( data ) {
					$('.loadMoreSpin').remove();
					
					$( data ).appendTo( "#pantau" );
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

<?php  session()->forget('donation_cancel')  ?>
<?php  session()->forget('donation_success')  ?>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5850128f397ff569a3f556e7/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script type="text/javascript">
	Highcharts.chart('highcharts', {

	    title: {
	        text: 'Grafik Pemantauan'
	    },

	    subtitle: {
	        text: 'Emisi CO2 '
	    },

	    yAxis: {
	        title: {
	            text: 'Number of Employees'
	        }
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        series: {
	            pointStart: 2010
	        }
	    },

	    series: [{
	        name: 'Installation',
	        data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
	    }, {
	        name: 'Manufacturing',
	        data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
	    }, {
	        name: 'Sales & Distribution',
	        data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
	    }, {
	        name: 'Project Development',
	        data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
	    }, {
	        name: 'Other',
	        data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
	    }]

	});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>