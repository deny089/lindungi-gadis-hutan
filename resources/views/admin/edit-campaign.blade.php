@extends('admin.layout')

@section('css')
<link href="{{ asset('public/plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
@endsection
<style>
      #map {
        height: 100%;
        border: 1px solid #DDD; 
        width:600px;
        height: 300px;
        float:left;  
        margin: 0px 0 0 10px;
        -webkit-box-shadow: #AAA 0px 0px 15px;
      }
      
    </style>
    <script src="https://maps.google.com/maps/api/js?v=3.5&key=AIzaSyCFUkpUT8OQ_2kblunHrU8tH_raZg4yOAo" type="text/javascript"></script>
@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            {{ trans('admin.admin') }} 
            	<i class="fa fa-angle-right margin-separator"></i> 
            		{{ trans('admin.edit') }}
            		
            		<i class="fa fa-angle-right margin-separator"></i> 
            		{{ $data->title }}
            		
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="content">
        		
       <div class="row">
       	
       	<div class="col-md-9">
    
        	<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('admin.edit') }}</h3>
                </div><!-- /.box-header -->
               
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ url('panel/admin/campaigns/edit/'.$data->id) }}" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
			
					@include('errors.errors-forms')
									
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('misc.campaign_title') }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $data->title }}" name="title" class="form-control" placeholder="{{ trans('misc.title') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <!-- category tadinya disini -->
                  <!-- /.box-body -->
                 
                  @if($data->cat_id = 1)
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('misc.campaign_goal') }}</label>
                      <div class="col-sm-10">
                        <input type="number" min="1" autocomplete="off" value="{{ $data->goal }}" name="goal" class="form-control onlyNumber" placeholder="{{ trans('misc.campaign_goal') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  @elseif($data->cat_id = 2)
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('misc.campaign_goal') }}</label>
                      <div class="col-sm-10">
                        <input type="number" min="1" autocomplete="off" value="{{ $data->goalhewan }}" name="goalhewan" class="form-control onlyNumber" placeholder="{{ trans('misc.campaign_goal') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  @endif
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('misc.location') }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $data->location }}" name="location" class="form-control " placeholder="{{ trans('misc.location') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
          <!-- /.form-group-->
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Pilih Pohon untuk ditanam</label>
                      <div class="col-sm-10">
                        <select name="id_pohon" class="form-control">
                          <option value="">Pilih Salah Satu Pohon</option>
                        @foreach(  App\Models\Pohon::orderBy('id_pohon')->get() as $pohon )   
                            <option @if( $pohon->id_pohon == $data->id_pohon ) selected="selected" @endif value="{{$pohon->id_pohon}}">{{ $pohon->nama }}</option>
                        @endforeach
                          </select>
                        </div>
                  </div>
                  </div><!-- /.box-body -->

                  <!-- youtube -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Link Embed Youtube</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $data->youtube }}" name="youtube" class="form-control " placeholder="masukan link embeded youtube">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- youtube -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Link Embed Youtube Hasil Penanaman</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $data->youtube2 }}" name="youtube2" class="form-control " placeholder="masukan link embeded youtube">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('misc.campaign_description') }}</label>
                      <div class="col-sm-10">
                        <textarea name="description" rows="5" id="description" class="form-control  tinymce-txt" placeholder="{{ trans('misc.campaign_description_placeholder') }}">{{ $data->description }}</textarea>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('admin.status') }}</label>
                      <div class="col-sm-10">
                        <select name="finalized" class="form-control" >
                      		<option @if($data->finalized == '0') selected="selected" @endif value="0">{{trans('admin.active')}}</option>
                      		<option @if($data->finalized == '1') selected="selected" @endif value="1">{{trans('misc.finalized')}}</option>
                          </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- map -->
                   <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Maps Lokasi</label>
                      <div  class="col-sm-10 " id="map"></div>
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Latitude</label>
                      <div class="col-sm-10">
                      <input type="text" value="{{ $data->lat }}"  class="form-control " name="lat" id="lat"  placeholder="{{ $data->lat }}">
                      </div>
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Longitude</label>
                      <div class="col-sm-10">
                      <input type="text" value="{{ $data->lng }}"  class="form-control " name="lng" id="lng"  placeholder="{{ $data->lng }}">
                      </div>
                    </div>
                  </div>
                  <!-- end map -->

                  @if( Auth::user()->role == 'admin')
                  <!-- Start Box Body -->
                  <div class="box-body">
          <!-- /.form-group-->
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Publish?</label>
                      <div class="col-sm-10">
                        <select name="publish" class="form-control">
                          <option @if($data->publish == '0') selected="selected" @endif value="0">Tidak Di Publish</option>
                          <option @if($data->publish == '1') selected="selected" @endif value="1">Publish </option>
                        </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  @endif
                  
                  <div class="box-footer">
                  	 <a href="{{ url('panel/admin/campaigns') }}" class="btn btn-default">{{ trans('admin.cancel') }}</a>
                    <button type="submit" class="btn btn-success pull-right">{{ trans('admin.save') }}</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
              
        </div><!-- /. col-md-9 -->
        
        <div class="col-md-3">
        	
        	<div class="block-block text-center">
        		<img src="{{asset('public/campaigns/small').'/'.$data->small_image}}" class="thumbnail img-responsive">
        	</div>
		
		<div class="block-block text-center">
		{!! Form::open([
			            'method' => 'POST',
			            'url' => 'panel/admin/campaign/delete',
			            'class' => 'displayInline'
				        ]) !!}
				        {!! Form::hidden('id',$data->id ); !!}
	            	{!! Form::submit(trans('misc.delete_campaign'), ['class' => 'btn btn-lg btn-danger btn-block margin-bottom-10 actionDelete']) !!}
	        	{!! Form::close() !!}
	        </div>
		
		</div><!-- col-md-3 -->        			        		
        		
        		</div><!-- /.row -->
        		
        	</div><!-- /.content -->
        	
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection

@section('javascript')
	
	<!-- icheck -->
	<script src="{{ asset('public/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/plugins/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
	<script type="text/javascript" src="{{ asset('public/js/lokasi.js') }}" ></script>
 
    

	<script type="text/javascript">
		
		$(document).ready(function() {
    $(".onlyNumber").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

$(".actionDelete").click(function(e) {
   	e.preventDefault();
   	   	
   	var element = $(this);
	var id     = element.attr('data-url');
	var form    = $(element).parents('form');
	
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
		    	 	form.submit(); 
		    	 	//$('#form' + id).submit();
		    	 	}
		    	 });
		    	 
		    	 
		 });
		 
		//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });
        
        		function initTinymce() {
			tinymce.remove('.tinymce-txt');		
tinymce.init({
  selector: '.tinymce-txt',
  relative_urls: false,
  resize: true,
  menubar:false,
    statusbar: false,
    forced_root_block : false,
    extended_valid_elements : "span[!class]", 
    //visualblocks_default_state: true,
  setup: function(editor){
  	        
    	editor.on('change',function(){
    		editor.save();
    	});
   },   
  theme: 'modern',
  height: 150,
  plugins: [
    'advlist autolink autoresize lists link image charmap preview hr anchor pagebreak', //image
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save code contextmenu directionality', //
    'emoticons template paste textcolor colorpicker textpattern ' //imagetools
  ],
  toolbar1: 'undo redo | bold italic underline strikethrough charmap | bullist numlist  | link | image',
  image_advtab: true,
 });
 
}

initTinymce();	
	
	</script>
	

@endsection
