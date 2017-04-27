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
@extends('app')

@section('title'){{ $response->title.' - ' }}@endsection

@section('css')
<!-- Current locale and alternate locales -->
<meta property="og:locale" content="en_US" />
<meta property="og:locale:alternate" content="es_ES" />

<!-- Og Meta Tags -->
<link rel="canonical" href="{{url("campaign/$response->id").'/'.str_slug($response->title)}}"/>
<meta property="og:site_name" content="{{$settings->title}}"/>
<meta property="og:url" content="{{url("campaign/$response->id").'/'.str_slug($response->title)}}"/>
<meta property="og:image"
      content="{{url('public/campaigns/large',$response->large_image)}}"/>

<meta property="og:title" content="{{ $response->title }}"/>
<meta property="og:description" content="{{ str_limit($response->description, 200, '...') }}"/>
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:image" content="{{url('public/campaigns/large',$response->large_image)}}" />
<meta name="twitter:title" content="{{ $response->title }}" />
<meta name="twitter:description" content="{{ str_limit($response->description, 200, '...') }}"/>


@endsection

@section('content')

<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
      </div>
    </div>
    
<div class="container margin-bottom-40 padding-top-40">
	
	@if (session()->has('donation_cancel'))
	<div class="alert alert-danger text-center btn-block margin-bottom-20  custom-rounded" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
			<i class="fa fa-remove myicon-right"></i> {{ trans('misc.donation_cancel') }}
		</div>
		
		@endif
						
			@if (session('donation_success'))
	<div class="alert alert-success text-center btn-block margin-bottom-20  custom-rounded" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
			<i class="fa fa-check myicon-right"></i> {{ trans('misc.donation_success') }}
		</div>
		
		@endif

	
<!-- Col MD -->
<div class="col-md-8 margin-bottom-20"> 
	
	<div class="text-center margin-bottom-20">
		<img class="img-responsive img-rounded" style="display: inline-block;" src="{{url('public/campaigns/large',$response->large_image)}}" />
</div>

<h3 class="btn-block text-center class-montserrat margin-bottom-zero none-overflow" style="color:#495F60">
	 		{{ $response->title }}
		</h3>
		<br>
@if( $response->finalized == 0 )
	<p align="right"><a href="{{url('donate/'.$response->id.$slug_url)}}" class="btn btn-info btn-lg btn-block custom-rounded"><strong>Donasi Sekarang</strong></a></p>
@endif
<h4 class="font-default title-image none-overflow margin-bottom-20">
		Kategori : {{ $namekat }}
</h4>
@if ( $response->youtube != null )
<h5 class="font-default title-image none-overflow margin-bottom-20"><strong>
	 		{{ e('Video sebelum kampanye alam ') }}.{{ $response->title }}</strong>
		</h5>
<div class="text-center margin-bottom-20">
	<div class="videoWrapper">
    <!-- Copy & Pasted from YouTube -->
    	<iframe width="560" height="349" src="{{ $response->youtube }}" frameborder="0" allowfullscreen></iframe>
	</div>
</div>
@endif
		<hr />
@if ( $response->youtube2 != null )
<h5 class="font-default title-image none-overflow margin-bottom-20"><strong>
	 		 {{ e('Hasil kampanye alam ') }}.{{ $response->title }}.{{ e(' pada ')}}.{{ date('d-M-Y' , strtotime($response->tanggal_pelaksanaan)) }}
		</strong></h5>
<div class="text-center margin-bottom-20">
	<div class="videoWrapper">
    <!-- Copy & Pasted from YouTube -->
    	<iframe width="560" height="349" src="{{ $response->youtube2 }}" frameborder="0" allowfullscreen></iframe>
	</div>
</div>
@endif

		<hr />
		<div class="row margin-bottom-30">
			<div class="col-md-4">
				<a class="btn btn-block btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ url('campaign',$response->id).'/'.str_slug($response->title) }}" target="_blank"><i class="fa fa-facebook myicon-right"></i> {{trans('misc.share_on')}} Facebook</a>
			</div>
			
			<div class="col-md-4">
				<a class="btn btn-twitter btn-block" href="https://twitter.com/intent/tweet?url={{ url('campaign',$response->id) }}&text={{ e( $response->title ) }}" data-url="{{ url('campaign',$response->id) }}" target="_blank"><i class="fa fa-twitter myicon-right"></i> {{trans('misc.tweet')}}</a>
			</div>

		<div class="col-md-4">
				<a class="btn btn-google-plus btn-block" href="https://plus.google.com/share?url={{ url('campaign',$response->id).'/'.str_slug($response->title) }}" target="_blank"><i class="fa fa-google-plus myicon-right"></i> {{trans('misc.share_on')}} Google+</a>
			</div>
		</div>

<ul class="nav nav-tabs nav-justified margin-bottom-20">
	<li class="active"><a href="#desc" aria-controls="home" role="tab" data-toggle="tab" class="font-default"><strong>{{ trans('misc.story') }}</strong></a></li>
	<li><a href="#updates" aria-controls="home" role="tab" data-toggle="tab" class="font-default"><strong>{{ trans('misc.updates') }}</strong> <span class="badge update-ico">{{number_format($updates->total())}}</span></a></li>
	<li><a href="#pantau" aria-controls="home" role="tab" data-toggle="tab" class="font-default"><strong>Monitoring</strong></a></li>
</ul>

<div class="tab-content">		
		@if( $response->description != '' )
		<div role="tabpanel" class="tab-pane fade in active description"id="desc">
			
			@if( $response->finalized == 0 )
				<p align="right"><a href="{{url('donate/'.$response->id.$slug_url)}}" class="btn btn-info btn-lg btn-block custom-rounded"><strong>Donasi Sekarang</strong></a></p>
			@endif
			{!!$response->description!!}
			@if( $response->finalized == 0 )
				<p align="right"><a href="{{url('donate/'.$response->id.$slug_url)}}" class="btn btn-info btn-lg btn-block custom-rounded"><strong>Donasi Sekarang</strong></a></p>
			@endif
		</div>
		@endif
		
		<div role="tabpanel" class="tab-pane fade description margin-top-30" id="updates">
		
		@if( $updates->total() == 0 )	
			<span class="btn-block text-center">
	    			<i class="icon-history ico-no-result"></i>
	    		</span>
			<span class="text-center btn-block">{{ trans('misc.no_results_found') }}</span>
			
			@else
			
			@foreach( $updates as $update )
				@include('includes.ajax-updates-campaign')
				@endforeach
				
				 {{ $updates->links('vendor.pagination.loadmore') }}
				
			@endif
			
		</div>

		<div role="tabpanel" class="tab-pane fade description margin-top-30" id="pantau">
		
		@if( $pantau )	
			
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
                		
                		<img class="img-responsive thumb-responsive" style="width: 100px; height: 100px; margin:0 auto;" src="{{url('public/img/monitor/farmers.png')}}">
                		<h4 class="margin-top-zero"><center>{{ ($pantau->petani!='' ? $pantau->petani : 'N/A')  }}</center></h4>
                		<h5 class="margin-top-zero"><center>{{ ($pantau->jabatan_petani!='' ? $pantau->jabatan_petani : 'N/A')  }}</center></h5>
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
                		<img class="img-responsive thumb-responsive" style="margin:0 auto;width: 100px; height: 100px" src="{{url('public/img/monitor/pohon-hidup.png')}}">
                		<h5 class="col-sm-12 control-label"><center>Jumlah </center></h5>
                		<h4 class="control-label"><center>{{ number_format($updatespantau->hidup!=null ? $updatespantau->hidup : 0)  }}  Pohon Hidup</center></h4>
                		<br>
                	</div>
                	<div class="col-md-4">
                		<img class="img-responsive thumb-responsive" style="margin:0 auto;width: 100px; height: 100px" src="{{url('public/img/monitor/pohon-mati.png')}}">
                		<h5 class="col-sm-12 control-label"><center>Jumlah </center></h5>
                		<h4 class="control-label"><center>{{ ($updatespantau->mati!=null ? $updatespantau->mati : 0)  }} Pohon Mati</center></h4>
                		<br>
                	</div>
                	<div class="col-md-4">
                		<img  class="img-responsive thumb-responsive" style="margin:0 auto;width: 100px; height: 100px" src="{{url('public/img/monitor/diameter-pohon.png')}}">
                		<h5 class="col-sm-12 control-label"><center>Diameter Rata2</center></h5>
                		<h4 class="control-label"><center>{{ ($updatespantau->diameter!=null ? $updatespantau->diameter : 0)  }} centimeter</center></h4>
                		<br>
                	</div>
                </div>
                		<br>
                
                <div class="row margin-bottom-0"  id="outer">
                	<div class="col-md-4">
                		<img  class="img-responsive thumb-responsive" style="margin:0 auto;width: 100px; height: 100px" src="{{url('public/img/monitor/tinggipohon.png')}}">
                		<h5 class="col-sm-12 control-label"><center>Tinggi Rata2</center></h5>
                		<h4 class="control-label"><center>{{ ($updatespantau->tinggi!=null ? $updatespantau->tinggi : 0)  }} centimeter</center></h4>
                		<br>
                	</div>
                	<div class="col-md-4">
                		<img class="img-responsive thumb-responsive" style="margin:0 auto;width: 100px; height: 100px" src="{{url('public/img/monitor/waktu.png')}}">
	            		<h5 class="col-sm-12 control-label"><center>Umur Pohon</center></h5>
	            		<h4 class="control-label"><center>{{ $umur }} Hari</center></h4>
                		<br>
                	</div>
                	<div class="col-md-4">
                		<img class="img-responsive thumb-responsive" style="margin:0 auto;width: 100px; height: 100px"  src="{{url('public/img/monitor/emisionco2.png')}}">
	            		<h5 class="col-sm-12 control-label"><center>Emisi CO2 Terserap</center></h5>
	            		<h4 class="control-label"><center>{{ round($emisinya , 2)  }} Kg</center></h4>
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
            			<p class="col-sm-12">{{  $pantau->proyeksi  }}</p>
            		</div>
            		<br>
            	</div>
            	</div>


                		
                 
                 
                </form>
				 
		@else
			<span class="btn-block text-center">
	    			<i class="icon-history ico-no-result"></i>
	    		</span>
			<span class="text-center btn-block">{{ trans('misc.no_results_found') }}</span>
			
				
		@endif
			
		</div>
</div>
       
 </div><!-- /COL MD -->
 
 <div class="col-md-4">

@if( Auth::check() && Auth::user()->id == $response->user()->id  ) 	
 	<div class="row margin-bottom-20">
 		
		<div class="col-md-12">
			<a class="btn btn-success btn-block margin-bottom-5" href="{{ url('edit/campaign',$response->id) }}">{{trans('misc.edit_campaign')}}</a>
		</div>
		
		<div class="col-md-12">
			<a class="btn btn-info btn-block margin-bottom-5" href="{{ url('update/campaign',$response->id) }}">{{trans('misc.post_an_update')}}</a>
		</div>
	
		<div class="col-md-12">
			<a href="#" class="btn btn-danger btn-block" id="deleteCampaign" data-url="{{ url('delete/campaign',$response->id) }}">{{trans('misc.delete_campaign')}}</a>
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
 			@foreach(  $anggota as $relawan )
 				<tr>
 					<td style="width: 10px">{{ $no++ }}</td>
 					<?php echo '<td>'.$relawan->name.'</td>' ; ?>
 					<?php echo '<td>'.$relawan->telpon.'</td>' ; ?>
 				</tr>
 			@endforeach
 			</tbody>

 		</table>
	</div>
@endif

<!-- Start Panel -->
 	<div class="panel panel-default panel-transparent">
	  <div class="panel-body">
	    <div class="media none-overflow">
			  <div class="media-center margin-bottom-5">
			      <img class="img-circle center-block" src="{{url('public/avatar',$response->user()->avatar)}}" width="60" height="60" >
			  </div>
			  <div class="media-body text-center">
			  	
			    	<h4 class="media-heading">
			    		{{$response->user()->name}}
			    	
			    	@if( Auth::guest() )				    		
			    		<a href="#" title="{{trans('misc.contact_organizer')}}" data-toggle="modal" data-target="#sendEmail">
			    				<i class="fa fa-envelope myicon-right"></i>
			    		</a>
			    		@endif
			    		</h4>
			    		
			    <small class="media-heading text-muted btn-block margin-zero">{{trans('misc.created')}} {{ date('M d, Y', strtotime($response->date) ) }}</small>
			    @if( $response->location != '' )
			    <small class="media-heading text-muted btn-block"><i class="fa fa-map-marker myicon-right"></i> {{$response->location}}</small>
			    @endif
			  </div>
			</div>
	  </div>
	</div><!-- End Panel -->
	
@if( $response->finalized == 0 )
		<!-- edited cacip -->
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Anda bisa bergabung bersama kami dalam penanaman di kampanye ini dengang meng-klik Gabung Aksi</p>
	<div class="btn-group btn-block margin-bottom-20 @if( Auth::check() && Auth::user()->id == $response->user()->id ) display-none @endif">
	@if( $joined )
		<a href="#" class="btn btn-hover btn-lg btn-block custom-rounded" disable="disable">
			Anda Sudah Tergabung 
			</a>
	</div>
	@else
		@if(Auth::check())
		<a href="{{url('home/join')}}" class="btn btn-primary btn-lg btn-block custom-rounded ">Gabung Aksi</a>
		@else
		<a href="{{url('login')}}" class="btn btn-primary btn-lg btn-block custom-rounded ">Gabung Aksi</a>
		@endif
	@endif
		<!-- End edited cacip -->
@else
		
	<div class="text-center btn-default margin-bottom-20  custom-rounded" role="alert">
		<i class="fa fa-check myicon-right"></i> {{trans('misc.campaign_ended')}}
	</div>
		
@endif
		
	<!-- Start Panel -->
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="btn-block margin-zero" style="line-height: inherit;">
			<!-- edited cacip -->
				<strong class="font-default">{{ number_format( $jumlahdonasi ).' '.$settings->kode_pohon }}</strong> 
				<small>dari total {{strtolower(trans('misc.goal'))}} {{number_format($response->goal).' '.$settings->kode_pohon}} </small>
				</h3>
			<!-- end edited cacip -->
				<span class="progress margin-top-10 margin-bottom-10">
					<span class="percentage" style="width: {{$percentage }}%" aria-valuemin="0" aria-valuemax="100" role="progressbar"></span>
				</span>
				
				<small class="btn-block margin-bottom-10 text-muted">
					{{$percentage }} %  {{$settings->kode_pohon}} Didonasikan dari {{number_format($response->donations()->where('donations.confirmed','1')->count())}} {{trans_choice('misc.donation_plural',$response->donations()->count())}}
				</small>
				
				@if( $response->categories_id != '' )
				@if( isset( $response->category->id ) && $response->category->mode == 'on' )
				<small class="btn-block">
					<a href="{{url('category',$response->category->slug)}}" title="{{$response->category->name}}">
						<i class="icon-tag myicon-right"></i> {{str_limit($response->category->name, 18, '...') }}
						</a>
				</small>
				@endif
				@endif
										
		</div>
	</div><!-- End Panel -->

<ul class="nav nav-tabs nav-justified">
 	<li class="active"><a href="#top3" aria-controls="home" role="tab" data-toggle="tab" class="font-default"><strong>3 Donatur Terbanyak</strong></a></li>
	<li><a href="#now" aria-controls="home" role="tab" data-toggle="tab" class="font-default"><strong>Donatur Terkini</strong></a></li>
</ul>
<div class="tab-content">
	<div role="tabpanel" class="tab-pane fade in active" id="top3">
		<ul class="list-group">
		   
		    @foreach( $top3 as $top3s )
		    
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
			    
			    @include('includes.list-top3-donations') 
		     
		     @endforeach
		       	 
		</ul>
	</div>

	<div role="tabpanel" class="tab-pane fade" id="now">
		<ul class="list-group" id="listDonations">
		       
		       
		    @foreach( $donations as $donation )
		    
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
		    
		     @include('includes.listing-donations')
		     
		       	 @endforeach
		       	 
		       	 @if( $response->donations()->where('confirmed','1')->count() == 0 )
		       	 <li class="list-group-item">{{trans('misc.no_donations')}}</li>
		       	 @endif
		       	 
		       	 {{ $donations->links('vendor.pagination.loadmore') }}
		       	        	 
		</ul>
	</div>
</div>

<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-hidden="true">
     		<div class="modal-dialog">
     			<div class="modal-content"> 
     				<div class="modal-header headerModal">
				        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				        
				        <h4 class="modal-title text-center" id="myModalLabel">
				        	{{ trans('misc.contact_organizer') }}
				        	</h4>
				     </div><!-- Modal header -->
				     
				      <div class="modal-body listWrap text-center center-block modalForm">
				    
				    <!-- form start -->
			    <form method="POST" class="margin-bottom-15" action="{{ url('contact/organizer') }}" enctype="multipart/form-data" id="formContactOrganizer">
			    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
			    	<input type="hidden" name="id" value="{{ $response->user()->id }}">  	
				    
				    <!-- Start Form Group -->
                    <div class="form-group">
                    	<input type="text" required="" name="name" class="form-control" placeholder="{{ trans('users.name') }}">
                    </div><!-- /.form-group-->
                    
                    <!-- Start Form Group -->
                    <div class="form-group">
                    	<input type="text" required="" name="email" class="form-control" placeholder="{{ trans('auth.email') }}">
                    </div><!-- /.form-group-->
                    
                    <!-- Start Form Group -->
                    <div class="form-group">
                    	<textarea name="message" rows="4" class="form-control" placeholder="{{ trans('misc.message') }}"></textarea>
                    </div><!-- /.form-group-->
                   						
                    <!-- Alert -->
                    <div class="alert alert-danger display-none" id="dangerAlert">
							<ul class="list-unstyled text-left" id="showErrors"></ul>
						</div><!-- Alert -->

                  
                   <button type="submit" class="btn btn-lg btn-main custom-rounded" id="buttonFormSubmit">{{ trans('misc.send_message') }}</button>
                   
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
@endsection

@section('javascript')
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
				url: '{{ url("ajax/campaign/updates") }}?id={{$response->id}}&page=' + page
			}).done(function(data){
				if( data ) {
					$('.loadMoreSpin').remove();
					
					$( data ).appendTo( "#updates" );
					jQuery(".timeAgo").timeago();
					Holder.run({images:".holderImage"})
				} else {
					bootbox.alert( "{{trans('misc.error')}}" );
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
				url: '{{ url("ajax/campaign/updates") }}?id={{$response->id}}&page=' + page
			}).done(function(data){
				if( data ) {
					$('.loadMoreSpin').remove();
					
					$( data ).appendTo( "#pantau" );
					jQuery(".timeAgo").timeago();
					Holder.run({images:".holderImage"})
				} else {
					bootbox.alert( "{{trans('misc.error')}}" );
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
				url: '{{ url("ajax/donations") }}?id={{$response->id}}&page=' + page
			}).done(function(data){
				if( data ) {
					$('.loadMoreSpin').remove();
					
					$( data ).appendTo( "#listDonations" );
					jQuery(".timeAgo").timeago();
					Holder.run({images:".holderImage"})
				} else {
					bootbox.alert( "{{trans('misc.error')}}" );
				}
				//<**** - Tooltip
			});
		});
		
		@if( Auth::check() ) 
		
$("#deleteCampaign").click(function(e) {
   	e.preventDefault();
   	   	
   	var element = $(this);
	var url     = element.attr('data-url');
	
	element.blur();
	
	swal(
		{   title: "{{trans('misc.delete_confirm')}}",  
		 text: "{{trans('misc.confirm_delete_campaign')}}",  
		  type: "warning",   
		  showLoaderOnConfirm: true,
		  showCancelButton: true,   
		  confirmButtonColor: "#DD6B55",  
		   confirmButtonText: "{{trans('misc.yes_confirm')}}",   
		   cancelButtonText: "{{trans('misc.cancel_confirm')}}",  
		    closeOnConfirm: false,  
		    }, 
		    function(isConfirm){  
		    	 if (isConfirm) {     
		    	 	window.location.href = url;
		    	 	}
		    	 });
		    	 
		    	 
		 });
		
		@endif
		 
</script>

@php session()->forget('donation_cancel') @endphp
@php session()->forget('donation_success') @endphp


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


@endsection