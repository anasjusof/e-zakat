@extends('layouts.master')

@section('head')

@stop

@section('title')
    Manage Admin
@stop

@section('content')
<div class="row">
	<div class="col-md-5">
		<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet light portlet-fit bordered">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="icon-calendar font-red"></i>
	                <span class="caption-subject font-red sbold uppercase">List of Admins</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                <table class="table table-hover table-light">
	                    <thead>
	                        <tr class="uppercase">
	                        	<th> <input id="checkall-checkbox" type="checkbox"> </th>
	                            <th> # </th>
	                            <th> Admin Name </th>
	                            <th> Email </th>
	                        </tr>
	                    </thead>
	                    <tbody>
							<?php $count = 1; ?>
	                        @foreach($admins as $admin)
	                        <?php $currentPageTotalNumber = ($admins->currentPage() - 1) * 5; ?>
	                        <tr>
	                        	<td> <input class="single-checkbox" type="checkbox" name="admins_id[]" form="form_update_status" value="{{ $admin->id }}"> </td>
	                            <td>{{$count + $currentPageTotalNumber}}</td>
	                            <td> {{ $admin->name }}</td>
	                            <td> {{ $admin->email }}</td>
	                        </tr>
	                        <?php $count++ ?>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>

	        <div class="row">
	        	<div class="col-md-6">
	        		{!! Form::open(['method'=>'DELETE', 'action'=>['AdminController@adminDelete'], 'id'=>'form_update_status']) !!}
	        			<button class="btn btn-sm btn-danger">Delete</button>
	        		{!! Form::close() !!}
	        	</div>
	        	<div class="col-md-6">
	        		<div class="pull-right">
	        			{{$admins->render()}}
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
	                <span class="caption-subject font-red sbold uppercase">Create New Admin</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                {!! Form::open(['method'=>'POST', 'action'=>'AdminController@adminCreate']) !!}
	                	<div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Name</label>
				            <div class="col-md-8">
				                    <input type="text" name="name" class="form-control input-line">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Email</label>
				            <div class="col-md-8">
				                    <input type="email" name="email" class="form-control input-line">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Password</label>
				            <div class="col-md-8">
				                    <input type="password" name="password" class="form-control input-line">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Confirm Password</label>
				            <div class="col-md-8">
				                    <input type="password" name="confirm_password" class="form-control input-line">
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

@stop