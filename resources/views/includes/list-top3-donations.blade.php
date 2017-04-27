<?php 	$hashAvatar 	= md5( strtolower( trim( $top3s->email ) ) );  
		$donasi 		= $top3s->donation;
		$hargapohon 	= $response->hargapohon;
		if($donasi == 0 || $hargapohon == 0){
       		$jumlahdonasi = 0;
       	}else{
			$jumlahdonasi 	= $donasi / $hargapohon;
       	}
?>
<li class="list-group-item">
       	<div class="media">
			  <div class="media-left">
			      <img class="media-object img-circle holderImage" data-src="holder.js/40x40?bg=f45302&fg=FFFFFF&text={{strtoupper($letter)}}" width="40" height="40" alt="{{$letter}}">
			  </div>
			  <div class="media-body">
			    <h4 class="media-heading">{{$top3s->fullname}}</h4>
			    <span class="btn-block recent-donation-amount font-default">
			    	{{number_format($jumlahdonasi).'  '.$settings->kode_pohon}}
			    </span>
			    @if( $top3s->comment != '' )
			    <p class="margin-bottom-5">{{$top3s->comment}}</p>
			    @endif
			    <small class="btn-block timeAgo text-muted" data="{{ date('c', strtotime( $top3s->date )) }}"></small>
			  </div>
		</div>
</li>