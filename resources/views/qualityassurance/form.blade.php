@extends('layouts.app')

@section('content')

<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
        </div>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
            <li><a href="{{ URL::to('qualityassurance?return='.$return) }}">{{ $pageTitle }}</a></li>
            <li class="active">{{ Lang::get('core.addedit') }} </li>
        </ul>
    </div>
    <div class="page-content-wrapper">
        <ul class="parsley-error-list">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <div class="sbox animated fadeInRight">
            <div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
            <div class="sbox-content"> 	
                {!! Form::open(array('url'=>'qualityassurance/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
                <div class="col-md-12">
                    <div id="qa-accordion" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse1">Quality Assurance</a>
                                </h4>
                            </div>
                            <div id="qa-collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="form-group  " >
                                        <div class="col-md-6">
                                            {!! Form::text('quality_assurance_id', $row['quality_assurance_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
                                        </div> 
                                        <div class="col-md-2">
                                        </div>
                                    </div> 					
                                    <div class="form-group  " >
                                        <label for="Property Id" class=" control-label col-md-4 text-left"> Property Id </label>
                                        <div class="col-md-6">
                                            {!! Form::text('property_id', $row['property_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                        </div> 
                                        <div class="col-md-2">
                                        </div>
                                    </div> 					
                                    <div class="form-group  " >
                                        <label for="Hotel Manager" class=" control-label col-md-4 text-left"> Hotel Manager </label>
                                        <div class="col-md-6">
                                            {!! Form::text('hotel_manager', $row['hotel_manager'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                        </div> 
                                        <div class="col-md-2">
                                        </div>
                                    </div> 					
                                    <div class="form-group  " >
                                        <label for="Quality Assurer" class=" control-label col-md-4 text-left"> Quality Assurer </label>
                                        <div class="col-md-6">
                                            {!! Form::text('quality_assurer', $row['quality_assurer'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div> 					
                                    <div class="form-group  " >
                                        <label for="Hotel Score" class=" control-label col-md-4 text-left"> Hotel Score </label>
                                        <div class="col-md-6">
                                            {!! Form::text('hotel_score', $row['hotel_score'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div> 					
                                    <div class="form-group  " >
                                        <label for="Date" class=" control-label col-md-4 text-left"> Date </label>
                                        <div class="col-md-6">
                                            {!! Form::text('date', $row['date'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse2">Other Fields</a>
                                </h4>
                            </div>
                            <div id="qa-collapse2" class="panel-collapse collapse">
                                <div class="panel-body">Custom Fields</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="clear:both"></div>
                <div class="form-group">
                    <label class="col-sm-4 text-right">&nbsp;</label>
                    <div class="col-sm-8">	
                        <button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
                        <button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
                        <button type="button" onclick="location.href ='{{ URL::to('qualityassurance?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
                    </div>	  
                </div> 
                {!! Form::close() !!}
            </div>
        </div>		 
    </div>	
</div>			 
<script type="text/javascript">
    $(document).ready(function () {
        $('.removeCurrentFiles').on('click', function () {
            var removeUrl = $(this).attr('href');
            $.get(removeUrl, function (response) {});
            $(this).parent('div').empty();
            return false;
        });
    });
</script>		 
@stop