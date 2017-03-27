@extends('layouts.master')

@section('head')

@stop

@section('title')
    Users
@stop

@section('content')
<div class="row">
	<div class="col-md-5">
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
	                <table class="table table-hover table-light">
	                    <thead>
	                        <tr class="uppercase">
	                            <th> # </th>
	                            <th> Zakat Type </th>
	                            <th> Date </th>
	                            <th> Receipt </th>
	                            <th> Status </th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <tr>
	                            <td> 1 </td>
	                            <td> Zakat Fitrah </td>
	                            <td> 03-03-2017 </td>
	                            <td> <button class="btn btn-transparent yellow-lemon btn-circle btn-sm active"> Download </button> </td>
	                            <td>
	                                <span class="label label-success"> Approved </span>
	                            </td>
	                        </tr>
	                    </tbody>
	                </table>
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
	                <span class="caption-subject font-red sbold uppercase">Pay Zakat</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                {!! Form::open(['url' => '']) !!}
	                	<div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Bank</label>
				            <div class="col-md-8">
				                    <select class="bs-select form-control input-line">
				                        <option>Maybank</option>
				                        <option>CIMB</option>
				                        <option>Hong Leong</option>
				                    </select>
				            </div>
				        </div>
	                	<div class="form-group col-md-12">
                            <label for="inputPassword1" class="col-md-4 control-label">Account Number</label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-info"></i>
                                    <input type="password" class="form-control input-line" id="inputPassword1"> </div>
                            </div>
                        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Zakat Type</label>
				            <div class="col-md-8">
				                    <select class="bs-select form-control input-line">
				                        <option>Zakat Option 1</option>
				                        <option>Zakat Option 2</option>
				                        <option>Zakat Option 3</option>
				                    </select>
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Select date</label>
				            <div class="col-md-8">
				                <div class="input-group date date-picker input-line" data-date="10/2012" data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months">
				                    <input type="text" class="form-control" readonly="">
				                    <span class="input-group-btn">
				                        <button class="btn default" type="button">
				                            <i class="fa fa-calendar"></i>
				                        </button>
				                    </span>
				                </div>
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Upload Receipt</label>
				            <div class="col-md-8">
				                <input class="form-control input-line" type="file" name="fileToUpload" id="fileToUpload">
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

@stop