@extends('layouts.master')

@section('head')


@stop

@section('title')
    Users
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
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
	                        	<th> <input type="checkbox"> </th>
	                            <th> # </th>
	                            <th> Username</th>
	                            <th> Email</th>
	                            <th> Zakat Type </th>
	                            <th> Date </th>
	                            <th> Receipt </th>
	                            <th> Status </th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php $count = 1; ?>
	                    	@foreach($histories as $history)
	                    	
      						<?php $currentPageTotalNumber = ($histories->currentPage() - 1) * 5; ?>
	                        <tr>
	                        	<td> <input type="checkbox"> </td>
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
	                        </tr>
	                        <?php $count++ ?>
	                        @endforeach

	                        <!--
	                        <tr>
	                            <td> 1 </td>
	                            <td> Anas Jusof</td>
	                            <td> anas@asdasd.com</td>
	                            <td> Zakat Fitrah </td>
	                            <td> 03-03-2017 </td>
	                            <td> <button class="btn btn-transparent blue btn-circle btn-sm active"> Download </button> </td>
	                            <td>
	                                <div class="mt-action-buttons ">
                                        <div class="btn-group" data-toggle="buttons">
											<label class="btn btn-default min-width-100px" style="margin:0;">
											<input type="radio" class="toggle Valid"> Valid </label>
											<label class="btn btn-default min-width-100px">
											<input type="radio" class="toggle invalid"> Invalid </label>
										</div>
                                    </div>
	                            </td>
	                        </tr>

	                        <tr>
	                            <td> 2 </td>
	                            <td> Aliff Aziz</td>
	                            <td> aliff@asdasd.com</td>
	                            <td> Zakat Fitrah </td>
	                            <td> 03-03-2017 </td>
	                            <td> <button class="btn btn-transparent blue btn-circle btn-sm active"> Download </button> </td>
	                            <td>
	                                <div class="mt-action-buttons ">
                                        <div class="btn-group" data-toggle="buttons">
											<label class="btn btn-default min-width-100px active" style="margin:0;">
											<input type="radio" class="toggle Valid"> Valid </label>
											<label class="btn btn-default min-width-100px">
											<input type="radio" class="toggle invalid"> Invalid </label>
										</div>
                                    </div>
	                            </td>
	                        </tr>

	                        <tr>
	                            <td> 3 </td>
	                            <td> Malik Noor</td>
	                            <td> maliki_nooriah@asdasd.com</td>
	                            <td> Zakat Fitrah </td>
	                            <td> 03-03-2017 </td>
	                            <td> <button class="btn btn-transparent blue btn-circle btn-sm active"> Download </button> </td>
	                            <td>
	                                <div class="mt-action-buttons ">
                                        <div class="btn-group" data-toggle="buttons">
											<label class="btn btn-default min-width-100px" style="margin:0;">
											<input type="radio" class="toggle Valid"> Valid </label>
											<label class="btn btn-default min-width-100px active">
											<input type="radio" class="toggle invalid"> Invalid </label>
										</div>
                                    </div>
	                            </td>
	                        </tr>
	                        -->
	                    </tbody>
	                </table>
	            </div>
	        </div>
	        <div class="row">
	        	<div class="col-md-6">
	        		<button class="btn btn-sm green">Update Status</button>
	        	</div>
	        	<div class="col-md-6">
	        		<div class="pull-right">
	        			{{$histories->render()}}
	        		</div>
	        	</div>
	        </div>
	    </div>

	    <!-- END BORDERED TABLE PORTLET-->
	</div>
    
</div>
@stop

@section('script')

@stop