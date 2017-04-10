@extends('layouts.master')

@section('head')

@stop

@section('title')
    Manage Zakat Fitrah
@stop

@section('content')
<div class="row">
	<div class="col-md-5">
		<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet light portlet-fit bordered">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="icon-calendar font-red"></i>
	                <span class="caption-subject font-red sbold uppercase">Zakat Fitrah History</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                <table class="table table-hover table-light">
	                    <thead>
	                        <tr class="uppercase">
	                        	<th> <input id="checkall-checkbox" type="checkbox"> </th>
	                            <th> # </th>
	                            <th> Zakat Name </th>
	                            <th> Total Payment </th>
	                            <th> Year </th>
	                        </tr>
	                    </thead>
	                    <tbody id="tbody">
							<?php $count = 1; ?>
	                        @foreach($jenis_zakats as $jenis_zakat)
	                        <?php $currentPageTotalNumber = ( $jenis_zakats->currentPage() - 1) * 5; ?>
	                        <tr>
	                        	<td> <input class="single-checkbox" type="checkbox" name="jeniszakat_id[]" form="form_delete" value="{{ $jenis_zakat->id }}"> </td>
	                            <td> {{ $count + $currentPageTotalNumber}} </td>
	                            <td> {{ $jenis_zakat->nama_zakat }}</td>
	                            <td> {{ $jenis_zakat->bayaran_zakat }}</td>
	                            <td> {{ $jenis_zakat->tahun}}</td>
	                            <td> <a href="" class="btn blue editBtn" data-toggle="modal" data-target="#editModal" data-zakat_id="{{ $jenis_zakat->id }}" data-nama_zakat="{{ $jenis_zakat->nama_zakat }}" data-bayaran_zakat="{{ $jenis_zakat->bayaran_zakat }}"  data-tahun="{{ $jenis_zakat->tahun }}">Edit</a>
	                        </tr>
	                        <?php $count++ ?>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>

	        <div class="row">
	        	<div class="col-md-6">
	        		{!! Form::open(['method'=>'DELETE', 'action'=>['JenisZakatManagementController@deleteZakat'], 'id'=>'form_delete']) !!}
	        			<button class="btn btn-sm btn-danger deleteBtn">Delete</button>
	        		{!! Form::close() !!}
	        	</div>
	        	<div class="col-md-6">
	        		<div class="pull-right">
	        			{{ $jenis_zakats->render() }}
	        		</div>
	        	</div>
	        </div>
	    </div>
	    <!-- END BORDERED TABLE PORTLET-->
	</div>
	

    <div class="col-md-7">
    	<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet light portlet-fit bordered">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="icon-credit-card font-red"></i>
	                <span class="caption-subject font-red sbold uppercase">Add New Zakat Fitrah</span>
	            </div>
	            <a href="{{ url()->previous() }}" class="btn btn-warning pull-right">Back</a>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                {!! Form::open(['method'=>'POST', 'action'=>'JenisZakatManagementController@createZakat']) !!}
	                	<div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Zakat Name</label>
				            <div class="col-md-8">
				                    <input type="text" name="nama_zakat" class="form-control input-line" id="username" value="{{ old('nama_zakat') }}">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Total Payment ( RM )</label>
				            <div class="col-md-8">
				                    <input type="text" name="bayaran_zakat" class="form-control input-line" id="email" value="{{ old('bayaran_zakat') }}">
				            </div>
				        </div>
						<div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Year</label>
				            <div class="col-md-8">
				                    <input type="text" name="tahun" class="form-control input-line" id="tahun" value="{{ old('tahun') }}">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <button class="btn btn-transparent blue btn-circle active submitUserBtn"> Submit </button>
				        </div>
				    {!! Form::close() !!}
	            </div>
	        </div>
	    </div>
	    <!-- END BORDERED TABLE PORTLET-->
    </div>
    
</div>

<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Info</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      	{!! Form::open(['method'=>'PATCH', 'action'=>'JenisZakatManagementController@updateZakat']) !!}
      		<div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Zakat Name</label>
	            <div class="col-md-8">
	                    <input type="text" name="nama_zakat" class="form-control input-line" id="m_nama_zakat">
	            </div>
	        </div>
	        <div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Total Payment</label>
	            <div class="col-md-8">
	                    <input type="text" name="bayaran_zakat" class="form-control input-line" id="m_bayaran_zakat">
	            </div>
	        </div>
			<div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Year</label>
	            <div class="col-md-8">
	                    <input type="text" name="tahun" class="form-control input-line" id="m_tahun" >
	            </div>
	        </div>
	        <input type="hidden" name="id" id="m_zakat_id">	    
	  	</div>
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>

@stop

@section('script')

<script>
	$(document).ready(function(){
       $('#checkall-checkbox').click(function(){
            if(this.checked){
                $('.checker').find('span').addClass('checked');
                $("input.single-checkbox").prop('checked', true).show();
            }
            else{
                $('.checker').find('span').removeClass('checked');
                $("input.single-checkbox").prop('checked', false);
            }
       });

       $('.editBtn').click(function(){
       		$("#m_zakat_id").val($(this).data('zakat_id'));
		 	$("#m_nama_zakat").val($(this).data('nama_zakat'));
		 	$("#m_bayaran_zakat").val($(this).data('bayaran_zakat'));
		 	$("#m_tahun").val($(this).data('tahun'));
       });

    });
</script>

@include('errors.error-validation-script')
@include('errors.validation-errors')

@stop