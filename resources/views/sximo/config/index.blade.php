@extends('layouts.app')


@section('content')

  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3><i class="fa fa-info"></i> {{ Lang::get('core.t_generalsetting') }} </h3>
      </div>
	  
	 
	  <ul class="breadcrumb">
		<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('sximo/config') }}">{{ Lang::get('core.t_generalsetting') }}</a></li>
	  </ul>	  
	 
    </div>
 	<div class="page-content-wrapper">   
	@if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		
<div class="block-content">
	@include('sximo.config.tab')	
<div class="tab-content m-t">
  <div class="tab-pane active use-padding" id="info">	
  <div class="sbox  "> 
  <div class="sbox-title"></div>
  <div class="sbox-content"> 
		 {!! Form::open(array('url'=>'sximo/config/save/', 'class'=>'form-horizontal row', 'files' => true)) !!}

		<div class="col-sm-6 animated fadeInRight ">
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_appname') }} </label>
			<div class="col-md-8">
			<input name="cnf_appname" type="text" id="cnf_appname" class="form-control input-sm" required  value="{{ CNF_APPNAME }}" />  
			 </div> 
		  </div>  
		  
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_appdesc') }} </label>
			<div class="col-md-8">
			<input name="cnf_appdesc" type="text" id="cnf_appdesc" class="form-control input-sm" value="{{ CNF_APPDESC }}" /> 
			 </div> 
		  </div>  
		  
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_comname') }} </label>
			<div class="col-md-8">
				<input name="cnf_comname" type="text" id="cnf_comname" class="form-control input-sm" value="{{ CNF_COMNAME }}" />  
			</div> 
		  </div>      

		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_emailsys') }} </label>
			<div class="col-md-8">
			<input name="cnf_email" type="text" id="cnf_email" class="form-control input-sm" value="{{ CNF_EMAIL }}" /> 
			 </div> 
		  </div> 
          
          <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_superadmin_emailsys') }} </label>
			<div class="col-md-8">
			<input name="cnf_superadmin_email" type="text" id="cnf_superadmin_email" class="form-control input-sm" value="{{ CNF_SUPERADMIN_EMAIL }}" /> 
			 </div> 
		  </div> 
          
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_google_analytic_key') }} </label>
			<div class="col-md-8">
				<input name="cnf_google_analytic_key" type="text" id="cnf_google_analytic_key" class="form-control input-sm" value="{{ CNF_GOOGLE_ANALYTIC_KEY }}" />  
			</div> 
		  </div>  
          
          
          <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_youtube_api_key') }} </label>
			<div class="col-md-8">
				<input name="cnf_youtube_api_key" type="text" id="cnf_youtube_api_key" class="form-control input-sm" value="{{ CNF_YOUTUBE_API_KEY }}" />  
			</div> 
		  </div>  
          
          
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"> Muliti language <br /> <small> Only Layout Interface </small> </label>
			<div class="col-md-8">
				<div class="checkbox">
					<input name="cnf_multilang" type="checkbox" id="cnf_multilang" value="1"
					@if(CNF_MULTILANG ==1) checked @endif
					  />  {{ Lang::get('core.fr_enable') }} 
				</div>	
			 </div> 
		  </div> 
		   
           <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"> Subtract this fee from my first booking commission </label>
			<div class="col-md-8">
				<div class="checkbox">
					<input name="cnf_subtract_fee_first_booking" type="checkbox" id="cnf_subtract_fee_first_booking" value="1"
					@if(CNF_SUBTRACT_FEE ==1) checked @endif
					  />  {{ Lang::get('core.fr_enable') }} 
				</div>	
			 </div> 
		  </div> 
             
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_mainlanguage') }} </label>
			<div class="col-md-8">

					<select class="form-control" name="cnf_lang">

					@foreach(SiteHelpers::langOption() as $lang)
						<option value="{{  $lang['folder'] }}"
						@if(CNF_LANG ==$lang['folder']) selected @endif
						>{{  $lang['name'] }}</option>
					@endforeach
				</select>
			 </div> 
		  </div>   
		      

		   <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"> Frontend Template </label>
			<div class="col-md-8">

					<select class="form-control" name="cnf_theme">
					@foreach(SiteHelpers::themeOption() as $t)
						<option value="{{  $t['folder'] }}"
						@if(CNF_THEME ==$t['folder']) selected @endif
						>{{  $t['name'] }}</option>
					@endforeach
				</select>
			 </div> 
		  </div> 
          
          <div class="form-group">
            <label for="ipt" class=" control-label col-md-4"> Hubspot Script </label>
            <div class="col-md-8">
                <input name="cnf_hubspot_script" type="text" id="cnf_hubspot_script" class="form-control input-sm" value="{{ CNF_HUBSPOT_SCRIPT }}" />            	
            </div> 
		  </div>
          
		  <div class="form-group hide">
		    <label for="ipt" class=" control-label col-md-4"> Development Mode ?   </label>
			<div class="col-md-8">
				<div class="checkbox">
					<input name="cnf_mode" type="checkbox" id="cnf_mode" value="1"
					@if (defined('CNF_MODE') &&  CNF_MODE =='production') checked @endif
					  />  Production
				</div>
				<small> If you need to debug mode , please unchecked this option </small>	
			 </div> 
		  </div> 		  
		  
		  
		</div>

		<div class="col-sm-6 animated fadeInRight ">

		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">Metakey </label>
			<div class="col-md-8">
				<textarea class="form-control input-sm" name="cnf_metakey">{{ CNF_METAKEY }}</textarea>
			 </div> 
		  </div> 

		   <div class="form-group">
		    <label  class=" control-label col-md-4">Meta Description</label>
			<div class="col-md-8">
				<textarea class="form-control input-sm"  name="cnf_metadesc">{{ CNF_METADESC }}</textarea>
			 </div> 
		  </div>  

		   <div class="form-group">
		    <label  class=" control-label col-md-4">Backend Logo</label>
			<div class="col-md-8">
				<input type="file" name="logo">
				<p> <i>Please use image dimension 155px * 30px </i> </p>
				<div style="padding:5px; border:solid 1px #ddd; background:#f5f5f5; width:auto;">
				 	@if(file_exists(public_path().'/sximo/images/'.CNF_LOGO) && CNF_LOGO !='')
				 	<img src="{{ asset('sximo/images/'.CNF_LOGO)}}" alt="{{ CNF_APPNAME }}" />
				 	@else
					<img src="{{ asset('sximo/images/logo.png')}}" alt="{{ CNF_APPNAME }}" />
					@endif	
				</div>				
			 </div> 
		  </div>  		  
            
          <div class="form-group">
		    <label  class=" control-label col-md-4">Frontend Logo</label>
			<div class="col-md-8">
				<input type="file" name="frontlogo">
				<p> <i>Please use image dimension 155px * 30px </i> </p>
				<div style="padding:5px; border:solid 1px #ddd; background:#f5f5f5; width:auto;">
				 	@if(file_exists(public_path().'/sximo/images/'.CNF_FRONTEND_LOGO) && CNF_FRONTEND_LOGO !='')
				 	<img src="{{ asset('sximo/images/'.CNF_FRONTEND_LOGO)}}" alt="{{ CNF_APPNAME }}" />
				 	@else
					<img src="{{ asset('sximo/images/logo.png')}}" alt="{{ CNF_APPNAME }}" />
					@endif	
				</div>				
			 </div> 
		  </div>
            
		</div>
        
        <div class="col-sm-12 animated">
            <div class="form-group">
    		    <label for="ipt" class=" control-label col-md-2"> Membership Category   </label>
    			<div class="col-md-10">
                @if(!empty($b2c_packages))
                    @foreach($b2c_packages as $pkg)                                 
    				<label class="checkbox checkbox-inline">
    					<input name="public_package[]" type="checkbox" id="public_package" @if($pkg->is_public == '1') checked="checked" @endif value="{{$pkg->id}}" />  {{$pkg->package_title}}
    				</label>
                    @endforeach
                @endif	                                    
    			 </div> 
    		  </div> 
        </div>        
        
        <div class="col-sm-12 animated">
            <div class="form-group">
    		    <label for="ipt" class=" control-label col-md-4">&nbsp;</label>
    			<div class="col-md-8">
    				<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }} </button>
    			 </div> 
    		  </div> 
        </div>                        
                                                        
		 {!! Form::close() !!}
	</div>
	</div>	 
</div>
</div>
</div>
</div>








@stop