@extends('admin.layout')

@section('css')
<link href="{{ asset('public/plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            {{ trans('admin.admin') }} 
            	<i class="fa fa-angle-right margin-separator"></i> 
            		Blogs
            			<i class="fa fa-angle-right margin-separator"></i> 
            				{{ trans('misc.add_new') }}
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="content">
        		
        		<div class="row">
    
        	<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('misc.add_new') }}</h3>
                </div><!-- /.box-header -->
               
               
               
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{ url('panel/admin/blog/add') }}" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="{{ csrf_token() }}">	
			
					@include('errors.errors-forms')
									
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Judul Blog</label>
                      <div class="col-sm-10">
                        <input type="text" value="judul" name="judul" class="form-control" placeholder="Masukan judul dari Blog">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Isi Blog</label>
                      <div class="col-sm-10">
                        <input type="text" value="isi" name="isi" class="form-control" placeholder="Masukan isi dari Blog">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Isi Blog</label>
                      <div class="col-sm-10">
                        <textarea name="isi" rows="4" id="isi" class="form-control tinymce-txt" placeholder="Masukan isi dari Blog"></textarea>
                      </div>
                    </div>
                  </div>
                  
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Keyword</label>
                      <div class="col-sm-10">
                        <input type="text" value="keyword" name="keyword" class="form-control" placeholder="Masukan keyword yang berhubungan dengan Blog">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Gambar tema Blog untuk ditampilkan</label>
                      <div class="col-sm-10">
                      	<div class="btn btn-info box-file">
                      		<input type="file" accept="image/*" name="gambar" />
                      		<i class="glyphicon glyphicon-cloud-upload myicon-right"></i> {{ trans('misc.upload') }}
                      	</div>
                      	
                        <p class="help-block">direkomendasikan berukuran 400 x 400</p>
                      
                        <div class="btn-default btn-lg btn-border btn-block pull-left text-left display-none fileContainer">
                          <i class="glyphicon glyphicon-paperclip myicon-right"></i>
                          <small class="myicon-right file-name-file"></small> <i class="icon-cancel-circle delete-attach-file-2 pull-right" title="{{ trans('misc.delete') }}"></i>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    <a href="{{ url('panel/admin/blog') }}" class="btn btn-default">{{ trans('admin.cancel') }}</a>
                    <button type="submit" class="btn btn-success pull-right">{{ trans('admin.save') }}</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
        			        		
        		</div><!-- /.row -->
        		
        	</div><!-- /.content -->
        	
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection

@section('javascript')
<script src="{{ asset('public/plugins/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
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
      height: 250,
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