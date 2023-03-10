@extends('layouts.app')

@section('content')

<link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<style>

</style>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"> Dashboard </a></li>
        <li class="active">{{ $pageTitle }}</li>
      </ul>
	  
    </div>
 	<div class="page-content-wrapper">
		<div id="formerrors"></div>
	@if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
			
	<div class="block-content">
		<ul class="nav nav-tabs" >
			@if(!empty($tabss))
				@foreach($tabss as $key=>$val)
					<li  @if($key == $active) class="active" @endif><a href="{{URL::to('properties_settings/'.$pid.'/'.$key)}}"> {{ $val->tab_name }}  </a></li>
				@endforeach
			@endif
		</ul>
		
	<div class="tab-content m-t">
	  <div class="tab-pane active use-padding" id="types">	
		<div class="sbox  "> 
			<div class="sbox-title">@if(!empty($property_data)) {{$property_data->property_name}} @endif <a href="{{URL::to('properties/update/'.$pid)}}" class="tips btn btn-xs btn-primary pull-right" title="" data-original-title="Property Management"><i class="fa fa-edit"></i>&nbsp;Property Management</a></div>
				<div class="sbox-content calendar"> 
					{{--*/ $days_start = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 5, date("Y"))); 
						   $days_end = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") + 20, date("Y")));
					/*--}}
					<form id="cal-dates" method="POST">
						<div class="controls">
							<section>
								<div class="control-group no-grow">
									<button id="calendar-show-button" type="button" onclick="find_reservation_dates();"><i class="fa fa-repeat" style=""></i></button>
								</div>

								<div class="control-group">
									<button onclick="dateOffset('prev');" type="button"><i class="fa fa-caret-left"></i></button>
									<input id="cal-start" name="cal-start" type="text" class="date hasDatepicker" value="{{$days_start}}">
									<input id="cal-end" name="cal-end" type="text" class="date hasDatepicker" value="{{$days_end}}">
									<button onclick="dateOffset('next');" type="button"><i class="fa fa-caret-right"></i></button>
								</div>
							</section>
							
							<section>
								<div class="control-group tools">
									<button type="button" onclick="dateOffset('week');">Week</button>
									<button type="button" onclick="dateOffset('month');">Month</button>
								</div>
							</section>

							<section>
								<div class="control-group">
									<select name="cal-room-type" id="cal-room-type" onchange="find_reservation_dates();">
										<option value="all">Show all</option>
										@if(!empty($cat_types))
											@foreach($cat_types as $typec)
												<option value="{{$typec['data']->id}}">{{$typec['data']->category_name}}</option>
											@endforeach
										@endif
									</select>

									<select name="cal-coloring" onchange="find_reservation_dates();">
										<option value="1">Color by Room</option>
										<option value="2" selected="">Color by Source</option>
									</select>
								</div>
							</section>

							<section>
								<div class="control-group tools">
									<button type="button" onclick="calStartUnavail()" title="New Out of Order">
										<img src="https://app.base7booking.com/images/icons/construction.png">
									</button>
									<button type="button" onclick="calStartPrice()" title="ADR">
										<img src="https://app.base7booking.com/images/icons/money.png">
									</button>
									<button type="button" onclick="calSplit()" title="Split">
										<img style="height: 16px" src="https://app.base7booking.com/images/icons/cut.png">
									</button>
									<button type="button" onclick="v1.openRestrictions()" title="Restrictions">
										<img style="height: 16px" src="https://app.base7booking.com/images/restriction.png">
									</button>
									<button type="button" onclick="v1.openCustomPrice()" title="Custom Price">
										<img style="height: 16px" src="https://app.base7booking.com/images/yield.png">
									</button>
								</div>
							</section>

							<section>
								<button type="button" class="b7 info new-reservation" title="New Reservation">New Reservation</button>
							</section>
						</div>
					</form>
					<div style="margin-left: 150px; ; height: 13px; border-bottom: none;"></div>
					<div class="row no_border ">
						<div class="cols first white_border_left"></div>
						<div class="datcalendartop">
							
						</div>
						<div class="clr"></div>
					</div>
					
					<div id="catrooms">					
						@if(!empty($cat_types))
							@foreach($cat_types as $typec)
								@if(array_key_exists('rooms', $typec))
								{{--*/ $tp=20; /*--}}
									@foreach($typec['rooms'] as $typeroom)
										<div class="row first">
											 <div class="cols first right_border_gray">
												<span class="room_number">{{$typeroom->room_name}}</span> 
												<span class="room_name">
													<span class="room_title">{{$typec['data']->cat_short_name}} </span>
													<img  class="status_red" src="https://app.base7booking.com/images/icons/broom.png" > </span>
												<div class="clr"></div>
											</div>
											 <div class="cols right_border_gray"></div>
											 <div class="cols right_border_gray"></div>
											 <div class="cols right_border_gray weekend_days"></div>
											 <div class="cols right_border_gray weekend_days"></div>
											 <div class="clr"></div>
										</div>
										{{--*/ $tp = $tp+20; /*--}}
									@endforeach
								@endif
							@endforeach
						@endif
					</div>
					
					<div class="row last empty_row">
					</div>
					<div class="row no_border ">
						<div class="cols first white_border_left"></div>
						<div class="datcalendarbottom">
							
						</div>
						<div class="clr"></div>
					</div>
					<div class="separate_row">
					</div>
					
					<div class="row no_border">
						<div class="cols first white_border_left" >Guset</div>
						<div class="cols top_border_black bottom_border_black left_border_black ">0</div>
						<div class="cols top_border_black bottom_border_black left_border_black">0</div>
						<div class="cols top_border_black bottom_border_black left_border_black ">0</div>
						<div class="cols top_border_black bottom_border_black left_border_black right_border_black  ">0</div>
						<div class="clr"></div>
					</div>
					<div class="row no_border">
						<div class="cols first white_border_left">Room Available</div>
						<div class="cols bottom_border_black left_border_black ">7</div>
						<div class="cols bottom_border_black left_border_black">7</div>
						<div class="cols bottom_border_black left_border_black ">7</div>
						<div class="cols bottom_border_black left_border_black right_border_black  ">7</div>
						<div class="clr"></div>
					</div>
				</div>
			</div>	 
		</div>
	  </div>
	</div>	
</div>

<!-- Reservation model -->
<div class="modal fade" id="newreserve" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel"></h4>
	  </div>
	  <div id="reserforms">
		<input type="hidden" name="chkin" id="chkin" value="">
		<input type="hidden" name="chkout" id="chkout" value="">
		<input type="hidden" name="roomid" id="roomid" value="">  
	  </div>
	</div>
  </div>
</div>
<input type="hidden" id="startid" value="">
<input type="hidden" id="endid" value="">
<style>
	.cursor{cursor:col-resize;}
	.selectedCell{background:pink;}
	.optionbox {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
		padding: 8px;
		cursor: pointer;
		background-color: #eee;
		border-radius: 3px;
		border: 1px solid #dadada;
		line-height: 18px;
		display: inline-block;
	}
</style>
<script>

$(document).ready(function () {
	
	$(document).on('click', '.btn', function (){
		 var frmid = $(this).parents('form.add_new_reserve_setup').attr('id');
		  $('#'+frmid).validate({
			submitHandler: function (form) {
				 save_reserve_forms_data(frmid);
				 return false; // required to block normal submit since you used ajax
			 }
		 });
	 });
	 
	 
	 $(document).on('click', '#catrooms .scell', function (){
		var clickcell = $(this);
		var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
		var cdate = clickcell.attr('data-date');
		var cnum = clickcell.attr('data-cell-number');
		var roomid = clickcell.parents('.row').attr('data-roomid');
		var roomname = clickcell.parents('.row').attr('data-roomname');
		var roomcat = clickcell.parents('.row').attr('data-roomcat');
		var srartdateform = JSON.parse(cdate);
		var chkin = srartdateform.year+'-'+srartdateform.month+'-'+srartdateform.date;
		var enddate = startdate = chkindate = chkoutdate = '';
		if($('#startid').val()!='')
		{
			$('#endid').val(cnum);
			if($('#startid').val()>cnum)
			{
				var startdateval = $('#chkin').val();
				$('#chkin').val(chkin);
				$('#chkout').val(startdateval);
				chkindate = chkin;
				chkoutdate = startdateval;
				enddate = new Date(startdateval);
				startdate = new Date(chkin);
			}
			else
			{
				$('#chkout').val(chkin);
				var startdateval = $('#chkin').val();
				chkindate = startdateval;
				chkoutdate = chkin;
				startdate = new Date(startdateval);
				enddate = new Date(chkin);
			}
			var headingt = roomname+' '+roomcat+' / '+startdate.getDate()+' '+ monthNames[startdate.getMonth()]+' - '+enddate.getDate()+' '+ monthNames[enddate.getMonth()]+' '+enddate.getFullYear();
			$('#myModalLabel').html(headingt);
			
			newclientForm(chkindate,chkoutdate,roomid);
			$('#newreserve').modal('show');
		}
		else{
			$('#startid').val(cnum);
			$('#catrooms .row').removeClass('active');
			clickcell.parents('.row').addClass('active');
			$('#roomid').val(roomid);
			$('#chkin').val(chkin);
		}
			
		
	 });
	 
	 $(document).on('mouseover', '#catrooms .active .scell', function (){
		$( this ).addClass('selectedCell');
	});
	
	$(document).on('click', '.new-reservation', function (){
		$('.scell').addClass('cursor');
		$('.scell').removeClass('selectedCell');
	});
	
	find_reservation_dates();
});

	function newclientForm(chkin,chkout,roomid)
	{
		if(chkin!='' && chkout!='' && roomid!='')
		{
			var clintfrm = '';
			clintfrm += '<form class="columns" id="addclient" method="post">';
			clintfrm += '<input type="hidden" name="chkin" id="chkin" value="'+chkin+'">';
			clintfrm += '<input type="hidden" name="chkout" id="chkout" value="'+chkout+'">';
			clintfrm += '<input type="hidden" name="roomid" id="roomid" value="'+roomid+'">';
			clintfrm += '<input type="hidden" name="property_id" value="{{$pid}}">';
			clintfrm += '<input type="hidden" name="actionName" value="client">';
			clintfrm += '<div class="modal-body">';
			clintfrm += '<fieldset>';
			clintfrm += '<div class="form-group row">';
			clintfrm += '<div class="col-md-4">';
			clintfrm += '<label>Title</label>';
			clintfrm += '<div class="field-input">';
			clintfrm += '<select name="title" style="width: 100%; padding:5px;">';
			clintfrm += '<option></option>';
			clintfrm += '<option value="Mr">Mr</option>';
			clintfrm += '<option value="Ms">Ms</option>';
			clintfrm += '<option value="Mrs">Mrs</option>';
			clintfrm += '</select>';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '<div class="col-md-4"></div>';
			clintfrm += '<div class="col-md-4">';
			clintfrm += '<button type="button" class="b7 small info mbot float-right" onclick="open_searchClient_form(\'addclient\');"><i class="fa fa-search"></i> Search Client</button>';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '<div class="form-group row">';
			clintfrm += '<div class="col-md-4">';
			clintfrm += '<label>Company</label>';
			clintfrm += '<div class="field-input">';
			clintfrm += '<input name="company" class="form-control" type="text" value="" required="required">';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '<div class="form-group row">';
			clintfrm += '<div class="col-md-4">';
			clintfrm += '<label>Firstname</label>';
			clintfrm += '<div class="field-input">';
			clintfrm += '<input name="firstname" class="form-control" type="text" value="" required="required">';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '<div class="col-md-4">';
			clintfrm += '<label>Lastname</label>';
			clintfrm += '<div class="field-input">';
			clintfrm += '<input name="lastname" class="form-control" type="text" value="">';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '<div class="form-group row">';
			clintfrm += '<div class="col-md-4">';
			clintfrm += '<label>Email</label>';
			clintfrm += '<div class="field-input">';
			clintfrm += '<input name="email" class="form-control" type="email" value="">';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '<div class="col-md-4">';
			clintfrm += '<label>Cellphone</label>';
			clintfrm += '<div class="field-input">';
			clintfrm += '<input name="cellphone" class="form-control" type="text" value="">';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '<div class="form-group row">';
			clintfrm += '<div class="col-md-7">';
			clintfrm += '<label>Country</label>';
			clintfrm += '<div class="field-input">';
			clintfrm += '<input name="country" class="form-control" type="text" value="" >';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '<div class="form-group row">';
			clintfrm += '<div class="col-md-12">';
			clintfrm += '<label>Comment</label>';
			clintfrm += '<div class="field-input">';
			clintfrm += '<textarea id="book-comment" name="comment" style="width: 100%; height: 60px; box-sizing: border-box"></textarea>';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '</div>';
			clintfrm += '</fieldset>';
			clintfrm += '</div>';
			clintfrm += '<div class="modal-footer">';
			clintfrm += '<button type="submit" class="btn btn-primary" onclick="open_booking_form(\'addclient\');" >OK</button>';
			clintfrm += '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
			clintfrm += '</div>';
			clintfrm += '</form>';
			$('#reserforms').html(clintfrm);
		}
	}
	
	function open_searchClient_form(form_id)
	{
		if(form_id!='')
		{
			var chkin = $('#'+form_id+' input[name="chkin"]').val();
			var chkout = $('#'+form_id+' input[name="chkout"]').val();
			var roomid = $('#'+form_id+' input[name="roomid"]').val();
			
			var searchclientfrm = '';
			searchclientfrm += '<form class="columns search_client_setup" id="searchClient" method="post">';
			searchclientfrm += '<input type="hidden" name="chkin" id="chkin" value="'+chkin+'">';
			searchclientfrm += '<input type="hidden" name="chkout" id="chkout" value="'+chkout+'">';
			searchclientfrm += '<input type="hidden" name="roomid" id="roomid" value="'+roomid+'">';
			searchclientfrm += '<input type="hidden" name="property_id" value="{{$pid}}">';
			searchclientfrm += '<div class="modal-body">';
			searchclientfrm += '<fieldset>';
			searchclientfrm += '<div class="form-group row">';
			searchclientfrm += '<div class="col-md-4">';
			searchclientfrm += '<label>Search Clients</label>';
			searchclientfrm += '<div class="field-input">';
			searchclientfrm += '<input type="text" name="searchclient" value="" />';
			searchclientfrm += '</div>';
			searchclientfrm += '</div>';
			searchclientfrm += '</div>';
			searchclientfrm += '</fieldset>';
			searchclientfrm += '</div>';
			searchclientfrm += '<div class="modal-footer">';
			searchclientfrm += '<button type="submit" class="btn btn-primary" >OK</button>';
			searchclientfrm += '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
			searchclientfrm += '</div>';
			searchclientfrm += '</form>';
			$('#reserforms').html(searchclientfrm);
		}
	}
	
	function open_booking_form(form_id)
	{
		if(form_id!='')
		{
			var chkin = $('#'+form_id+' input[name="chkin"]').val();
			var chkout = $('#'+form_id+' input[name="chkout"]').val();
			var roomid = $('#'+form_id+' input[name="roomid"]').val();
			var title = $('#'+form_id+' select[name="title"]').val();
			var company = $('#'+form_id+' input[name="company"]').val();
			var firstname = $('#'+form_id+' input[name="firstname"]').val();
			var lastname = $('#'+form_id+' input[name="lastname"]').val();
			var email = $('#'+form_id+' input[name="email"]').val();
			var cellphone = $('#'+form_id+' input[name="cellphone"]').val();
			var country = $('#'+form_id+' input[name="country"]').val();
			var comment = $('#'+form_id+' textarea[name="comment"]').val();
			var clientdata = { 'act':'new','title':title,'company':company,'firstname':firstname,'lastname':lastname,'email':email,'cellphone':cellphone,'country':country,'comment':comment };
			
			var reservfrm = '';
			reservfrm += '<form class="columns add_new_reserve_setup" id="addreservation" method="post">';
			reservfrm += '<input type="hidden" name="chkin" id="chkin" value="'+chkin+'">';
			reservfrm += '<input type="hidden" name="chkout" id="chkout" value="'+chkout+'">';
			reservfrm += '<input type="hidden" name="roomid" id="roomid" value="'+roomid+'">';
			reservfrm += '<input type="hidden" name="property_id" value="{{$pid}}">';
			reservfrm += '<input type="hidden" name="actionName" value="reserve">';
			reservfrm += '<input type="hidden" name="clientData" value=\''+JSON.stringify(clientdata)+'\'>';
			reservfrm += '<div class="modal-body">';
			reservfrm += '<fieldset>';
			reservfrm += '<div class="form-group row">';
			reservfrm += '<div class="col-md-4">';
			reservfrm += '<div class="row">';
			reservfrm += '<div class="col-md-12">';
			reservfrm += '<label>Stay Type</label>';
			reservfrm += '<div class="field-input">';
			reservfrm += '<select name="staytype" class="form-control" style="width: 100%; padding:5px;" required="required">';
			reservfrm += '<option></option>';
			reservfrm += '<option value="Business">Business</option>';
			reservfrm += '<option value="Leisure">Leisure</option>';
			reservfrm += '<option value="Residency">Residency</option>';
			reservfrm += '</select>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="row">';
			reservfrm += '<div class="col-md-12">';
			reservfrm += '<label>Source</label>';
			reservfrm += '<div class="field-input">';
			reservfrm += '<select name="source" class="form-control" style="width: 100%; padding:5px;">';
			reservfrm += '<option></option>';
			reservfrm += '<option value="Direct reservation">Direct reservation</option>';
			reservfrm += '<option value="Email">Email</option>';
			reservfrm += '<option value="Hotel Next Door">Hotel Next Door</option>';
			reservfrm += '<option value="Hotel Website">Hotel Website</option>';
			reservfrm += '<option value="Recommended">Recommended</option>';
			reservfrm += '<option value="Return Customer">Return Customer</option>';
			reservfrm += '<option value="Telephone">Telephone</option>';
			reservfrm += '<option value="Tourist Office">Tourist Office</option>';
			reservfrm += '<option value="Walk-In">Walk-In</option>';
			reservfrm += '</select>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="col-md-6">';
			reservfrm += '<label>Comment</label>';
			reservfrm += '<div class="field-input">';
			reservfrm += '<textarea id="book-comment" class="form-control" name="comment" style="width: 100%; height: 60px; box-sizing: border-box"></textarea>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="row">';
			reservfrm += '<div class="col-md-12">';
			reservfrm += '<div class="field-input optionbox">';
			reservfrm += '<input type="checkbox" name="pre"> pre-reservation';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="row">';
			reservfrm += '<div class="col-md-12">';
			reservfrm += '<hr>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="form-group row">';
			reservfrm += '<div class="col-md-5">';
			reservfrm += '<div class="row">';
			reservfrm += '<div class="col-md-4">';
			reservfrm += '<label>Adults</label>';
			reservfrm += '<div class="field-input">';
			reservfrm += '<select name="adult" class="form-control" style="width: 100%; padding:5px;" required="required">';
			reservfrm += '<option value="0">0</option>';
			reservfrm += '<option value="1">1</option>';
			reservfrm += '<option value="2">2</option>';
			reservfrm += '</select>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="col-md-4">';
			reservfrm += '<label>Junior</label>';
			reservfrm += '<div class="field-input">';
			reservfrm += '<select name="junior" class="form-control" style="width: 100%; padding:5px;">';
			reservfrm += '<option value="0">0</option>';
			reservfrm += '<option value="1">1</option>';
			reservfrm += '</select>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="col-md-4">';
			reservfrm += '<label>Baby</label>';
			reservfrm += '<div class="field-input">';
			reservfrm += '<select name="baby" class="form-control" style="width: 100%; padding:5px;">';
			reservfrm += '<option value="0">0</option>';
			reservfrm += '<option value="1">1</option>';
			reservfrm += '</select>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="col-md-6">';
			reservfrm += '<label>Guests Names</label>';
			reservfrm += '<div class="field-input">';
			reservfrm += '<input type="text" class="form-control" value="" name="guest_list" required="required">';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="form-group row">';
			reservfrm += '<div class="col-md-6">';
			reservfrm += '<label>Check-in Comment</label>';
			reservfrm += '<div class="field-input">';
			reservfrm += '<textarea class="form-control" name="chkin_comment" style="width: 100%; height: 60px; box-sizing: border-box"></textarea>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="col-md-6">';
			reservfrm += '<label>Check-out Comment</label>';
			reservfrm += '<div class="field-input">';
			reservfrm += '<textarea class="form-control" name="chkout_comment" style="width: 100%; height: 60px; box-sizing: border-box"></textarea>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="row">';
			reservfrm += '<div class="col-md-2">';
			reservfrm += '<div class="field-input">';
			reservfrm += 'Options:';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="col-md-4">';
			reservfrm += '<div class="field-input optionbox">';
			reservfrm += '<input type="checkbox" name="option1"> Upper level rooms';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="col-md-3">';
			reservfrm += '<div class="field-input optionbox">';
			reservfrm += '<input type="checkbox" name="option2"> Baby cot';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="row">';
			reservfrm += '<div class="col-md-12">';
			reservfrm += '<hr>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="form-group row">';
			reservfrm += '<div class="col-md-2">';
			reservfrm += '<label>Price</label>';
			reservfrm += '<div class="field-input">';
			reservfrm += '<input type="text" class="form-control" value="95.00" name="price">';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="col-md-2">';
			reservfrm += '<label>Mode</label>';
			reservfrm += '<div class="field-input">';
			reservfrm += '<select name="price_mode" class="form-control" style="width: 100%; padding:5px;">';
			reservfrm += '<option value="daily">Daily</option>';
			reservfrm += '<option value="weekly">Weekly</option>';
			reservfrm += '<option value="monthly">Monthly</option>';
			reservfrm += '<option value="fixed">Fixed</option>';
			reservfrm += '</select>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '<div class="form-group row">';
			reservfrm += '<div class="col-md-3">';
			reservfrm += '<label>Board</label>';
			reservfrm += '<div class="field-input">';
			reservfrm += '<select name="board" class="form-control" style="width: 100%; padding:5px;">';
			reservfrm += '<option></option>';
			reservfrm += '<option value="1">Breakfast</option>';
			reservfrm += '</select>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</div>';
			reservfrm += '</fieldset>';
			reservfrm += '</div>';
			reservfrm += '<div class="modal-footer">';
			reservfrm += '<button type="submit" class="btn btn-primary" >OK</button>';
			reservfrm += '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
			reservfrm += '</div>';
			reservfrm += '</form>';
			$('#reserforms').html(reservfrm);
		}
	}

	function save_reserve_forms_data(formid)
	{
		if(formid!='')
		{
			$.ajax({
			  url: "{{ URL::to('add_new_reservation')}}",
			  type: "post",
			  data: $('#'+formid).serializeArray(),
			  dataType: "json",
			  success: function(data){
				var html = '';
				if(data.status=='error')
				{
					alert('error');
				}
				else
				{
					html += '<div class="modal-body">';
					html += '<h2>Reservation Submitted Successfully!</h2>';
					html += '</div>';
					html += '<div class="modal-footer">';
					html += '<button type="button" class="btn btn-default" data-dismiss="modal" >CLOSE</button>';
					html += '</div>';
					$('#reserforms').html(html);
				}
			  }
			});
		}
	}
	
	function dateOffset(act)
	{
		var cal_start = $('#cal-start').val();
		var cal_end = $('#cal-end').val();
		var current_date = new Date(cal_start);
		var end_date = new Date(cal_end);
		var d = m = '';
		if(act=='prev')
		{
			current_date.setDate(current_date.getDate()-1);
			d = ("0" + current_date.getDate()).slice(-2);
			m = ("0" + (current_date.getMonth() + 1)).slice(-2);
			$('#cal-end').val(current_date.getFullYear() + '-' + m + '-' + d);
			
			current_date.setDate(current_date.getDate()-25);
			d = ("0" + current_date.getDate()).slice(-2);
			m = ("0" + (current_date.getMonth() + 1)).slice(-2);
			$('#cal-start').val(current_date.getFullYear() + '-' + m + '-' + d);
		}
		else if(act=='next')
		{
			end_date.setDate(end_date.getDate()+1);
			d = ("0" + end_date.getDate()).slice(-2);
			m = ("0" + (end_date.getMonth() + 1)).slice(-2);
			$('#cal-start').val(end_date.getFullYear() + '-' + m + '-' + d);
			
			end_date.setDate(end_date.getDate()+25);
			d = ("0" + end_date.getDate()).slice(-2);
			m = ("0" + (end_date.getMonth() + 1)).slice(-2);
			$('#cal-end').val(end_date.getFullYear() + '-' + m + '-' + d);
		}
		else if(act=='week')
		{
			var start = start || 1;
			var today = new Date();
			var day = today.getDay() - start;
			var date = today.getDate() - day;
			var StartDate = new Date(today.setDate(date));
			
			d = ("0" + StartDate.getDate()).slice(-2);
			m = ("0" + (StartDate.getMonth() + 1)).slice(-2);
			$('#cal-start').val(StartDate.getFullYear() + '-' + m + '-' + d);
			
			var EndDate = new Date(today.setDate(date + 6));
			d = ("0" + EndDate.getDate()).slice(-2);
			m = ("0" + (EndDate.getMonth() + 1)).slice(-2);
			$('#cal-end').val(EndDate.getFullYear() + '-' + m + '-' + d);
		}
		else if(act=='month')
		{
			var date = new Date();
			var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
			d = ("0" + firstDay.getDate()).slice(-2);
			m = ("0" + (firstDay.getMonth() + 1)).slice(-2);
			$('#cal-start').val(firstDay.getFullYear() + '-' + m + '-' + d);
			
			var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
			d = ("0" + lastDay.getDate()).slice(-2);
			m = ("0" + (lastDay.getMonth() + 1)).slice(-2);
			$('#cal-end').val(lastDay.getFullYear() + '-' + m + '-' + d);
		}
		find_reservation_dates();
	}
	
	function find_reservation_dates()
	{
		var cal_room_type = $('#cal-room-type').val();
		$.ajax({
		  url: "{{ URL::to('get_category_rooms_reservations')}}",
		  type: "post",
		  data: 'caltype='+cal_room_type+'&pid={{$pid}}',
		  dataType: "json",
		  success: function(data){
			var html = '';
			if(data.status=='error')
			{
				$('.page-content-wrapper #formerrors').html(data.errors);
				$('#catrooms').html('');
				window.scrollTo(0, 0);
			}
			else
			{
				$('.page-content-wrapper #formerrors').html('');
				var cal_start = $('#cal-start').val();
				var cal_end = $('#cal-end').val();
				var current_date = new Date(cal_start);
				var end_date = new Date(cal_end);
				var end_date_time = end_date.getTime();
				var today = new Date();
				var tophtml = bothtml = roomhtml = dhtml = '';
				var cellCount = 1;
				while (current_date.getTime() <= end_date_time) {
					var day = current_date.getDay();
					var iweekend = dweekend = '';
					var itoday = '';
					if(day === 6 || day === 0)
					{
						iweekend = 'weekend';
						dweekend = 'weekend_days';
					}
					if(today.getDate()==current_date.getDate() && today.getMonth()==current_date.getMonth() && today.getFullYear()==current_date.getFullYear())
					{
						itoday = 'today';
					}
					tophtml += '<div class="cols top_border_black left_border_black '+iweekend+' '+itoday+'">'+current_date.getDate()+'</div>';
					
					bothtml += '<div class="cols bottom_border_black left_border_black '+iweekend+' '+itoday+'">'+current_date.getDate()+'</div>';
					
					var d = ("0" + current_date.getDate()).slice(-2);
					var m = ("0" + (current_date.getMonth() + 1)).slice(-2);
					var dateData = {'year':current_date.getFullYear(),'month':m,'date':d};
						
					
					dhtml += '<div class="cols right_border_gray scell '+dweekend+'" data-cell-number="'+cellCount+'" data-date=\''+JSON.stringify(dateData)+'\'></div>';
					
					current_date.setDate(current_date.getDate()+1);
					cellCount++;
				}
				$('.datcalendartop').html(tophtml);
				$('.datcalendarbottom').html(bothtml);
				
				$.each(data.cat_types, function(idx, tobj) {
					$.each(tobj.rooms, function(idx, obj) {
						roomhtml += '<div class="row first row'+obj.id+'" data-roomname="'+obj.room_name+'" data-roomcat="'+tobj.data.category_name+'" data-roomid="'+obj.id+'">';
						roomhtml += '<div class="cols first right_border_gray">';
						roomhtml += '<span class="room_number">'+obj.room_name+'</span>'; 
						roomhtml += '<span class="room_name">';
						roomhtml += '<span class="room_title">'+tobj.data.cat_short_name+'</span>';
						roomhtml += '<img  class="status_red" src="https://app.base7booking.com/images/icons/broom.png" > </span>';
						roomhtml += '<div class="clr"></div>';
						roomhtml += '</div>';
						roomhtml += dhtml;
						roomhtml += '<div class="clr"></div>';
						roomhtml += '</div>';
					});
				});
				$('#catrooms').html(roomhtml);
			}
		  }
		});
	}
</script>

@stop