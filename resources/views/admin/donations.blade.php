@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ trans('misc.donations') }} ({{$data->total()}})
          </h4>
     
        </section>

        <!-- Main content -->
        <section class="content">
        	 		      			    
        	<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> 
                  		{{ trans('misc.donations') }}                    		
                  	</h3>
                </div><!-- /.box-header -->
		
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
               <tbody>

               	@if( $data->total() !=  0 && $data->count() != 0 )
                   <tr>
                      <th class="active">ID</th>
                      <th class="active">{{ trans('auth.full_name') }}</th>
                      <th class="active">{{ trans_choice('misc.campaigns_plural', 1) }}</th>
                      <th class="active">{{ trans('auth.email') }}</th>
                      <th class="active">Phone</th>
                      <th class="active">{{ trans('misc.donation') }}</th>
                      <th class="active">{{ trans('admin.date') }}</th>
                      <th class="active">Konfirm</th>
                      <th class="active">{{ trans('admin.actions') }}</th>
                    </tr><!-- /.TR -->
                  
                  @foreach( $data as $donation )
                    <tr>
                      <td>{{ $donation->id }}</td>
                      <td>{{ $donation->fullname }}</td>
                      <td><a href="{{url('campaign',$donation->campaigns_id)}}" target="_blank">{{ str_limit($donation->campaigns()->title, 10, '...') }} <i class="fa fa-external-link-square"></i></a></td>
                      <td>{{ $donation->email }}</td>
                      <td>{{ $donation->phone }}</td>
                      <td>{{ $settings->currency_symbol.number_format($donation->donation) }}</td>
                      <td>{{ date('d M, y', strtotime($donation->date)) }}</td>
                      <?php
                          if($donation->confirmed == 1){
                            $konfirm = 'Sudah';
                          }else{
                            $konfirm = 'Belum';
                          }
                      ?>
                      <td>{{ $konfirm }}</td>
                      <td>  <a href="{{ url('panel/admin/donations',$donation->id) }}" class="btn btn-success btn-xs padding-btn">
                          		View / Confirm
                          	</a>
                            <a href="javascript:void(0);" data-url="{{ url('panel/admin/donations/delete/').'/'.$donation->id }}" class="btn btn-danger btn-xs padding-btn actionDelete">
                              Delete
                            </a> 
                      </td>
                    </tr><!-- /.TR -->
                    @endforeach
                    
                    @else
                    <hr />
                    	<h3 class="text-center no-found">{{ trans('misc.no_results_found') }}</h3>

                    @endif
                                        
                  </tbody>
                  
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              @if( $data->lastPage() > 1 )
             {{ $data->links() }}
             @endif
            </div>
          </div>        	
        	
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
@section('javascript')
  
<script type="text/javascript">

$(".actionDelete").click(function(e) {
    e.preventDefault();
        
    var element = $(this);
  var url     = element.attr('data-url');
  
  element.blur();
  
  swal(
    {   title: "{{trans('misc.delete_confirm')}}",  
     text: "Yakin Hapus Donasi?",  
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
</script>
@endsection