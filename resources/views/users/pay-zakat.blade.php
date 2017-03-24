@extends('layouts.master')

@section('head')

@stop

@section('title')
    Pay Zakat
@stop

@section('content')

    {!! Form::open(['url' => '']) !!}
        <div class="form-group col-md-12">
            <label for="inputPassword1" class="col-md-2 control-label">Zakat Type</label>
            <div class="col-md-4">
                    <select class="bs-select form-control">
                        <option>Zakat Option 1</option>
                        <option>Zakat Option 2</option>
                        <option>Zakat Option 3</option>
                    </select>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="inputPassword1" class="col-md-2 control-label">Select date</label>
            <div class="col-md-4">
                <div class="input-group date date-picker" data-date="10/2012" data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months">
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
            <label for="inputPassword1" class="col-md-2 control-label">Upload Receipt</label>
            <div class="col-md-4">
                <input class="form-control green-meadow" type="file" name="fileToUpload" id="fileToUpload">
            </div>
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-transparent blue btn-circle active"> Submit </button>
        </div>
    {!! Form::close() !!}
@stop

@section('script')

@stop