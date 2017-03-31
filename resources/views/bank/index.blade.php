@extends('layouts.master')

@section('head')

@stop

@section('title')
    Manage Bank Account
@stop

@section('content')
<div class="row">
	<div class="col-md-5">
		<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet light portlet-fit bordered">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="icon-calendar font-red"></i>
	                <span class="caption-subject font-red sbold uppercase">List of Banks</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                <table class="table table-hover table-light">
	                    <thead>
	                        <tr class="uppercase">
	                        	<th> <input id="checkall-checkbox" type="checkbox"> </th>
	                            <th> # </th>
	                            <th> Bank Name </th>
	                            <th> Account Number </th>
	                        </tr>
	                    </thead>
	                    <tbody id="tbody">
							<?php $count = 1; ?>
	                        @foreach($banks as $bank)
	                        <?php $currentPageTotalNumber = ($banks->currentPage() - 1) * 5; ?>
	                        <tr>
	                        	<td> <input class="single-checkbox" type="checkbox" name="banks_id[]" form="form_update_status" value="{{ $bank->id }}"> </td>
	                            <td>{{$count + $currentPageTotalNumber}}</td>
	                            <td> {{ $bank->name }}</td>
	                            <td> {{ $bank->account_number }}</td>
	                        </tr>
	                        <?php $count++ ?>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>

	        <div class="row">
	        	<div class="col-md-6">
	        		{!! Form::open(['method'=>'DELETE', 'action'=>['BankController@deleteBank'], 'id'=>'form_update_status']) !!}
	        			<button class="btn btn-sm btn-danger deleteBtn">Delete</button>
	        		{!! Form::close() !!}
	        	</div>
	        	<div class="col-md-6">
	        		<div class="pull-right">
	        			{{$banks->render()}}
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
	                <span class="caption-subject font-red sbold uppercase">Create New Bank</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                {!! Form::open(['method'=>'POST', 'action'=>'BankController@createBank']) !!}
	                	<div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Bank</label>
				            <div class="col-md-8">
				                    <input type="text" name="name" class="form-control input-line">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Account Number</label>
				            <div class="col-md-8">
				                    <input type="text" name="account_number" class="form-control input-line">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <button class="btn btn-transparent blue btn-circle active"> Submit </button>
				        </div>
				    {!! Form::close() !!}
	            </div>
	        </div>
	    </div>
	    <!-- END BORDERED TABLE PORTLET-->
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
    });

</script>

@include('errors.error-validation-script')
@include('errors.validation-errors')

@stop