<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> {{ CNF_APPNAME }} </title>
<meta name="keywords" content="">
<meta name="description" content=""/>
	
        <!-- Favicon Start -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/images/favicon/apple-icon-57x57.png') }}" />
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/images/favicon/apple-icon-60x60.png') }}" />
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/images/favicon/apple-icon-72x72.png') }}" />
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/favicon/apple-icon-76x76.png') }}" />
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/images/favicon/apple-icon-114x114.png') }}" />
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/images/favicon/apple-icon-120x120.png') }}" />
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/images/favicon/apple-icon-144x144.png') }}" />
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/images/favicon/apple-icon-152x152.png') }}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-icon-180x180.png') }}" />
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/images/favicon/android-icon-192x192.png') }}" />
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}" />
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/images/favicon/favicon-96x96.png') }}" />
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}" />
        <link rel="manifest" href="{{ asset('assets/images/favicon/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff" />
        <meta name="msapplication-TileImage" content="{{ asset('assets/images/favicon/ms-icon-144x144.png') }}" />
        <meta name="theme-color" content="#ffffff" />
        <!-- Favicon END -->


		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link href="{{ asset('sximo/js/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet"> 
		<link href="{{ asset('sximo/js/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{ asset('sximo/fonts/awesome/css/font-awesome.min.css')}}" rel="stylesheet">
		<link href="{{ asset('sximo/js/plugins/bootstrap.summernote/summernote.css')}}" rel="stylesheet">
		<link href="{{ asset('sximo/js/plugins/datepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
		<link href="{{ asset('sximo/js/plugins/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
		<link href="{{ asset('sximo/js/plugins/select2/select2.css')}}" rel="stylesheet">
		<link href="{{ asset('sximo/js/plugins/iCheck/skins/square/green.css')}}" rel="stylesheet">
		<link href="{{ asset('sximo/js/plugins/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
		<link href="{{ asset('sximo/js/plugins/markitup/skins/simple/style.css') }}" rel="stylesheet">
		<link href="{{ asset('sximo/js/plugins/markitup/sets/default/style.css') }}" rel="stylesheet">

                <link href="{{ asset('sximo/crm_layout/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet" type="text/css" />
                
		<link href="{{ asset('sximo/css/animate.css')}}" rel="stylesheet">		
		<link href="{{ asset('sximo/css/icons.min.css')}}" rel="stylesheet">
		<link href="{{ asset('sximo/js/plugins/toastr/toastr.css')}}" rel="stylesheet">
		{{-- @if(!Session::get('themes') or Session::get('themes') =='')
		<link href="{{ asset('sximo/css/sximo-dark-blue.css')}}" rel="stylesheet">
		@else
		<link href="{{ asset('sximo/css/'.Session::get('themes').'.css')}}" rel="stylesheet">	
		@endif --}}
	<link href="{{ asset('sximo/css/sximo-dark-blue.css')}}" rel="stylesheet">
		@yield('style')
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/jquery.cookie.js') }}"></script>			
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/jquery-ui.min.js') }}"></script>				
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/iCheck/icheck.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/select2/select2.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/fancybox/jquery.fancybox.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/prettify.js') }}"></script>
		<!--<script type="text/javascript" src="{{ asset('sximo/js/plugins/parsley.js') }}"></script>-->
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/switch.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/bootstrap/js/bootstrap.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/sximo.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/jquery.form.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/jquery.jCombo.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/toastr/toastr.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/bootstrap.summernote/summernote.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/simpleclone.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/markitup/jquery.markitup.js') }}"></script>	
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/markitup/sets/default/set.js') }}"></script>	
		
                <script src="{{ asset('sximo/crm_layout/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
                
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->		

		@yield('script')
		@yield('custom_js_script')
	
  	</head>
  	<body class="sxim-init" >
	<div id="wrapper">
		@include('layouts/sidemenu')
		<div class="gray-bg " id="page-wrapper">
			@include('layouts/headmenu')

			@yield('content')		
		</div>

		<div class="footer fixed">
		    <div class="pull-right">
		       
		    </div>
		    <div>
		        <strong>Copyright</strong> &copy; {{ date('Y')}} . {{ CNF_COMNAME }}  
		    </div>
		</div>		

	</div>

<div class="modal fade" id="sximo-modal" tabindex="-1" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
	<div class="modal-header bg-default">
		
		<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Modal title</h4>
	</div>
	<div class="modal-body" id="sximo-modal-content">

	</div>

  </div>
</div>
</div>

<div class="theme-config">
    <div class="theme-config-box">
        <div class="spin-icon">
            <i class="fa fa-cogs fa-spin"></i>
        </div>
        <div class="skin-setttings">
            <div class="title">Select Color Schema</div>
            <div class="setings-item">
                    <ul>
	                    <li><a href="{{ url('home/skin/sximo') }}"> Default Skin  <span class="pull-right default-skin"> </span></a></li> 
	                    <li><a href="{{ url('home/skin/sximo-dark-blue') }}"> Dark Blue Skin <span class="pull-right dark-blue-skin"> </span> </a></li> 
	                    <li><a href="{{ url('home/skin/sximo-light-blue') }}"> Light Blue Skin <span class="pull-right light-blue-skin"> </span> </a></li> 
	                   
                    </ul>

                
            </div>
            
        </div>
    </div>
</div>
		<script language="javascript">
		jQuery(document).ready(function($)	{
		   $('.markItUp').markItUp(mySettings );
		});
		</script>

{{ Sitehelpers::showNotification() }} 
<script type="text/javascript">
jQuery(document).ready(function ($) {

    $('#sidemenu').sximMenu();
	$('.spin-icon').click(function () {
        $(".theme-config-box").toggleClass("show");
    });

	setInterval(function(){ 
		var noteurl = $('.notif-value').attr('code'); 
		$.get( noteurl +'/notification/load',function(data){
			$('.notif-alert').html(data.total);
			var html = '';
			$.each( data.note, function( key, val ) {
				html += '<li><a href="'+val.url+'"> <div> <i class="'+val.icon+' fa-fw"></i> '+ val.title+'  <span class="pull-right text-muted small">'+val.date+'</span></div></li>';
				html += '<li class="divider"></li>';			 
			});
			html += '<li><div class="text-center link-block"><a href="'+noteurl+'/notification"><strong>View All Notification</strong> <i class="fa fa-angle-right"></i></a></div></li>';
			$('.notif-value').html(html);
		});
	}, 60000);
		
});	
	
	
</script>
</body> 
</html>