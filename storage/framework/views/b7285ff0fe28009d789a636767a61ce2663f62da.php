<div class="col-xs-12 col-sm-6 col-md-3 col-thumb">
 <?php 

   $settings = App\Models\AdminSettings::first();

    //$campaign = App\Models\Campaigns::where('id', $key->id)->get();
    //$donasi_campaign = App\Models\Donations::where('campaigns_id', $key->id)->sum('donation');
    //$harga = App\Models\Campaigns::where('id', $key->id)->value('hargapohon');
    //$donasiperharga = $donasi_campaign / $harga ;
   $donasi = $key->donations()->where('confirmed','1')->sum('donation');
   $start_date = new DateTime( date("Y-m-d" , strtotime($key->tanggal_pelaksanaan)) );
   $date = new DateTime( date("Y-m-d") );
   $difference = $start_date->diff($date);
    if($start_date > $date){
        $remaining = $difference->days.' Hari Lagi';
    }elseif ($start_date == $date) {
        $remaining = 'Kampanye Berlangsung Hari ini!!';
    }elseif ($start_date < $date) {
        $remaining = 'Kampanye Telah Selesai';
    }

;

    // if ($remaining < 0 ){
    //     $remaining = 'Kampanye Telah Selesai';
    // }elseif($remaining = 0){
    //     $remaining = 'Kampanye Sedang Berlangsung';
    // }elseif($remaining > 0){
    //     $remaining = $remaining;
    // }
   $hargapohon = $key->hargapohon;
   if($donasi != 0 && $hargapohon != 0){
    $jumlahpohon = round( $donasi / $hargapohon  );
   }else {
        $jumlahpohon = 0;
   }

	if( str_slug( $key->title ) == '' ) {
		$slugUrl  = '';
	} else {
		$slugUrl  = '/'.str_slug( $key->title );
	}
	
	$url = url('campaign',$key->id).$slugUrl;
    // if($key->cat_id == 1){
	   // $percentage = round($jumlahpohon / $key->goal * 100);
    // }elseif($key->cat_id == 2){
    //     $percentage = round($jumlahpohon / $key->goalhewan * 100);
    // }else{
    //     $percentage = 0;
    // }
	if($key->goal != 0 || $jumlahpohon != 0){
        $percentage = round($jumlahpohon / $key->goal * 100);
    }else{
        $percentage = 0;
    }

	if( $percentage > 100 ) {
		$percentage = $percentage;
	} else {
		$percentage = $percentage;
	}	   

    $kategori = $key->cat_id;
    $namekat = DB::table('categories')->where('id', $kategori)->value('name');
    // if($kategori = 1){
    //     $kategori = 'Penanaman';
    // }elseif($kategori = 2){
    //     $kategori = 'Hewan';
    // }else{
    //     $kategori = 'Sampah';
    // }
    $hari = date('l', strtotime($key->tanggal_pelaksanaan));

    switch ($hari) {
        case "Sunday":
            $dina = "Minggu";
            break;
        case "Monday":
            $dina = "Senin";
            break;
        case "Tuesday":
            $dina = "Selasa";
            break;
        case "Wednesday":
            $dina = "Rabu";
            break;
        case "Thursday":
            $dina = "Kamis";
            break;
        case "Friday":
            $dina = "Jumat";
            break;
        case "Saturday":
            $dina = "Sabtu";
            break;
        default:
            $dina = " ";
    }

     $bulan = date('m', strtotime($key->tanggal_pelaksanaan));

    switch ($bulan) {
        case "1":
            $wulan = "Januari";
            break;
        case "2":
            $wulan = "Februari";
            break;
        case "3":
            $wulan = "Maret";
            break;
        case "4":
            $wulan = "April";
            break;
        case "5":
            $wulan = "Mei";
            break;
        case "6":
            $wulan = "Juni";
            break;
        case "7":
            $wulan = "Juli";
            break;
        case "8":
            $wulan = "Agustus";
            break;
        case "9":
            $wulan = "September";
            break;
        case "10":
            $wulan = "Oktober";
            break;
        case "11":
            $wulan = "November";
            break;
        case "12":
            $wulan = "Desember";
            break;
        default:
            $wulan = " ";
    }

?>
<div class="thumbnail padding-top-zero">

				<a class="position-relative btn-block img-grid" href="<?php echo e($url); ?>">
					<img title="<?php echo e(e($key->title)); ?>" src="<?php echo e(asset('public/campaigns/small').'/'.$key->small_image); ?>" class="image-url img-responsive btn-block radius-image hover" />
				</a>
    			
    			<div class="caption">
    				<h1 class="title-campaigns font-default">
    					<a title="<?php echo e(e($key->title)); ?>" class="item-link" href="<?php echo e($url); ?>">
    					 <?php echo e(e($key->title)); ?>

    					</a>
    				</h1>
                    <h5 class="desc-campaigns">
                        <a title="<?php echo e(e($key->tanggal_pelaksanaan)); ?>" class="item-link" href="<?php echo e($url); ?>">
                         <?php echo e($dina.', '.date('d', strtotime($key->tanggal_pelaksanaan)).' '.$wulan.' '.date('Y', strtotime($key->tanggal_pelaksanaan))); ?>

                        </a>
                    </h5>
                    <h5 class="title-campaigns" align="right" style=" color: #F04C4C ;">
                        <a href="<?php echo e($url); ?>"><?php echo e(e($remaining)); ?> </a>
                                         
                    </h5>
                    <h5 class="desc-campaigns" align="right" style="">
                        Kategori :  <?php echo e(e($namekat)); ?>                
                    </h5>
    			
    				<p class="desc-campaigns">
    					<?php if( isset($key->user()->id) ): ?>
    					<img src="<?php echo e(asset('public/avatar').'/'.$key->user()->avatar); ?>" width="20" height="20" class="img-circle avatar-campaign" /> <?php echo e($key->user()->name); ?>

    					<?php else: ?>
    					<img src="<?php echo e(asset('public/avatar/default.jpg')); ?>" width="20" height="20" class="img-circle avatar-campaign" /> <?php echo e(trans('misc.user_not_available')); ?>

    					<?php endif; ?>
    				</p>
    				
    				<p class="desc-campaigns text-overflow">
    					 <?php echo e(str_limit(strip_tags($key->description),100,'...')); ?>

                    <br>
                    <p align="right">
                        <a title="Read More ..." class="" href="<?php echo e($url); ?>">
                            Detail Story ..
                        </a>
                    </p>
    				</p>
    				<!-- edited cacip -->
    				<p class="desc-campaigns">
    						<span class="stats-campaigns">
                                <span class="pull-left">
                                <?php if($key->cat_id == 1): ?>
    								<strong><?php echo e(number_format( $jumlahpohon ).' '.$settings->kode_pohon); ?></strong> 
    								  Terkumpul 
                                <?php else: ?>
                                    <strong><?php echo e(number_format( $donasi ).' '.$settings->currency_symbol); ?></strong> 
                                      Terkumpul 
                                <?php endif; ?>
                                </span>


    							<span class="pull-right"><strong><?php echo e($percentage); ?>%</strong></span> 
    							</span>
	    					
	    					<span class="progress">
	    						<span class="percentage" style="width: <?php echo e($percentage); ?>%" aria-valuemin="0" aria-valuemax="100" role="progressbar"></span>
	    					</span>
    				</p>
    				                    
                    <?php if($key->cat_id == 1): ?>
                    <h6 class="margin-bottom-zero">
                        <strong><?php echo e(trans('misc.goal')); ?> <?php echo e(number_format($key->goal).' '.$settings->kode_pohon); ?></strong>
                    </h6>
                    <?php else: ?>
                    <h6 class="margin-bottom-zero">
                        <strong><?php echo e(trans('misc.goal')); ?> <?php echo e($settings->currency_symbol.' '.number_format($key->goalhewan)); ?></strong>
                    </h6>
                    <?php endif; ?>
                    <?php if($key->finalized == 0): ?>
                    <p><center><a href="<?php echo e(url('home/campaigns')); ?>" class="btn btn-info btn-md custom-rounded tombol-slider"><strong>Donasi</strong></a></a></center></p>
                    <?php else: ?>
                    <p><center><a href="<?php echo e($url); ?>" class="btn btn-default btn-sm custom-rounded tombol-slider">Pantau</center></a></p>
                    <?php endif; ?>
    				<!-- end edited cacip -->
					
    			</div><!-- /caption -->
    		  </div><!-- /thumbnail -->
    	   </div><!-- /col-sm-6 col-md-4 -->