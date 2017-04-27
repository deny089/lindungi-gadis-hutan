<?php 
$settings = App\Models\AdminSettings::first(); 
$total_raised_funds = App\Models\Donations::sum('donation');
$total_campaigns    = App\Models\Campaigns::where('status','active')->count();
//edited cacip
$total_completed    = App\Models\Campaigns::where([['status','active'],['finalized','=','1']])->count();
$total_otw    = App\Models\Campaigns::where([['status','active'],['finalized','=','0']])->count();
//end edited cacip
$total_members      = App\Models\User::count();


?>

@extends('app')

@section('content')
<style>
	 @media screen and (max-width: 2560px) { /* screen size until 1200px */
	    h3 {
	        font-size: 36px; /* 1.5x default size */
	    }
		h4 {
	        font-size: 24px; /* 1.5x default size */
	    }
		.tombol-slider {
	        width	:220px;
			height	:60px;
			font-size: 25px;
	    }
	}
	@media screen and (max-width: 2000px) { /* screen size until 1200px */
	    h3 {
	        font-size: 32px; /* 1.5x default size */
	    }
		h4 {
	        font-size: 22px; /* 1.5x default size */
	    }
		.tombol-slider {
	        width	:180px;
			height	:50px;
			font-size: 23px;
	    }
	}
	@media screen and (max-width: 1200px) { /* screen size until 1000px */
	    h3 {
	        font-size: 28px; /* 1.2x default size */
	        }
		h4 {
	        font-size: 20px; /* 1.5x default size */
	    }
		.tombol-slider {
	        width	:130px;
			height	:40px;
			font-size: 20px;
	    }
	    }
	@media screen and (max-width: 800px) { /* screen size until 500px */
	    h3 {
	        font-size: 22px; /* 0.8x default size */
	        }
		h4 {
	        font-size: 16px; /* 1.5x default size */
	    }
		.tombol-slider {
	        width	:120px;
			height	:35px;
			font-size: 16px;
	    }
	    }
	@media screen and (max-width: 500px) { /* screen size until 500px */
	    h3 {
	        font-size: 16px; /* 0.8x default size */
	        }
		h4 {
	        font-size: 11px; /* 1.5x default size */
	    }
		.tombol-slider {
	        width	:100px;
			height	:30px;
			font-size: 14px;
	    }
	    }
</style>
<div class="row">
	<div class="col-md-12">
		<div class="carousel slide" id="carousel-740800">
			<ol class="carousel-indicators">
				<li class="active" data-slide-to="0" data-target="#carousel-740800">
				</li>
				<li data-slide-to="1" data-target="#carousel-740800">
				</li>
				<li data-slide-to="2" data-target="#carousel-740800">
				</li>
			</ol>
			<div class="carousel-inner">
				<div class="item active">
					<img alt="Carousel Bootstrap First" src="{{ url('public/img/header.jpg') }}" class="img-responsive" />
					<div class="carousel-caption">
						<h3  class="title-site txt-center " id="titleSite"  style="color:#ffffff;outline-width:2px; outline-color: black ">
							<strong>Gotong Royong melindungi hutan Indonesia</strong>
						</h3>
						
							<a href="{{url('home/campaigns')}}" class="btn btn-info btn-md custom-rounded tombol-slider"><strong>Donasi</strong></a>
							@if(Auth::check())
							<a href="{{url('home/join')}}" class="btn btn-primary btn-md custom-rounded tombol-slider">Gabung Aksi</a>
							@else
							<a href="{{url('login')}}" class="btn btn-primary btn-md custom-rounded tombol-slider">Gabung Aksi</a>
							@endif
						
					</div>
				</div>
				<div class="item">
					<img alt="Carousel Bootstrap Second" src="{{ url('public/img/header2.jpg') }}"  class="img-responsive" />
					<div class="carousel-caption">
						<h3  class="title-site txt-center " id="titleSite"  style="color:#ffffff;outline-width:2px; outline-color: black">
							<strong>Menghijaukan Indonesia Bersama Kami</strong>
						</h3>
						</h3>
						<p>
							
							<a href="{{url('home/campaigns')}}" class="btn btn-info btn-md custom-rounded tombol-slider"><strong>Donasi</strong></a>
							@if(Auth::check())
							<a href="{{url('home/join')}}" class="btn btn-primary btn-md custom-rounded tombol-slider">Gabung Aksi</a>
							@else
							<a href="{{url('login')}}" class="btn btn-primary btn-md custom-rounded tombol-slider">Gabung Aksi</a>
							@endif
						
						</p>
					</div>
				</div>
				<div class="item">
					<img alt="Carousel Bootstrap Third" src="{{ url('public/img/header3.jpg') }}"  class="img-responsive" />
					<div class="carousel-caption">
						<h3  class="title-site txt-center " id="titleSite"  style="color:#ffffff;outline-width:2px; outline-color: black">
							<strong>Gotong Royong Menanam Pohon</strong>
						</h3>
						</h3>
						<p>
							
							<a href="{{url('home/campaigns')}}" class="btn btn-info btn-md custom-rounded tombol-slider"><strong>Donasi</strong></a>
							@if(Auth::check())
							<a href="{{url('home/join')}}" class="btn btn-primary btn-md custom-rounded tombol-slider">Gabung Aksi</a>
							@else
							<a href="{{url('login')}}" class="btn btn-primary btn-md custom-rounded tombol-slider">Gabung Aksi</a>
							@endif
						
					</div>
				</div>
			</div> <a class="left carousel-control" href="#carousel-740800" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-740800" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
		</div>
	</div>
</div>


	<!-- edited cacip -->

@if( $data->total() != 0 )
	<div class="container margin-bottom-20">
		
			
		<div class="col-md-12 btn-block margin-bottom-20">
			<h3 class="btn-block text-center class-montserrat margin-bottom-zero none-overflow" style="color:#495F60"><strong>Proses Kampanye Alam</strong></h3>
			<h4 class="btn-block text-center class-montserrat ">{{trans('"Klik" salah satu Kampanye Alam dibawah ini untuk melakukan Donasi Pohon atau Gabung Aksi Kampanye Alam')}}</h4>
		</div>			
		
		<div class="margin-bottom-20">
			@include('includes.campaigns')
		</div>
		
					
	</div><!-- container wrap-ui -->
	
	@else
	<div class="container margin-bottom-20">
		<div class="margin-bottom-30">
			<div class="btn-block text-center margin-top-20">
	    			<i class="ion ion-speakerphone ico-no-result"></i>
	    		</div>
	    		
	    		<h3 class="margin-top-none text-center no-result no-result-mg">
	    	{{ trans('misc.no_campaigns') }}
	    	</h3>
		</div>
	</div>
	@endif
	
	
<!-- Mengapa harus kita -->
<div class="container margin-bottom-20">
	<div class="col-md-12 btn-block margin-bottom-20">
		<h3 class="btn-block text-center class-montserrat margin-bottom-zero none-overflow" style="color:#495F60"><strong>Apa yang bisa Anda Kontribusikan untuk Hutan Indonesia?</strong></h3>
		<!--<h4 class="btn-block text-center class-montserrat ">{{trans('Tunjukkan Kontribusi Anda !')}}</h4>-->
	</div>			
	<br>		
	<br>
	<div class="margin-bottom-30">
		<div class="col-md-3">
    		<img class="img-responsive thumb-responsive" style="margin:0 auto;width: 200px; height: 200px" src="{{url('public/img/mengapa/donatur.png')}}">
    		<h3 class="control-label" style="color:#495F60"><center>Donasi </center></h3>
    		<div class="col-md-11">
    			<p style="font-size: 16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Donasi untuk penghijauan Indonesia. Donasi yang Anda berikan akan menjadi bibit yang ditanam oleh Anda atau Sahabat Alam Lindungi Hutan di Area Konservasi Hutan. Proses penanaman dan monitoring perkembangan pohon yang Anda donasikan bisa Anda akses melalui website ini.</p>
    		</div>
    	</div>
    	<div class="col-md-3">
    		<img class="img-responsive thumb-responsive" style="margin:0 auto;width: 200px; height: 200px" src="{{url('public/img/mengapa/petani.png')}}">
    		<h3 class="control-label" style="color:#495F60"><center>Petani </center></h3>
    		<div class="col-md-11">
    			<p style="font-size: 16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kami membeli bibit dari Komunitas Petani dengan hasil dari donasi yang Anda berikan. Komunitas Petani yang memiliki kesamaan dalam kepedulian terhadap lingkungan dengan Kami adalah yang Kami cari. Komunitas petani akan memberikan detail kondisi terbaru dari tanaman yang Anda donasikan</p>
    		</div>
    	</div>
    	<div class="col-md-3">
    		<img  class="img-responsive thumb-responsive" style="margin:0 auto;width: 200px; height: 200px" src="{{url('public/img/mengapa/relawan.png')}}">
    		<h3 class="control-label" style="color:#495F60"><center>Sahabat Alam </center></h3>
    		<div class="col-md-11">
    			<p style="font-size: 16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sahabat Alam adalah para relawan yang bergabung aksi dan terlibat secara langsung dalam kampanye alam penghijauan bersama kami. Sebagai pilihan Anda untuk berkontribusi pada penghijauan Indonesia dengan menyumbang waktu dan tenaga Anda untuk menanam.</p>
    		</div>
    	</div>
    	<div class="col-md-3">
    		<img  class="img-responsive thumb-responsive" style="margin:0 auto;width: 200px; height: 200px" src="{{url('public/img/mengapa/akademisi.png')}}">
    		<h3 class="control-label" style="color:#495F60"><center>Akademisi </center></h3>
    		<div class="col-md-11">
    			<p style="font-size: 16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Partisipasi Akademisi dalam bidang keilmuan lingkungan sangat menyokong pundak gotong royong kami, yaitu edukasi tentang permasalahan, bencana, tragedi alam serta pentingnya penanaman dan penghijauan Indonesia sebagai solusi jangka panjang untuk anak dan cucu kita.</p>
    		</div>
    	</div>
	</div>	
</div><!-- container wrap-ui -->

	<!-- edited cacip -->
	<div class="row margin-bottom-50 ">
	<h3 class="btn-block text-center class-montserrat margin-bottom-zero none-overflow" style="color:#495F60"><strong>Statistik Saat Ini</strong></h3>
<br>
	<div class="container">
		<link href="{{ asset('public/admin/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
		<div class="col-lg-3 col-xs-6 ">
			<div class="small-box bg-yellow-active">
				<div class="inner">
					<p>Kampanye Alam Selesai</p>
					<h3><?php echo html_entity_decode( App\Helper::formatNumbersStats($total_completed) ) ?></span></h3>
				</div>
				<div class="icon">
                  <i class="ion ion-leaf"></i>
                </div>
			</div>
		</div><!-- col-md-3 .bg-red, .bg-yellow, .bg-aqua, .bg-blue, .bg-light-blue, .bg-green, .bg-navy, .bg-teal, .bg-olive, .bg-lime, .bg-orange, .bg-fuchsia, .bg-purple, .bg-maroon, .bg-black, .bg-red-active, .bg-yellow-active, .bg-aqua-active, .bg-blue-active, .bg-light-blue-active, .bg-green-active, .bg-navy-active, .bg-teal-active, .bg-olive-active, .bg-lime-active, .bg-orange-active, .bg-fuchsia-active, .bg-purple-active, .bg-maroon-active, .bg-black-active, -->
		<div class="col-lg-3 col-xs-6 ">
			<div class="small-box bg-aqua">
				<div class="inner">
					<p>Kampanye Alam Proses</p>
					<h3><?php echo html_entity_decode( App\Helper::formatNumbersStats($total_otw) ) ?></span></h3>
				</div>
				<div class="icon">
                  <i class="ion ion-speakerphone"></i>
                </div>
			</div>
		</div><!-- col-md-3 -->
		<div class="col-lg-3 col-xs-6 ">
			<div class="small-box bg-lime-active">
				<div class="inner">
					<p>Pohon Tertanam</p>
					<h3><?php echo html_entity_decode( App\Helper::formatNumbersStats($jumlahdonasi) ) ?></span></h3>
				</div>
				<div class="icon">
                  <i class="ion ion-heart"></i>
                </div>
			</div>
		</div><!-- col-md-3 -->
		<div class="col-lg-3 col-xs-6 ">
			<div class="small-box bg-orange-active">
				<div class="inner">
					<p>Sahabat alam</p>
					<h3><?php echo html_entity_decode( App\Helper::formatNumbersStats($total_members) ) ?></span></h3>
				</div>
				<div class="icon">
                  <i class="ion ion-ios-people"></i>
                </div>
			</div>
		</div><!-- col-md-3 -->
	</div>
	<br>
	<br>
	<div class="container">
		<div class="col-lg-3 col-xs-6 ">
			<div class="small-box bg-teal">
				<div class="inner">
					<p>Sampah Terkumpul</p>
					<h3><?php echo html_entity_decode( App\Helper::formatNumbersStats($sampah_terkumpul) ) ?></span></h3>
				</div>
				<div class="icon">
                  <i class="ion ion-ios-trash-outline"></i>
                </div>
			</div>
		</div><!-- col-md-3 -->
		<div class="col-lg-3 col-xs-6 ">
			<div class="small-box bg-olive">
				<div class="inner">
					<p>Panti Hewan</p>
					<h3><?php echo html_entity_decode( App\Helper::formatNumbersStats($panti_hewan) ) ?></span></h3>
				</div>
				<div class="icon">
                  <i class="ion ion-egg"></i>
                </div>
			</div>
		</div><!-- col-md-3 -->
		<div class="col-lg-3 col-xs-6 ">
			<div class="small-box bg-light-blue">
				<div class="inner">
					<p>Hewan Tertangani</p>
					<h3><?php echo html_entity_decode( App\Helper::formatNumbersStats($hewan_tertangani) ) ?></span></h3>
				</div>
				<div class="icon">
                  <i class="ion ion-ios-paw-outline"></i>
                </div>
			</div>
		</div><!-- col-md-3 -->
		<div class="col-lg-3 col-xs-6 ">
			<div class="small-box bg-teal-active">
				<div class="inner">
					<p>Laporan Masalah Alam</p>
					<h3><?php echo html_entity_decode( App\Helper::formatNumbersStats($laporan_alam) ) ?></span></h3>
				</div>
				<div class="icon">
                  <i class="ion ion-document-text"></i>
                </div>
			</div>
		</div><!-- col-md-3 -->

	</div><!-- row -->
	</div>	
	<br>
	<br>
	<br>
	<div class="container">
	<style type="text/css">
		section {
		    padding-top: 100px;
		    padding-bottom: 100px;
		}

		.quote {
		    color: rgba(0,0,0,.1);
		    text-align: center;
		    margin-bottom: 30px;
		}

		/*-------------------------------*/
		/*    Carousel Fade Transition   */
		/*-------------------------------*/

		#fade-quote-carousel.carousel {
		  padding-bottom: 60px;
		}
		#fade-quote-carousel.carousel .carousel-inner .item {
		  opacity: 0;
		  -webkit-transition-property: opacity;
		      -ms-transition-property: opacity;
		          transition-property: opacity;
		}
		#fade-quote-carousel.carousel .carousel-inner .active {
		  opacity: 1;
		  -webkit-transition-property: opacity;
		      -ms-transition-property: opacity;
		          transition-property: opacity;
		}
		#fade-quote-carousel.carousel .carousel-indicators {
		  bottom: 10px;
		}
		#fade-quote-carousel.carousel .carousel-indicators > li {
		  background-color: #e84a64;
		  border: none;
		}
		#fade-quote-carousel blockquote {
		    text-align: center;
		    border: none;
		}
		#fade-quote-carousel .profile-circle {
		    width: 100px;
		    height: 100px;
		    margin: 0 auto;
		    border-radius: 100px;
		}
	</style>
	@if($testimoni->count() != 0)
	<section id="carousel">    				
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
	                <div class="quote"><i class="fa fa-quote-left fa-4x"></i></div>
					<div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
					  <!-- Carousel indicators -->
	                  <ol class="carousel-indicators">
	                  	<li data-target="#fade-quote-carousel" data-slide-to="0" class="active"></li>
	                  @for($i=0;$i<=$testimoni->count();$i++)
					    <li data-target="#fade-quote-carousel" data-slide-to="{{ $i }}"></li>
	                  @endfor
					  </ol>
					  <!-- Carousel items -->
					  <div class="carousel-inner">
					  	<div class="active item">
	                        <div class="profile-circle" style="background-color: rgba(0,0,0,.2);">
	                        	<img style="" src="{{ asset('public/img-testimoni').'/'.$testi->gambar }}" />
	                        </div>
					    	<blockquote>
					    		<p>{{ e($testi->testimoni) }}</p>
					    	</blockquote>	
					    		<p align="right">-  {{ e($testi->nama) }}</p>
					    </div>
					  	@foreach($testimoni as $testimonis)
					    <div class="item">
	                        <div class="profile-circle" style="background-color: rgba(0,0,0,.2);">
	                        	<img style="" src="{{ asset('public/img-testimoni').'/'.$testimonis->gambar }}" />
	                        </div>
					    	<blockquote>
					    		<p>{{ e($testimonis->testimoni) }}</p>
					    	</blockquote>	
					    		<p align="right">-  {{ e($testimonis->nama) }}</p>
					    </div>
					    @endforeach
					  </div>
					</div>
				</div>							
			</div>
		</div>
	</section>
	@endif

	</div>
	
	<br>
	<br>
	
	<!-- maps -->
	<div class="container margin-bottom-40">
		<div class="margin-bottom-30">
		<h3 class="btn-block text-center class-montserrat margin-bottom-zero none-overflow" style="color:#495F60">Lokasi Pengendalian dan Pemantauan Hutan</h3>
	    	<h4 class="btn-block text-center class-montserrat">{{trans('Lihat perkembangan dan perawatan pohon anda di area konservasi lindungi hutan (klik map dibawah ini)')}}</h4>
	    	<br>
			<div id="map" style="width: 100%; height: 500px;"></div>
		</div>
	</div>

<style type="text/css">
	@media screen and (max-width: 1080px) {
	
	.thumb-responsive {
		width: 100%;
	}
	
}


/* untuk ukuran layar 700px kebawah */
@media screen and (max-width: 780px) {
	
	.thumb-responsive {
		width: auto;
	}

}

</style>
<!-- edited cacip -->

<style type="text/css">
	#outer{
	     width:90%;

		display: -webkit-flex;
		-webkit-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
		flex-direction: row;
		-ms-flex-line-pack: end;
		-webkit-align-content: flex-end;
		align-content: flex-end;
		align-items: center;
		-ms-flex-pack: distribute;
		-webkit-justify-content: space-around;
		justify-content: space-around;

	    /* Firefox */
	    display:-moz-box;
	    -moz-box-pack:center;
	    -moz-box-align:center;

	    /* Safari and Chrome */
	    display:-webkit-box;
	    -webkit-box-pack:center;
	    -webkit-box-align:center;

	 	display:flex;

	    /* W3C */
	    display:box;
	    box-pack:center;
	    box-align:center;
	    display: -ms-flexbox;
	}
	@supports (flex-wrap: wrap) { /* hide from incomplete Firefox versions */
	  .flex-container {
	    display: flex;
	  }
	#inner{
	    width:50%;
	}

</style>

<div class="col-xs-12 margin-top-40 margin-bottom-40">
<h3 class="btn-block text-center class-montserrat margin-bottom-20 none-overflow"  style="color:#495F60"><center>Partner</center></h3>
	<div class="container " id="outer">
		@foreach ( $partner as $partners )
		<div class="col-thumb col-centered  thumb-responsive" style="width: 70px;height: 70px; margin-left:10px">
			<a href="#" class="thumbnail">
				<img src="{{ asset('public/img-partner').'/'.$partners->gambar }}" title="{{ e($partners->nama) }}">
			</a>
		</div>
		@endforeach
	</div>
</div>
<!-- end edited cacip -->


<!-- edited cacip -->
<div class="row margin-bottom-50 ">
<div class="col-xs-12 margin-top-40 margin-bottom-40">
<h3 class="btn-block text-center class-montserrat margin-bottom-20 none-overflow"  style="color:#495F60"><center>Diliput Oleh:</center></h3>
	<div class="container " id="outer">
		@foreach ( $media as $medias )
		<div class="col-centered  thumb-responsive" style="width: 180px;margin-left:10px">
			<a href="{{$medias->link}}"  target="_blank" class="thumbnail"   style="border: 0px;width:180px;">
				<img src="{{ asset('public/img-media').'/'.$medias->gambar }}" title="{{ e($medias->nama) }}">
			</a>
		</div>

		@endforeach
	</div>
</div>
</div>
<!-- end edited cacip -->


@endsection

@section('javascript')
	<script src="{{ asset('public/plugins/jquery.counterup/jquery.counterup.min.js') }}"></script>
	<script src="https://maps.google.com/maps/api/js?v=3.5&key=AIzaSyCFUkpUT8OQ_2kblunHrU8tH_raZg4yOAo" type="text/javascript"></script>

	<script type="text/javascript">
    var locations = [
    	<?php
            	
            	$link = mysqli_connect("23.226.70.146", "lindungihutan_dua", "masmon123!", "lindungihutan_dua");
            	$sql_lokasi="select DISTINCT a.title, a.lat, a.lng, a.id, CONCAT('campaign/',a.id,'/',a.title) as url, 
						concat_ws(' , ', concat('Lokasi : ',a.location),concat('Judul : ',a.title), 
							case when a.cat_id = '1' then	CONCAT('Jumlah Pohon : ', floor((SELECT ifnull( (select sum(donation) from donations where donations.campaigns_id = a.id ) / (select hargapohon from campaigns where campaigns.id = a.id ) ,0) from campaigns where id = a.id)) )
									else concat('Donasi : ', (select sum(donation) from donations where donations.campaigns_id = a.id ) ) end,
							CONCAT('Jumlah Donatur : ', floor(ifnull((select count(*) from donations  WHERE campaigns_id = a.id  ),0))),
							concat('Persentasi tumbuh : ', concat(round((a.hidup / (a.hidup + a.mati) * 100),2) , ' %') )    , 
							concat('Capaian Penurunan Emisi : ', round(a.hidup * ((select emisi from pohon where id_pohon = (SELECT id_pohon from campaigns where id = a.id) ) / 100 ) * ((datediff(CURDATE(), a.tanggal_pelaksanaan))/365) * (a.perkembangan / 100) , 2 ), ' kg'))  AS popup, 
							case when a.cat_id = '1' then concat('public/img-category/', (select image from categories where id = '1')) 
								when a.cat_id = '2' then concat('public/img-category/', (select image from categories where id = '2'))
								when a.cat_id = '3' then concat('public/img-category/', (select image from categories where id = '3')) end as image
						from campaigns a, donations b  ";
            	$result=mysqli_query($link, $sql_lokasi) or die(mysqli_error());
            	while($data=mysqli_fetch_object($result)){
            		 ?>
            		    ['<?=$data->title;?>', <?=$data->lat;?>, <?=$data->lng;?>,  <?=$data->id;?>, '<?=$data->url;?>', '<?=$data->popup;?>', '<?=$data->image;?>' ],
       <?php
				}
		?>
       
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: new google.maps.LatLng(-7.8336769, 110.3846466),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var image = 'public/img/pohonicon.png';
    
    var marker, i;

    for (i = 0; i < locations.length; i++) {  

      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: locations[i][6],
        title: locations[i][5],
        url: locations[i][4]
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          window.location.href = this.url;

        }
      })(marker, i));
    }
  </script>


	<script src="{{ asset('public/plugins/jquery.counterup/waypoints.min.js') }}"></script>
	
		<script type="text/javascript">
		
		$(document).on('click','#campaigns .loadPaginator', function(r){
			r.preventDefault();
			 $(this).remove();
			 $('.loadMoreSpin').remove();
					$('<div class="col-xs-12 loadMoreSpin"><a class="list-group-item text-center"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i></a></div>').appendTo( "#campaigns" );
					
					var page = $(this).attr('href').split('page=')[1];
					$.ajax({
						url: '{{ url("ajax/campaigns") }}?page=' + page
					}).done(function(data){
						if( data ) {
							$('.loadMoreSpin').remove();
							
							$( data ).appendTo( "#campaigns" );
						} else {
							bootbox.alert( "{{trans('misc.error')}}" );
						}
						//<**** - Tooltip
					});
			});
	
		jQuery(document).ready(function( $ ) {
			$('.counter').counterUp({
			delay: 10, // the delay time in ms
			time: 1000 // the speed time in ms
			});
		});
		
		 @if (session('success_verify'))
    		swal({   
    			title: "{{ trans('misc.welcome') }}",   
    			text: "{{ trans('users.account_validated') }}",   
    			type: "success",   
    			confirmButtonText: "{{ trans('users.ok') }}" 
    			});
   		 @endif
   		 
   		 @if (session('error_verify'))
    		swal({   
    			title: "{{ trans('misc.error_oops') }}",   
    			text: "{{ trans('users.code_not_valid') }}",   
    			type: "error",   
    			confirmButtonText: "{{ trans('users.ok') }}" 
    			});
   		 @endif
		
		</script>

<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-585020448840e9d1"></script> 


@endsection

