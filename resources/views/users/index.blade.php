@extends('layouts.master')

@section('head')

@stop

@section('title')
    Users
@stop

@section('content')

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
                            <td> <button class="btn btn-transparent red btn-outline btn-circle btn-sm active"> Download </button> </td>
                            <td>
                                <span class="label label-sm label-success"> Approved </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END BORDERED TABLE PORTLET-->

@stop

@section('script')

@stop