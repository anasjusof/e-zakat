@extends('layouts.master')

@section('head')

@stop

@section('title')
    e-Zakat
@stop

@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>Home<i class="fa fa-angle-right"></i>
		</li>
		<li>Zakat</li>
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
	                    	<!--
	                        <tr>
	                            <td> 1 </td>
	                            <td> Zakat Fitrah </td>
	                            <td> 03-03-2017 </td>
	                            <td> <button class="btn btn-transparent yellow-lemon btn-circle btn-sm active"> Download </button> </td>
	                            <td>
	                                <span class="label label-success"> Approved </span>
	                            </td>
	                        </tr>
							-->
							<?php $count = 1; ?>
	                        @foreach($histories as $history)
	                        <?php $currentPageTotalNumber = ($histories->currentPage() - 1) * 5; ?>
	                        <tr>
	                            <td>{{$count + $currentPageTotalNumber}}</td>
	                            <td> {{ $history->zakats_id == 1 ? 'Zakat Fitrah' : 'Zakat Pendapatan' }}</td>
	                            <td> {{ $history->created_at }}</td>
	                            <td>
		                            <a class="btn btn-transparent yellow-lemon btn-circle btn-sm active" href="{{ $directory.$history->filename }}" download>
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
	                    </tbody>
	                </table>
	            </div>
	        </div>

	        <div class="row">
	        		<div class="text-center">
	        			{{$histories->render()}}
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
	            @if(Auth::user()->roles_id == 1)
	            <a href="{{ url()->previous() }}" class="btn btn-warning pull-right">Back</a>
	            @endif
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                {!! Form::open(['method'=>'POST', 'action'=>'ZakatController@insertZakat', 'files'=>true]) !!}
	                	<div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Bank</label>
				            <div class="col-md-8">
				                    <select class="bs-select form-control input-line" name='banks_id'>
				                    	@foreach($banks as $bank)
				                        <option value="{{ $bank->id }}">{{ $bank->name }} — {{ $bank->account_number }}</option>
				                        @endforeach
				                    </select>
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Zakat Type</label>
				            <div class="col-md-8">
				                    <select class="bs-select form-control input-line" name="zakat_type" onchange="showDiv(this)">
				                        <option value="1">Zakat Fitrah</option>
				                        <option value="2">Zakat Pendapatan</option>
				                    </select>
				            </div>
				        </div>
						<div id="zakat_fitrah_ezakat">
							<div class="form-group col-md-12">
								<label for="inputPassword1" class="col-md-4 control-label">Zakat Fitrah Tahun {{ $jenisZakat->tahun }}</label>
								<div class="col-md-8">
									<input type="text" name="zakat_fitrah_upnm" class="form-control input-line" id="zakat_fitrah_upnm" value="RM {{ $jenisZakat->bayaran_zakat }}" readonly>
								</div>
							</div>
						</div>
				        <div id="zakat-pendapatan-div">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-credit-card font-red"></i>
									<span class="caption-subject font-red sbold uppercase">Maklumat Pendapatan</span>
								</div>
							</div>
							<hr>
							<div class="form-group col-md-12">
								<label for="title" class="col-sm-2 control-label">Jenis Pendapatan</label>
								<div class="col-sm-3">
									<select class="form-control" name="salaryType" id="salaryType" disabled>
										<option class="form-control" value=0>Bulanan</option>
										<!--<option class="form-control" value=1>Tahunan</option>-->
									</select>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="content" class="col-sm-2 control-label">Pendapatan</label>
								<div class="col-sm-5">
									<div class="input-group">
										<span class="input-group-addon">RM</span>
										<input type="text" class="form-control" data-fv-row=".col-sm-5" data-fv-notempty="true" data-fv-notempty-message="Sila masukkan jumlah pendapatan bulanan" data-fv-numeric="true" data-fv-numeric-message="Sila masukkan nombor sahaja" id="monthlyIncome" name="monthlyIncome" placeholder="Bulanan"/>
										<span class="input-group-addon">=</span>
										<input type="text" readonly class="form-control" id="yearlyIncome" name="yearlyIncome" placeholder="Tahunan"/>
									</div>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="content" class="col-sm-2 control-label">Pendapatan Lain</label>

								<div class="col-sm-3 has-feedback">
									<div class="input-group">
										<span class="input-group-addon">RM</span>
										<input type="text" class="form-control" data-fv-row=".col-sm-3" data-fv-numeric="true" data-fv-numeric-message="Sila masukkan nombor sahaja" id="otherIncome" name="otherIncome" placeholder="0" data-fv-field="otherIncome">
									</div><i class="form-control-feedback fv-icon-no-label fv-bootstrap-icon-input-group" data-fv-icon-for="otherIncome" style="display: none;"></i>
								<small class="help-block" data-fv-validator="numeric" data-fv-for="otherIncome" data-fv-result="NOT_VALIDATED" style="display: none;">Sila masukkan nombor sahaja</small></div>
								<span class="help-block">Bonus, Sewaan, Pencen, Hadiah. <a href="#" data-toggle="modal" data-target="#maklumatLanjut">Maklumat Lanjut...</a></span>

							</div>
							<div class="form-group col-md-12">
								<label for="content" class="col-sm-2 control-label">Jumlah Keseluruhan</label>
								<div class="col-sm-3">
									<div class="input-group">
										<span class="input-group-addon">RM</span>
										<input type="text" readonly class="form-control" name="totalIncome" id="totalIncome" placeholder="0">
									</div>
								</div>
							</div>&nbsp;&nbsp;								
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-credit-card font-red"></i>
									<span class="caption-subject font-red sbold uppercase">Jumlah Zakat Pendapatan</span>
								</div>
							</div>
							<hr>
							<div class="form-group col-md-12">
								<label for="content" class="col-sm-2 control-label">Jumlah Pendapatan Layak Di Zakat</label>
								<div class="col-sm-3">
									<div class="input-group">
										<span class="input-group-addon">RM</span>
										<input type="text" class="form-control" id="jumlah_layak_zakat" name="jumlah_layak_zakat" placeholder="0" readonly>
									</div>
								</div>

							</div>
							<div class="form-group col-md-12">
								<label for="content" class="col-sm-2 control-label">Jumlah Zakat Setahun</label>
								<div class="col-sm-3">
									<div class="input-group">
										<span class="input-group-addon">RM</span>
										<input type="text" class="form-control" id="jumlah_kiraan_zakat_tahunan" name="jumlah_kiraan_zakat_tahunan" placeholder="0" readonly>
									</div>
								</div>
								<span class="help-block">Hanya 2.5% setahun</span>
							</div>
							<div class="form-group col-md-12">
								<label for="content" class="col-sm-2 control-label">Jumlah Zakat Bulanan</label>
								<div class="col-sm-3">
									<div class="input-group">
										<span class="input-group-addon">RM</span>
										<input type="text" class="form-control" id="jumlah_kiraan_zakat_bulanan" name="jumlah_kiraan_zakat_bulanan" placeholder="0" readonly>
									</div>
								</div>
							</div>
						</div>
				        <!--
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
				        -->
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Upload Receipt</label>
				            <div class="col-md-8">
				                <input class="form-control input-line" type="file" name="receipts_image" id="fileToUpload">
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

	<!-- Modal -->
<div id="maklumatLanjut" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Pendapatan Lain - PENDAPATAN DARI SEMUA SUMBER - IAITU PENDAPATAN YANG DIPEROLEHI DARIPADA:</h4>
		</div>
		<div class="modal-body">
			<div class="panel-body">
	        	<div>
		            <ul>
		                <li>
		                    Harta Penggajian dan Upah Kerja:
		                    <ul>
		                        <li>Gaji, upah, bonus, tuntutan kerja lebih masa, gratuiti, pampasan, pencen, hadiah, anugerah, insentif, ESOS (Skim Pilihan Saham Pekerja)
		                            dan apa - apa yang bersumberkan perkhidmatan atau penggajian.
		                        </li>
		                    </ul>
		                </li>
		                <li>
		                    Hasil Kerja Bebas
		                    <ul>
		                        <li>Bayaran perkhidmatan konsultansi profesional</li>
		                        <li>Bayaran atau keuntungan projek yang diterima daripada kontraktor</li>
		                        <li>Komisyen dan 'residual income' seperti jualan insuran, takaful, unit amanah, brokeraj dan seumpamanya</li>
		                        <li>Royalti atau komisyen hasil penulisan, penerbitan, aktiviti seni dan sebagainya</li>
		                    </ul>
		                </li>
		                <li>
		                    Harta Yang Menghasilkan Pendapatan (Mustaghallat)
		                    <ul>
		                        <li>Hasil sewaan aset seperti rumah, bangunan, kenderaan, premis, peralatan dan sebagainya</li>
		                        <li>Hasil produk ternakan seperti susu, telur, madu dan sebagainya</li>
		                    </ul>
		                </li>
		                <li>
		                    Pendapatan yang tidak perlu diambil pengiraan zakat: Tuntutan lojing, tuntuan ke luar negara, tuntutan keraian, tuntutan perbatuan dan tuntutan lain-lain
		                </li>
		            </ul>
	    		</div>
	    	</div>
	  	</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
    </div>

  </div>
</div>
    
</div>
@stop

@section('script')
<script>
		document.getElementById('zakat-pendapatan-div').style.display = "none";

		function showDiv(elem){
		if(elem.value == 2)
		      document.getElementById('zakat-pendapatan-div').style.display = "block";
		if(elem.value == 2)
		      document.getElementById('zakat_fitrah_ezakat').style.display = "none";
		
		if(elem.value == 1)
		      document.getElementById('zakat-pendapatan-div').style.display = "none";
		if(elem.value == 1)
		      document.getElementById('zakat_fitrah_ezakat').style.display = "block";
		}


</script>

<script>
	$('#monthlyIncome, #otherIncome').keyup(function(){

			var pendapatan_tahunan = $('#monthlyIncome').val() * 12;

			if(!$('#otherIncome').val()){
				var pendapatan_lain = 0;
			}
			else{
				var pendapatan_lain = $('#otherIncome').val();
			}
			
			var total = parseInt(pendapatan_tahunan) + parseInt(pendapatan_lain);
			$('#yearlyIncome').val(pendapatan_tahunan);

			$('#jumlah_layak_zakat').val(total);
			$('#totalIncome').val(total);

			var zakat_setahun = (total * 0.025).toFixed(2);
			var zakat_bulanan = (zakat_setahun / 12).toFixed(2);

			$('#jumlah_kiraan_zakat_tahunan').val(zakat_setahun);
			$('#jumlah_kiraan_zakat_bulanan').val(zakat_bulanan);
			
	});
</script>

@include('errors.validation-errors')

@stop