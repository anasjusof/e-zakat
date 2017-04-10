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
	                    <tbody id="tbody">
							<?php $count = 1; ?>
	                        @foreach($admins as $admin)
	                        <?php $currentPageTotalNumber = ($admins->currentPage() - 1) * 5; ?>
	                        <tr>
	                        	<td> <input class="single-checkbox" type="checkbox" name="admins_id[]" form="form_update_status" value="{{ $admin->id }}"> </td>
	                            <td>{{$count + $currentPageTotalNumber}}</td>
	                            <td> {{ $admin->name }}</td>
	                            <td> {{ $admin->email }}</td>
	                            <td> <a href="" class="btn blue editBtn" data-toggle="modal" data-target="#editModal" data-user_id="{{ $admin->id }}" data-username="{{ $admin->name }}" data-user_email="{{ $admin->email }}" >Edit</a>
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
	        			<button class="btn btn-sm btn-danger deleteBtn">Delete</button>
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
	            <a href="{{ url()->previous() }}" class="btn btn-warning pull-right">Back</a>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                {!! Form::open(['method'=>'POST', 'action'=>'AdminController@adminCreate']) !!}
	                	<div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Name</label>
				            <div class="col-md-8">
				                    <input type="text" name="name" class="form-control input-line" id="username" value="{{ old('name') }}">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Email</label>
				            <div class="col-md-8">
				                    <input type="email" name="email" class="form-control input-line" id="email" value="{{ old('email') }}">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Password</label>
				            <div class="col-md-8">
				            		
				                    <input type="password" name="password" class="form-control input-line" id="password">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Confirm Password</label>
				            <div class="col-md-8">
				                    <input type="password" name="password_confirmation" class="form-control input-line" id="confirm_password">
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
      	{!! Form::open(['method'=>'PATCH', 'action'=>'AdminController@adminEdit']) !!}
      		<div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Name</label>
	            <div class="col-md-8">
	                    <input type="text" name="name" class="form-control input-line" id="m_username">
	            </div>
	        </div>
	        <div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Email</label>
	            <div class="col-md-8">
	                    <input type="email" name="email" class="form-control input-line" id="m_email" disabled>
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
	                    <input type="password" name="password_confirmation" class="form-control input-line">
	            </div>
	        </div>
	        <input type="hidden" name="id" id="m_user_id">
	    
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
       		$("#m_user_id").val($(this).data('user_id'));
		 	$("#m_username").val($(this).data('username'));
		 	$("#m_email").val($(this).data('user_email'));
       });

    });
</script>

@include('errors.error-validation-script')
@include('errors.validation-errors')

@stop