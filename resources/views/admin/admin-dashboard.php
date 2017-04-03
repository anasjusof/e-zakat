@extends('layouts.master')

@section('head')

@stop

@section('title')
    Dashboard
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
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

	<div class="col-md-8">
		<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet light portlet-fit bordered">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="icon-calendar font-red"></i>
	                <span class="caption-subject font-red sbold uppercase">Zakat Histories</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                <table class="table table-hover table-light color-grey">
	                    <thead>
	                        <tr class="uppercase">
	                        	<!--<th> <input id="checkall-checkbox" type="checkbox"> </th>-->
	                            <th> # </th>
	                            <th> Username</th>
	                            <th> Email</th>
	                            <th> Zakat Type </th>
	                            <th> Date </th>
	                            <th> Receipt </th>
	                            <th> Status </th>
	                            <th> Status Approval </th>
	                        </tr>
	                    </thead>
	                    <tbody id="tbody">
	                    	<?php $count = 1; ?>
	                    	@foreach($histories as $history)
	                    	
      						<?php $currentPageTotalNumber = ($histories->currentPage() - 1) * 5; ?>
	                        <tr>
	                        	<!--<td> <input class="single-checkbox" type="checkbox" name="history_id[]" form="form_update_status" value="{{ $history->history_id }}"> </td>-->
	                            <td>{{$count + $currentPageTotalNumber}}</td>
	                            <td> {{ $history->name }}</td>
	                            <td> {{ $history->email }} </td>
	                            <td> {{ $history->zakats_id == 1 ? 'Zakat Fitrah' : 'Zakat Pendapatan' }}</td>
	                            <td> {{ $history->created_at }}</td>
	                            <td>
		                            <a class="btn btn-transparent blue btn-circle btn-sm active" href="{{ $directory.$history->filename }}" download>
		                            	Download
		                            </a>
	                            </td>
	                            <td>
	                                <span 
	                                	class="label min-width-100px
	                                	@if ($history->status == 0){{ 'label-default' }}
	                                	@elseif ($history->status == 1){{ 'label-success' }}
	                                	@else {{ 'label-danger' }}
	                                	@endif">

	                                	@if ($history->status == 0){{ 'Pending' }}
	                                	@elseif ($history->status == 1){{ 'Valid' }}
	                                	@else {{ 'Not Valid' }}
	                                	@endif

	                                </span>
	                            </td>
	                            <td>
	                            	<div class="icheck-list">
										<label class="text-green border-bottom-with-10px-padding-bottom">
											<div class="iradio_minimal-orange" style="position: relative;">
											<input type="radio" form='form_update_status' value="{{ $history->history_id }}-1" name="history[{{ $history->history_id }}]" class="icheck" style="position: absolute; opacity: 0;">
											</div> Valid
										</label>
										<label class="text-red">
											<div class="iradio_minimal-orange" style="position: relative;">
											<input type="radio" form='form_update_status' value="{{ $history->history_id }}-2" name="history[{{ $history->history_id }}]" class="icheck" style="position: absolute; opacity: 0;">
											</div> Invalid
										</label>
									</div>
	                            </td>
	                        </tr>
	                        <?php $count++ ?>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>
	        <div class="row">
	        	<div class="col-md-6">
	        		{{$histories->render()}}
	        	</div>
	        	<div class="col-md-6">
	        		<div class="pull-right">
	        			
	        			{!! Form::open(['method'=>'PATCH', 'action'=>['ZakatController@updateZakatStatus'], 'id'=>'form_update_status']) !!}
	        			<button class="btn btn-sm green updateBtn">Update Status</button>
	        		{!! Form::close() !!}
	        		</div>
	        	</div>
	        </div>
	    </div>

	    <!-- END BORDERED TABLE PORTLET-->
	</div>

	<div class="col-md-4">
		<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet light portlet-fit bordered">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="icon-calendar font-red"></i>
	                <span class="caption-subject font-red sbold uppercase">Zakat Summary</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless col-md-6">
	                <table class="table table-hover table-light color-grey">
	                    
	                </table>
	            </div>
	            <div class="table-scrollable table-scrollable-borderless col-md-6">
	                <table class="table table-hover table-light color-grey">
	                    
	                </table>
	            </div>
	            <div class="table-scrollable table-scrollable-borderless col-md-6">
	                <table class="table table-hover table-light color-grey">
	                    
	                </table>
	            </div>
	            <div class="table-scrollable table-scrollable-borderless col-md-6">
	                <table class="table table-hover table-light color-grey">
	                    
	                </table>
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