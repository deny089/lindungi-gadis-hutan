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
            		Pohon
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
                <form class="form-horizontal" method="post" action="{{ url('panel/admin/pohon/update') }}" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="{{ csrf_token() }}">	
                	<input type="hidden" name="id_pohon" value="{{ $pohon->id_pohon }}">	
			
					@include('errors.errors-forms')
									
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nama Pohon</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $pohon->nama }}" name="nama" class="form-control" placeholder="{{ trans('admin.nama') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Harga pohon</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $pohon->harga }}" name="harga" class="form-control" placeholder="{{ trans('admin.harga') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
				  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Deskripsi</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $pohon->deskripsi }}" name="deskripsi" class="form-control" placeholder="{{ trans('admin.deskripsi') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Faktor Emisi</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $pohon->emisi }}" name="emisi" class="form-control" placeholder="{{ trans('admin.emisi') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                       
                  <div class="box-footer">
                    <a href="{{ url('panel/admin/categories') }}" class="btn btn-default">{{ trans('admin.cancel') }}</a>
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

