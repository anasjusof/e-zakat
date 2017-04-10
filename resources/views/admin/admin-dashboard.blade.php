@extends('layouts.master')

@section('head')

@stop

@section('title')
    Dashboard
@stop

@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>Home<i class="fa fa-angle-right"></i>
		</li>
		<li>Dashboard</li>
	</ul>
	<div class="page-toolbar">
		<div class="pull-right tooltips btn btn-fit-height grey-gallery">
			<i class="icon-calendar"></i>&nbsp;
			<?php 
				$dt = Carbon\Carbon::now(); 
				setlocale(LC_TIME, '');
				echo $dt->formatLocalized('%A') . ' — '; 
			?>

			{{Carbon\Carbon::now()->format('d-m-Y')}} 

			<span id="clock">&nbsp;</span>


		</div>
	</div>
</div>
<div class="row">
		<div class="col-md-12">
		<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet light portlet-fit bordered">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="icon-calendar font-red"></i>
	                <span class="caption-subject font-red sbold uppercase">Zakat Summary</span>
	            </div>
	        </div>
	        <div class="portlet-body">
		        <div class="row">
	        		<div class="col-md-12"> <a href="{{ route('admin.showApproval') }}" class="btn green-turquoise pull-right margin-bottom-15px circle">Zakat History</a> </div>
		            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat blue-madison">
							<div class="visual">
								<i class="fa fa-area-chart"></i>
							</div>
							<div class="details">
								<div class="number">
									 {{ count($totals) }}
								</div>
								<div class="desc">
									 Total Zakat
								</div>
							</div>
						</div>
					</div>
		            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat grey-salsa">
							<div class="visual">
								<i class="fa fa-refresh"></i>
							</div>
							<div class="details">
								<div class="number">
									 {{ count($pendings) }}
								</div>
								<div class="desc">
									 Pending
								</div>
							</div>
						</div>
					</div>
		            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat green-haze">
							<div class="visual">
								<i class="fa fa-check-square-o"></i>
							</div>
							<div class="details">
								<div class="number">
									 {{ count($valids) }}
								</div>
								<div class="desc">
									 Approved / Valid zakat
								</div>
							</div>
						</div>
					</div>
		            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat red-intense">
							<div class="visual">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="details">
								<div class="number">
									 {{ count($rejects) }}
								</div>
								<div class="desc">
									 Reject / Invalid zakat
								</div>
							</div>
						</div>
					</div>
				</div>
	        </div>
	    </div>

	    <!-- END BORDERED TABLE PORTLET-->
	</div>

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
	        <div class="col-md-12"> <a href="{{ route('admin.management') }}" class="btn green-turquoise pull-right margin-bottom-15px circle">Admin Management</a> </div>
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
	

    <div class="col-md-6">
		<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet light portlet-fit bordered">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="icon-calendar font-red"></i>
	                <span class="caption-subject font-red sbold uppercase">List of Banks</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	        <div class="col-md-12"> <a href="{{ route('bank.index') }}" class="btn green-turquoise pull-right margin-bottom-15px circle">Bank Management</a> </div>
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