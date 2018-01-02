@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
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
	
	
	<div class="page-content-wrapper m-t">	 	

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h5> <i class="fa fa-table"></i> </h5>
<div class="sbox-tools" >
		<a href="{{ url($pageModule) }}" class="btn btn-xs btn-white tips" title="Clear Search" ><i class="fa fa-trash-o"></i> Clear Search </a>
		@if(Session::get('gid') ==1)
			<a href="{{ URL::to('sximo/module/config/'.$pageModule) }}" class="btn btn-xs btn-white tips" title=" {{ Lang::get('core.btn_config') }}" ><i class="fa fa-cog"></i></a>
		@endif 
		</div>
	</div>
	<div class="sbox-content"> 	
	    <div class="toolbar-line ">
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('properties/update') }}" class="tips btn btn-sm btn-white"  title="{{ Lang::get('core.btn_create') }}">
			<i class="fa fa-plus-circle "></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-minus-circle "></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 
			<a href="{{ URL::to( 'properties/search') }}" class="btn btn-sm btn-white" onclick="SximoModal(this.href,'Advance Search'); return false;" ><i class="fa fa-search"></i> Search</a>				
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('properties/download?return='.$return) }}" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_download') }}">
			<i class="fa fa-download"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
			@endif			
			
			<select name='property_category' id='property_category' style="height: 28px; margin-left: 5px;" onchange="fetchpropertycategory(this.value);" > 
				<option value="">-Select-</option>
				@if(!empty($fetch_cat))
					@foreach($fetch_cat as $catlist)
						<option value="{{$catlist->id}}" <?php echo ($curntcat == $catlist->id) ? " selected='selected' " : '' ; ?>>{{$catlist->category_name}}</option>
					@endforeach
				@endif
			</select>

			<select name='selstatus' id='selstatus' style="height: 28px; margin-left: 5px;" onchange="filterstatus(this.value);" > 
				<option value="">-Status-</option>
				<option value="active" <?php echo ($curstatus == 'active') ? " selected='selected' " : "selected='selected'" ; ?>>Active</option>
				<option value="inactive" <?php echo ($curstatus == 'inactive') ? " selected='selected' " : '' ; ?>>Inactive</option>
			</select>			
		</div> 		

	
	
	 {!! Form::open(array('url'=>'properties/delete/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th>Property Name</th>
				<th>Property City</th>
				<th>Website</th>
				<th>Email</th>
				<th width="210" >{{ Lang::get('core.btn_action') }}</th>
			  </tr>
        </thead>

        <tbody>        						
            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->id }}" />  </td>									
					<td> <a target="_blank" href="{{URL::to($row->property_slug)}}">{{$row->property_name}}</a> </td>
					<td> <a target="_blank" href="{{URL::to('search?s='.$row->city)}}">{{$row->city}}</a> </td>
					<td> <a target="_blank" href="{{(strpos($row->website, 'http') !== false) ? $row->website : 'http://'.$row->website }}">{{$row->website}}</a> </td>
					<td> {{$row->email}} </td>
				 <td>
						@if($row->assign_detail_city!='0' && $row->assign_detail_city!='')
							<a href="#" class="tips btn btn-xs btn-primary" title="City Assigned"><i class="fa  fa-check "></i></a>
						@else
							<a href="#" class="tips btn btn-xs btn-danger" title="please assign city"><i class="fa  fa-times "></i></a>
						@endif
					 	@if($access['is_detail'] ==1)
						<a href="{{ URL::to('properties/show/'.$row->id.'?return='.$return)}}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search "></i></a>
						@endif
						@if($access['is_edit'] ==1)
						<a  href="{{ URL::to('properties/update/'.$row->id.'?return='.$return) }}" class="tips btn btn-xs btn-success" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i></a>
						@endif
						<a  href="{{ URL::to('properties_settings/'.$row->id.'/types') }}" class="tips btn btn-xs btn-success" title="{{ Lang::get('core.btn_config') }}"><i class="fa fa-cogs "></i></a>					
						@if($row->property_status==1)
							<a  href="#" class="tips btn btn-xs btn-success" title="Click to Disable " onclick="change_option(this,'property_status','{{$row->id}}',0);"><i class="fa fa-check "></i></a>
						@else
							<a  href="#" class="tips btn btn-xs btn-danger" title="Click to enable " onclick="change_option(this,'property_status','{{$row->id}}',1);"><i class="fa fa-times "></i></a>
						@endif
						<a  href="{{ URL::to('properties_settings/'.$row->id.'/property_images') }}" class="tips btn btn-xs btn-success" title="Property Images"><i class="fa fa-file-image-o"></i></a>
						<a  href="#" onclick="getseasonrates({{$row->id}});" class="tips btn btn-xs btn-success" title="Rates" data-toggle="modal" data-target="#psrModal"><i class="fa fa-usd"></i></a>
				</td>				 
                </tr>
				
            @endforeach
              
        </tbody>
      
    </table>
	<input type="hidden" name="md" value="" />
	</div>
	{!! Form::close() !!}
	@include('footer')
	</div>
</div>	
	</div>	  
</div>	

<!-- Property Season Rates Modal -->
<div class="modal fade" id="psrModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Property Rates</h4>
	  </div>
	  <div class="modal-body">
		<table>
			<tr>
				<th width="100">Type</th>
				<th width="100">Season</th>
				<th width="100">Base Rate</th>
				<th width="130">Commission( in % )</th>
				<th width="100">New Rate</th>
			</tr>
			<tbody id="ratecomm">
			</tbody>
		</table>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">OK</button>
	  </div>
	  </form>
	</div>
  </div>
</div>
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("properties/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	

function select_field_changeType(type)
{
	$('.selectedField').val('');
	var sList = "";
	$('input[type=checkbox].ids').each(function () {
		if(this.checked)
		{
			sList += (sList=="" ? $(this).val() : "," + $(this).val());
		}
		
	});
	$.ajax({
	  url: "{{ URL::to('change_property_type')}}",
	  type: "post",
	  data: 'type='+type+'&row_ids='+sList,
	  success: function(data){
		if(data!='error')
		{
			 location.reload();
		}
	  }
	});
}

function change_option(row,filed_name,row_id,act)
{
	if(row_id!='' && row_id>0)
	{
		$.ajax({
		  url: "{{ URL::to('enable_diable_propertystatus')}}",
		  type: "post",
		  data: 'filed_name='+filed_name+'&row_id='+row_id+'&action='+act,
		  success: function(data){
			if(data!='error')
			{
				if(act==1)
				{
					$(row).removeClass('btn-danger');
					$(row).addClass('btn-success');
					$(row).children( "i.fa" ).removeClass('fa-times');
					$(row).children( "i.fa" ).addClass('fa-check');
					$(row).attr("onclick","change_option(this,'"+filed_name+"','"+row_id+"',0)");
					$(row).attr("title","Click to Disable");
					$(row).attr("data-original-title","Click to Disable");
				}
				else if(act==0)
				{	
					$(row).removeClass('btn-success');
					$(row).addClass('btn-danger');
					$(row).children( "i.fa" ).removeClass('fa-check');
					$(row).children( "i.fa" ).addClass('fa-times');
					$(row).attr("onclick","change_option(this,'"+filed_name+"','"+row_id+"',1)");
					$(row).attr("title","Click to Enable");
					$(row).attr("data-original-title","Click to Enable");
				}
			}
		  }
		});
	}
}

function fetchpropertycategory(catg)
{
	window.location.href = "{{URL::to('properties')}}?selcat="+catg;
}

function filterstatus(status)
{
	var catg = $('#property_category').val();
	if(catg!='')
	{
		window.location.href = "{{URL::to('properties')}}?selcat="+catg+"&selstatus="+status;
	}
	else
	{
		window.location.href = "{{URL::to('properties')}}?selstatus="+status;
	}
}

function getseasonrates(proid)
{
	if(proid!='' && proid>0)
	{
		$.ajax({
		  url: "{{ URL::to('getPropertyRates')}}",
		  type: "post",
		  data: 'propid='+proid,
		  dataType: 'json',
		  success: function(data){
			if(data.status!='error')
			{
				var prorates = '';
				var im=0;
				$(data.cat_rooms_price.cat_rooms).each(function (i, val) {
					prorates += '<tr>';
					prorates += '<td>'+val.category_name+'</td>';
					prorates += '<td>';
					if(val.season_name==null)
					{
						prorates += 'Default';
					}
					else
					{
						prorates += val.season_name;
					}	
					prorates += '</td>';
					prorates += '<td>'+val.rack_rate+'</td>';
					prorates += '<td>'+data.cat_rooms_price.usercomm.commission+'</td>';
					prorates += '<td>';
					if(data.cat_rooms_price.usercomm.commission!=null)
					{
						var pert = (val.rack_rate*data.cat_rooms_price.usercomm.commission)/100;
						var finalvl = val.rack_rate - pert;
						prorates += finalvl;
					}						
					prorates += '</td>';
					prorates += '</tr>';
				});
				$('#ratecomm').html(prorates);
			}
		  }
		});
	}
}
</script>		
@stop