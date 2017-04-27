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
            		Laporan Masalah
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
                <form class="form-horizontal" method="post" action="{{ url('panel/admin/masalah/update') }}" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="{{ csrf_token() }}">	
                	<input type="hidden" name="id" value="{{ $masalah->id }}">	
			
					@include('errors.errors-forms')
									
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Title</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $masalah->title }}" name="title" class="form-control" disabled>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $masalah->description }}" name="description" class="form-control" disabled>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Location</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $masalah->location }}" name="location" class="form-control" disabled>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Tanggal</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $masalah->date }}" name="date" class="form-control" disabled>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Id Pelapor</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $masalah->name }}" name="name" class="form-control" disabled>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Edit Status Masalah</label>
                      <div class="col-sm-10">
                        <select name="id_status_laporan" class="form-control">
                          <option value="">Pilih Status Masalah</option>
                        @foreach(  App\Models\StatusMasalah::orderBy('id')->get() as $status )   
                            <option @if( $status->id == $masalah->id_status_laporan ) selected="selected" @endif value="{{$status->id}}">{{ $status->status }}</option>
            @endforeach
                          </select>
                      </div>
                  </div>
                  </div><!-- /.box-body -->
                  
                                    
                  <div class="box-footer">
                    <a href="{{ url('panel/admin/masalah') }}" class="btn btn-default">{{ trans('admin.cancel') }}</a>
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

