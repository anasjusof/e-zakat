@extends('layouts.master')

@section('head')

<link href="../../assets/global/plugins/icheck/skins/all.css" rel="stylesheet"/>

@stop

@section('title')
    Admin - Zakat Histories
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
    
</div>
@stop

@section('script')
<script src="../../assets/global/plugins/icheck/icheck.min.js"></script>

<script src="../../assets/admin/pages/scripts/form-icheck.js"></script>

<script> FormiCheck.init();  </script>

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


@stop