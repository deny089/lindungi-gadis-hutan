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
            				{{ trans('admin.edit') }}
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="content">
        		
        		<div class="row">
    
        	<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('admin.edit') }}</h3>
                </div><!-- /.box-header -->
               
               
               
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{ url('panel/admin/blog/update') }}" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="{{ csrf_token() }}">	
                	<input type="hidden" name="id" value="{{ $blog->id }}">	
			
					@include('errors.errors-forms')
									
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Judul Blog</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $blog->judul }}" name="judul" class="form-control" placeholder="{{ trans('admin.nama') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Keyword</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $blog->keyword }}" name="keyword" class="form-control" placeholder="">
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
                      		<i class="glyphicon glyphicon-cloud-upload myicon-right"></i> {{ trans('misc.replace_image') }}
                      		</div>
                      	
                      <p class="help-block">{{ trans('admin.thumbnail_desc') }}</p>
                      
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

